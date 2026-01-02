<?php
// debug_proses_tiket.php - Versi dengan logging untuk debugging
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log file
$log_file = 'debug_tiket.log';

function writeLog($message) {
    global $log_file;
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($log_file, "[$timestamp] $message\n", FILE_APPEND);
}

writeLog("=== Script Started ===");
writeLog("Request Method: " . $_SERVER['REQUEST_METHOD']);
writeLog("POST Data: " . print_r($_POST, true));
writeLog("Session Data: " . print_r($_SESSION, true));

// Cek apakah config.php ada
if (!file_exists('config.php')) {
    writeLog("ERROR: config.php not found!");
    die("ERROR: File config.php tidak ditemukan. Pastikan file ini ada di direktori yang sama.");
}

require_once 'config.php';
writeLog("config.php loaded successfully");

// Cek user session
if (!isset($_SESSION['user_id'])) {
    writeLog("WARNING: user_id not set in session, setting default");
    $_SESSION['user_id'] = 1; // Default untuk demo
    $_SESSION['user_name'] = 'Demo User';
}

writeLog("User ID: " . $_SESSION['user_id']);

// Cek request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    writeLog("ERROR: Not a POST request");
    $_SESSION['error'] = "Request tidak valid";
    header("Location: eticket.php");
    exit;
}

$action = $_POST['action'] ?? '';
writeLog("Action: $action");

// Validasi action
if (empty($action)) {
    writeLog("ERROR: Action is empty");
    $_SESSION['error'] = "Action tidak ditemukan";
    header("Location: eticket.php");
    exit;
}

try {
    switch ($action) {
        case 'beli':
            writeLog("Processing BELI action");
            
            // Validasi input
            $required_fields = ['rute_id', 'tanggal_perjalanan', 'waktu_keberangkatan', 'jumlah_penumpang', 'total_harga'];
            foreach ($required_fields as $field) {
                if (!isset($_POST[$field]) || empty($_POST[$field])) {
                    throw new Exception("Field $field tidak boleh kosong");
                }
            }
            
            $user_id = $_SESSION['user_id'];
            $rute_id = $_POST['rute_id'];
            $tanggal_perjalanan = $_POST['tanggal_perjalanan'];
            $waktu_keberangkatan = $_POST['waktu_keberangkatan'];
            $jumlah_penumpang = $_POST['jumlah_penumpang'];
            $total_harga = $_POST['total_harga'];
            
            writeLog("Data validated - rute_id: $rute_id, tanggal: $tanggal_perjalanan");
            
            // Validasi tanggal
            if (strtotime($tanggal_perjalanan) < strtotime(date('Y-m-d'))) {
                throw new Exception("Tanggal perjalanan tidak valid");
            }
            
            // Mulai transaction
            $pdo->beginTransaction();
            writeLog("Transaction started");
            
            // Generate kode tiket unik
            $kode_tiket = 'TKT' . date('Ymd') . strtoupper(substr(uniqid(), -6));
            writeLog("Generated ticket code: $kode_tiket");
            
            // Insert tiket
            $stmt = $pdo->prepare("INSERT INTO tiket (kode_tiket, user_id, rute_id, tanggal_perjalanan, 
                                   waktu_keberangkatan, jumlah_penumpang, total_harga, status_tiket) 
                                   VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')");
            
            $result = $stmt->execute([$kode_tiket, $user_id, $rute_id, $tanggal_perjalanan, 
                            $waktu_keberangkatan, $jumlah_penumpang, $total_harga]);
            
            if (!$result) {
                throw new Exception("Gagal insert tiket: " . print_r($stmt->errorInfo(), true));
            }
            
            $tiket_id = $pdo->lastInsertId();
            writeLog("Ticket inserted with ID: $tiket_id");
            
            // Generate kode pembayaran
            $kode_pembayaran = 'PAY' . date('YmdHis') . rand(100, 999);
            writeLog("Generated payment code: $kode_pembayaran");
            
            // Insert pembayaran
            $expired_at = date('Y-m-d H:i:s', strtotime('+24 hours'));
            $stmt = $pdo->prepare("INSERT INTO pembayaran (tiket_id, kode_pembayaran, metode_pembayaran, 
                                   jumlah, status, expired_at) 
                                   VALUES (?, ?, 'pending', ?, 'pending', ?)");
            
            $result = $stmt->execute([$tiket_id, $kode_pembayaran, $total_harga, $expired_at]);
            
            if (!$result) {
                throw new Exception("Gagal insert pembayaran: " . print_r($stmt->errorInfo(), true));
            }
            
            writeLog("Payment record created");
            
            // Commit transaction
            $pdo->commit();
            writeLog("Transaction committed");
            
            $_SESSION['success'] = "Tiket berhasil dibuat. Silakan lanjutkan pembayaran.";
            writeLog("SUCCESS: Redirecting to pembayaran.php?tiket_id=$tiket_id");
            
            header("Location: pembayaran.php?tiket_id=" . $tiket_id);
            exit;
            
        case 'cancel':
            writeLog("Processing CANCEL action");
            // ... kode cancel seperti sebelumnya
            break;
            
        case 'use':
            writeLog("Processing USE action");
            // ... kode use seperti sebelumnya
            break;
            
        default:
            throw new Exception("Action tidak valid: $action");
    }
    
} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
        writeLog("Transaction rolled back");
    }
    
    $error_msg = $e->getMessage();
    writeLog("ERROR: $error_msg");
    writeLog("Stack trace: " . $e->getTraceAsString());
    
    $_SESSION['error'] = $error_msg;
    header("Location: eticket.php");
    exit;
}

writeLog("=== Script Ended ===\n");
?>