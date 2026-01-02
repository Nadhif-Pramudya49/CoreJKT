<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $user_id = $_SESSION['user_id'];
    
    try {
        // Update status menjadi batal
        $stmt = $pdo->prepare("
            UPDATE pemesanan_tiket 
            SET status_pembayaran = 'batal' 
            WHERE id = ? AND user_id = ?
        ");
        $stmt->execute([$id, $user_id]);
        
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'Pesanan berhasil dibatalkan']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Pesanan tidak ditemukan']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>