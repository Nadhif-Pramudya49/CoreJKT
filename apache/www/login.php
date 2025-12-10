<?php
session_start();
require "config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password === $user["password"]) { 
        // TODO: nanti password diganti hashed password_hash()
        $_SESSION["user"] = $user;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CoreJKT - Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0d6efd;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            background:white;
            padding:20px;
            border-radius:10px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h3 class="text-center text-primary mb-3">CoreJKT</h3>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <label class="form-label">Username</label>
        <input name="username" type="text" class="form-control mb-3" required>

        <label class="form-label">Password</label>
        <input name="password" type="password" class="form-control mb-3" required>

        <button class="btn btn-primary w-100">Masuk</button>
    </form>
</div>

</body>
</html>
