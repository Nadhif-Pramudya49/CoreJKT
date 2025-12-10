<?php
session_start();
require "config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    // Ambil user dari DB berdasarkan email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {

        $_SESSION["user"] = $user;
        header("Location: dashboard.php");
        exit;

    } else {
        $error = "Email atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Login - CoreJKT</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>

<body class="login-body">

  <div class="login-container text-center">
    <img src="assets/Logo1.png" width="200" class="mb-3">
    <h3 class="fw-bold">CoreJKT</h3>
    <p>Portal Layanan Digital Jakarta</p>

    <?php if ($error): ?>
        <div class="alert alert-danger">
          <?= $error ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="text-start mt-4" autocomplete="off">

      <div class="mb-3">
        <label>Email</label>
        <input type="text" name="email" class="form-control" required autocomplete="email">
      </div>

      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required autocomplete="current-password">
      </div>

      <button type="submit" class="btn btn-primary w-100">
        Masuk
      </button>

    </form>

    <p class="mt-3 text-center">
      Belum punya akun?
      <a href="register.php">Registrasi di sini</a>
    </p>

  </div>

</body>

</html>
