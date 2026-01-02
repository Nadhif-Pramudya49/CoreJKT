<?php
require_once 'config.php';

if (isset($_GET['rute_id'])) {
    $rute_id = $_GET['rute_id'];
    
    $stmt = $pdo->prepare("SELECT * FROM jadwal WHERE rute_id = ? AND status = 'aktif' ORDER BY waktu_keberangkatan");
    $stmt->execute([$rute_id]);
    $jadwal = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($jadwal);
}
?>