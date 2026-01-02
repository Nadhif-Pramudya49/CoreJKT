<?php
session_start();
require "config.php";

// ======================
// CEK LOGIN
// ======================
if (!isset($_SESSION["user"]["id"])) {
    header("Location: login.php");
    exit;
}

// ======================
// VALIDASI ID LAPORAN
// ======================
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: riwayat_laporan.php");
    exit;
}

$id_laporan = (int) $_GET['id'];

// ======================
// AMBIL DATA LAPORAN (CEK PEMILIK & STATUS)
// ======================
$sql = "SELECT foto, status 
        FROM laporan 
        WHERE id_laporan = :id_laporan 
        AND id_user = :id_user";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':id_laporan' => $id_laporan,
    ':id_user'    => $_SESSION['user']['id']
]);

$laporan = $stmt->fetch(PDO::FETCH_ASSOC);

// Kalau laporan tidak ditemukan / bukan milik user
if (!$laporan) {
    header("Location: riwayat_laporan.php");
    exit;
}

// Hanya boleh hapus jika status pending
if ($laporan['status'] !== 'pending') {
    header("Location: riwayat_laporan.php");
    exit;
}

// ======================
// HAPUS FILE FOTO (JIKA ADA)
// ======================
if (!empty($laporan['foto'])) {
    $file_path = "uploads/" . $laporan['foto'];
    if (file_exists($file_path)) {
        unlink($file_path);
    }
}

// ======================
// HAPUS DATA DARI DATABASE
// ======================
$sql = "DELETE FROM laporan 
        WHERE id_laporan = :id_laporan 
        AND id_user = :id_user";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':id_laporan' => $id_laporan,
    ':id_user'    => $_SESSION['user']['id']
]);

// ======================
// REDIRECT
// ======================
header("Location: riwayat_laporan.php?deleted=1");
exit;
