<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $jadwal_id = $_POST['jadwal_id'];
    $tanggal_perjalanan = $_POST['tanggal_perjalanan'];
    $jumlah_tiket = $_POST['jumlah_tiket'];
    $total_harga = $_POST['total_harga'];
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $nama_penumpang = $_POST['nama_penumpang'];
    $no_telepon = $_POST['no_telepon'];
    
    // Generate kode booking unik
    $kode_booking = 'TKT' . date('Ymd') . rand(1000, 9999);
    
    try {
        // Cek apakah kode booking sudah ada
        $check = $pdo->prepare("SELECT id FROM pemesanan_tiket WHERE kode_booking = ?");
        $check->execute([$kode_booking]);
        
        // Jika sudah ada, generate ulang
        while ($check->rowCount() > 0) {
            $kode_booking = 'TKT' . date('Ymd') . rand(1000, 9999);
            $check->execute([$kode_booking]);
        }
        
        // Insert pemesanan
        $stmt = $pdo->prepare("
            INSERT INTO pemesanan_tiket 
            (user_id, jadwal_id, tanggal_perjalanan, jumlah_tiket, total_harga, kode_booking, 
             status_pembayaran, metode_pembayaran, nama_penumpang, no_telepon) 
            VALUES (?, ?, ?, ?, ?, ?, 'lunas', ?, ?, ?)
        ");
        
        $stmt->execute([
            $user_id,
            $jadwal_id,
            $tanggal_perjalanan,
            $jumlah_tiket,
            $total_harga,
            $kode_booking,
            $metode_pembayaran,
            $nama_penumpang,
            $no_telepon
        ]);
        
        // Redirect ke halaman detail tiket
        header("Location: detail_tiket.php?kode=" . $kode_booking);
        exit();
        
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    header("Location: eticket.php");
    exit();
}
?>