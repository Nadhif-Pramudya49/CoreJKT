<?php
require_once 'config.php';

if (isset($_GET['transport_id'])) {
    $transport_id = $_GET['transport_id'];
    
    $stmt = $pdo->prepare("SELECT * FROM rute WHERE jenis_transportasi_id = ? AND status = 'aktif'");
    $stmt->execute([$transport_id]);
    $rute = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($rute);
}
?>