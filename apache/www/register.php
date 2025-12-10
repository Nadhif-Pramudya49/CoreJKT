<?php
require "config.php";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // cek apakah email sudah digunakan
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $existing = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing) {
        echo "Email sudah terdaftar!";
        exit;
    }

    // insert user baru
    $stmt = $pdo->prepare("INSERT INTO users (nama, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nama, $email, $password, "warga"]);

    header("Location: index.php?success=1");
    exit;
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

    <?php if($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <?php if($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form action="" method="POST" class="text-start mt-4" autocomplete="off">

      <div class="mb-3">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" required autocomplete="off">
      </div>

      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" 
               required autocomplete="new-email">
      </div>

      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" 
               required autocomplete="new-password">
      </div>

      <div class="mb-3">
        <label>Konfirmasi Password</label>
        <input type="password" name="confirm" class="form-control" 
               required autocomplete="new-password">
      </div>

      <button type="submit" class="btn btn-primary w-100">
        Daftar
      </button>

      <p class="mt-3 text-center">
        Sudah punya akun? <a href="index.php">Masuk di sini</a>
      </p>

    </form>
  </div>
</body>
</html>
