<?php
session_start();
require "config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Cari user berdasarkan email atau username
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->execute([$email, $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {

        // Set session
        $_SESSION["user"] = [
            "id" => $user["id"],
            "username" => $user["username"],
            "nama" => $user["nama"],
            "email" => $user["email"]
        ];

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
    <h3 class="fw-bold">Login CoreJKT</h3>
    <p>Masuk untuk melanjutkan</p>

    <?php if ($error): ?>
      <div class="alert alert-danger">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <form method="POST" class="text-start mt-4" autocomplete="off">

      <div class="mb-3">
        <label>Email</label>
        <input 
          type="text" 
          name="email" 
          class="form-control" 
          required
          value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
      </div>

      <div class="mb-3">
        <label>Password</label>
        <input 
          type="password" 
          name="password" 
          class="form-control" 
          required>
      </div>

      <button type="submit" class="btn btn-primary w-100">
        Masuk
      </button>

    </form>

    <p class="mt-3 text-center">
      Belum punya akun?
      <a href="register.php">Registrasi di sini</a>
    </p>

    <p class="text-center mt-2">
      <a href="index.php">← Kembali ke beranda</a>
    </p>
  </div>

</body>
</html>