<?php
session_start();
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $data = $stmt->fetch();

    if (!$data) {
        die("User tidak ditemukan!");
    }
}

if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $password_baru = $_POST['password_baru'];
    $id_user = $_POST['id'];

    try {
        // Jika password diisi, maka update username DAN password
        if (!empty($password_baru)) {
            // Menggunakan password_hash untuk keamanan (standar industri)
            $hashed_password = password_hash($password_baru, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET username = ?, password = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$username, $hashed_password, $id_user]);
        } else {
            // Jika password kosong, hanya update username saja
            $sql = "UPDATE users SET username = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$username, $id_user]);
        }

        $_SESSION['user']['username'] = $username;
        echo "<script>alert('Data berhasil diperbarui!'); window.location='index.php';</script>";
    } catch (PDOException $e) {
        echo "Gagal update: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil | Portal DKI Jakarta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .card {
            border: none;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.95);
        }

        .card-header {
            background-color: #00468c !important;
            color: white;
            border: none;
            padding: 1.5rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
        }

        .btn-primary {
            background-color: #00468c;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
        }

        .input-group-text {
            background-color: transparent;
            border-right: none;
            border-radius: 10px 0 0 10px;
        }

        .form-control-with-icon {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="text-center mb-4">
                    <i class="fas fa-user-shield fa-4x text-primary shadow-sm rounded-circle bg-white p-2"></i>
                    <h4 class="mt-3 fw-bold text-dark">Keamanan Akun</h4>
                </div>
                <div class="card shadow-lg">
                    <div class="card-header text-center">
                        <h5 class="mb-0 fw-bold">Edit Profil & Password</h5>
                        <small class="opacity-75">Kosongkan password jika tidak ingin diubah</small>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST">
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-secondary">Username / Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope text-muted"></i></span>
                                    <input type="text" name="username" class="form-control form-control-with-icon"
                                        value="<?= htmlspecialchars($data['username']) ?>" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold text-secondary">Password Baru</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock text-muted"></i></span>
                                    <input type="password" name="password_baru"
                                        class="form-control form-control-with-icon"
                                        placeholder="Ketik password baru jika ingin ganti">
                                </div>
                                <div class="form-text mt-2" style="font-size: 0.75rem;">
                                    <i class="fas fa-info-circle me-1"></i> Biarkan kosong jika tetap menggunakan
                                    password lama.
                                </div>
                            </div>

                            <div class="d-grid gap-3">
                                <button type="submit" name="update" class="btn btn-primary">
                                    <i class="fas fa-check-circle me-2"></i> Simpan Perubahan
                                </button>
                                <a href="index.php" class="btn btn-outline-secondary text-muted">
                                    <i class="fas fa-times me-2"></i> Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>