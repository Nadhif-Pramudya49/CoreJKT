<?php
require "config.php";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nama = trim($_POST["nama"]);
  $email = trim($_POST["email"]);
  $password = $_POST["password"];
  $confirm = $_POST["confirm"];

  // Validasi input
  if (empty($nama) || empty($email) || empty($password)) {
    $error = "Semua field harus diisi!";
  } elseif ($password !== $confirm) {
    $error = "Konfirmasi password tidak cocok!";
  } elseif (strlen($password) < 6) {
    $error = "Password minimal 6 karakter!";
  } else {
    try {
      // Cek apakah email sudah terdaftar
      $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
      $stmt->execute([$email]);
      
      if ($stmt->fetch()) {
        $error = "Email sudah terdaftar!";
      } else {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert user baru
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, nama, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$email, $email, $hashed_password, $nama]);
        
        $success = "Registrasi berhasil! Silakan <a href='login.php'>login</a>";
      }
    } catch (PDOException $e) {
      $error = "Terjadi kesalahan: " . $e->getMessage();
    }
  }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Register - CoreJKT</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>

<body class="login-body">
  <div class="login-container text-center">

    <img src="assets/Logo1.png" width="200" class="mb-3">
    <h3 class="fw-bold">Daftar Akun</h3>
    <p>Buat akun untuk mengakses layanan CoreJKT</p>

    <?php if ($error): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
      <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form action="" method="POST" class="text-start mt-4" autocomplete="off">

      <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required autocomplete="off" 
               value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '' ?>">
      </div>

      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required autocomplete="new-email"
               value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
      </div>

      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required autocomplete="new-password"
               minlength="6">
        <small class="text-red">Minimal 6 karakter</small>
      </div>

      <div class="mb-3">
        <label>Konfirmasi Password</label>
        <input type="password" name="confirm" class="form-control" required autocomplete="new-password">
      </div>

      <button type="submit" class="btn btn-primary w-100">
        Daftar
      </button>

      <p class="mt-3 text-center">
        Sudah punya akun? <a href="login.php">Masuk di sini</a>
      </p>

    </form>
  </div>
</body>

</html>