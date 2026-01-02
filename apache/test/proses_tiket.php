<?php
session_start();

// Enable error display untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';

// Simulasi user jika belum login
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1;
    $_SESSION['user_name'] = 'Demo User';
}

// Cek request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST' && !isset($_GET['action'])) {
    $_SESSION['error'] = "Method tidak valid";
    header("Location: eticket.php");
    exit;
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

try {
    switch ($action) {
        case 'beli':
            beliTiket();
            break;
        case 'cancel':
            cancelTiket();
            break;
        case 'use':
            useTiket();
            break;
        default:
            throw new Exception("Action tidak valid: $action");
    }
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    header("Location: eticket.php");
    exit;
}

function beliTiket()
{
    global $pdo;

    // Ambil dan validasi input
    $user_id = $_SESSION['user_id'];
    $rute_id = $_POST['rute_id'] ?? null;
    $tanggal_perjalanan = $_POST['tanggal_perjalanan'] ?? null;
    $waktu_keberangkatan = $_POST['waktu_keberangkatan'] ?? null;
    $jumlah_penumpang = $_POST['jumlah_penumpang'] ?? null;
    $total_harga = $_POST['total_harga'] ?? null;

    // Validasi semua field ada
    if (!$rute_id || !$tanggal_perjalanan || !$waktu_keberangkatan || !$jumlah_penumpang || !$total_harga) {
        throw new Exception("Data tidak lengkap. Pastikan semua field terisi.");
    }

    // Validasi tanggal
    if (strtotime($tanggal_perjalanan) < strtotime(date('Y-m-d'))) {
        throw new Exception("Tanggal perjalanan tidak valid. Harus hari ini atau setelahnya.");
    }

    // Validasi jumlah penumpang
    if ($jumlah_penumpang < 1 || $jumlah_penumpang > 10) {
        throw new Exception("Jumlah penumpang harus antara 1-10 orang.");
    }

    // Cek apakah rute ada
    $stmt = $pdo->prepare("SELECT * FROM rute WHERE id = ? AND status = 'aktif'");
    $stmt->execute([$rute_id]);
    $rute = $stmt->fetch();

    if (!$rute) {
        throw new Exception("Rute tidak ditemukan atau tidak aktif.");
    }

    // Validasi harga
    $expected_total = $rute['harga'] * $jumlah_penumpang;
    if (abs($total_harga - $expected_total) > 1) { // toleransi 1 rupiah untuk pembulatan
        throw new Exception("Total harga tidak sesuai. Expected: Rp " . number_format($expected_total, 0, ',', '.'));
    }

    // Start transaction
    $pdo->beginTransaction();

    try {
        // Generate kode tiket unik
        $kode_tiket = 'TKT' . date('Ymd') . strtoupper(substr(uniqid(), -6));

        // Insert tiket
        $stmt = $pdo->prepare("INSERT INTO tiket (kode_tiket, user_id, rute_id, tanggal_perjalanan, 
                               waktu_keberangkatan, jumlah_penumpang, total_harga, status_tiket) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')");
        $stmt->execute([
            $kode_tiket,
            $user_id,
            $rute_id,
            $tanggal_perjalanan,
            $waktu_keberangkatan,
            $jumlah_penumpang,
            $total_harga
        ]);

        $tiket_id = $pdo->lastInsertId();

        if (!$tiket_id) {
            throw new Exception("Gagal membuat tiket");
        }

        // Generate kode pembayaran
        $kode_pembayaran = 'PAY' . date('YmdHis') . rand(100, 999);

        // Insert pembayaran
        $expired_at = date('Y-m-d H:i:s', strtotime('+24 hours'));
        $stmt = $pdo->prepare("INSERT INTO pembayaran (tiket_id, kode_pembayaran, metode_pembayaran, 
                               jumlah, status, expired_at) 
                               VALUES (?, ?, 'pending', ?, 'pending', ?)");
        $stmt->execute([$tiket_id, $kode_pembayaran, $total_harga, $expired_at]);

        // Commit transaction
        $pdo->commit();

        $_SESSION['success'] = "Tiket berhasil dibuat. Silakan lanjutkan pembayaran.";
        header("Location: pembayaran.php?tiket_id=" . $tiket_id);
        exit;

    } catch (Exception $e) {
        $pdo->rollBack();
        throw new Exception("Gagal menyimpan data: " . $e->getMessage());
    }
}

function cancelTiket()
{
    global $pdo;

    $tiket_id = $_POST['tiket_id'] ?? $_GET['tiket_id'] ?? null;
    $user_id = $_SESSION['user_id'];

    if (!$tiket_id) {
        throw new Exception("ID tiket tidak ditemukan");
    }

    // Cek kepemilikan tiket
    $stmt = $pdo->prepare("SELECT * FROM tiket WHERE id = ? AND user_id = ?");
    $stmt->execute([$tiket_id, $user_id]);
    $tiket = $stmt->fetch();

    if (!$tiket) {
        throw new Exception("Tiket tidak ditemukan");
    }

    if ($tiket['status_tiket'] == 'used') {
        throw new Exception("Tiket sudah digunakan, tidak bisa dibatalkan");
    }

    if ($tiket['status_tiket'] == 'cancelled') {
        throw new Exception("Tiket sudah dibatalkan sebelumnya");
    }

    // Update status tiket
    $stmt = $pdo->prepare("UPDATE tiket SET status_tiket = 'cancelled', updated_at = NOW() 
                           WHERE id = ?");
    $stmt->execute([$tiket_id]);

    // Update status pembayaran jika ada
    $stmt = $pdo->prepare("UPDATE pembayaran SET status = 'failed' WHERE tiket_id = ?");
    $stmt->execute([$tiket_id]);

    $_SESSION['success'] = "Tiket berhasil dibatalkan";
    header("Location: eticket.php#tiket");
    exit;
}

function useTiket()
{
    global $pdo;

    $tiket_id = $_POST['tiket_id'] ?? $_GET['tiket_id'] ?? null;
    $user_id = $_SESSION['user_id'];

    if (!$tiket_id) {
        throw new Exception("ID tiket tidak ditemukan");
    }

    // Cek tiket
    $stmt = $pdo->prepare("SELECT * FROM tiket WHERE id = ? AND user_id = ?");
    $stmt->execute([$tiket_id, $user_id]);
    $tiket = $stmt->fetch();

    if (!$tiket) {
        throw new Exception("Tiket tidak ditemukan");
    }

    if ($tiket['status_tiket'] != 'paid') {
        throw new Exception("Tiket belum dibayar atau tidak valid untuk digunakan");
    }

    if ($tiket['status_tiket'] == 'used') {
        throw new Exception("Tiket sudah digunakan sebelumnya");
    }

    // Update status tiket
    $stmt = $pdo->prepare("UPDATE tiket SET status_tiket = 'used', updated_at = NOW() WHERE id = ?");
    $stmt->execute([$tiket_id]);

    // Insert riwayat penggunaan
    $lokasi = $_POST['lokasi'] ?? 'Stasiun';
    $stmt = $pdo->prepare("INSERT INTO riwayat_tiket (tiket_id, waktu_scan, lokasi_scan, keterangan) 
                           VALUES (?, NOW(), ?, 'Tiket digunakan untuk perjalanan')");
    $stmt->execute([$tiket_id, $lokasi]);

    $_SESSION['success'] = "Tiket berhasil digunakan. Selamat perjalanan!";
    header("Location: tiket_detail.php?id=" . $tiket_id);
    exit;
}
?>