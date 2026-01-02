<?php
session_start();
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);

        // Hapus session agar otomatis logout setelah hapus akun
        session_destroy();
        
        echo "<script>alert('Akun berhasil dihapus'); window.location='login.php';</script>";
    } catch (PDOException $e) {
        echo "Gagal hapus: " . $e->getMessage();
    }
}
?>