<?php
session_start();
require "config.php";


if (!isset($_SESSION["user"]["id"])) {
    header("Location: login.php");
    exit;
}


try {
    $sql = "SELECT id_laporan, kategori, lokasi, status, tanggal, foto
            FROM laporan
            WHERE id_user = :id_user
            ORDER BY tanggal DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ":id_user" => $_SESSION["user"]["id"]
    ]);

    $laporan_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $laporan_list = [];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Laporan Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container my-5">
    <h2 class="mb-4 text-center">📄 Riwayat Laporan Saya</h2>

    <?php if (empty($laporan_list)): ?>
        <div class="alert alert-info text-center">
            Anda belum memiliki laporan.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($laporan_list as $i => $lapor): ?>
                    <tr>
                        <td class="text-center"><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($lapor['kategori']) ?></td>
                        <td><?= htmlspecialchars($lapor['lokasi']) ?></td>

                       
                        <td class="text-center">
                            <?php
                            $badge = match ($lapor['status']) {
                                'pending' => 'warning',
                                'diproses' => 'info',
                                'selesai' => 'success',
                                'ditolak' => 'danger',
                                default => 'secondary'
                            };
                            ?>
                            <span class="badge bg-<?= $badge ?>">
                                <?= htmlspecialchars($lapor['status']) ?>
                            </span>
                        </td>

                       
                        <td class="text-center">
                            <?= date("d-m-Y H:i", strtotime($lapor['tanggal'])) ?>
                        </td>

                        
                        <td class="text-center">
                            <?php if (!empty($lapor['foto']) && file_exists("uploads/" . $lapor['foto'])): ?>

                             
                                <img
                                    src="uploads/<?= htmlspecialchars($lapor['foto']) ?>"
                                    class="img-thumbnail"
                                    style="width:80px; cursor:pointer"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fotoModal<?= $lapor['id_laporan'] ?>"
                                >

                               
                                <div class="modal fade" id="fotoModal<?= $lapor['id_laporan'] ?>" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Foto Laporan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img
                                                    src="uploads/<?= htmlspecialchars($lapor['foto']) ?>"
                                                    class="img-fluid rounded"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>

                      
                        <td class="text-center">
                            <?php if ($lapor['status'] === 'pending'): ?>
                                <button
                                    class="btn btn-sm btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#hapusModal"
                                    data-id="<?= $lapor['id_laporan'] ?>">
                                    Hapus
                                </button>
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <div class="mt-4 text-center">
        <a href="lapor.php" class="btn btn-secondary">← Kembali ke Lapor</a>
    </div>
</div>


<div class="modal fade" id="hapusModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">
                    ⚠️ Apakah Anda yakin ingin menghapus laporan ini?<br>
                    <small class="text-muted">Tindakan ini tidak dapat dibatalkan.</small>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Batal
                </button>
                <a href="#" id="btnHapus" class="btn btn-danger">
                    Ya, Hapus
                </a>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  const hapusModal = document.getElementById('hapusModal');
  hapusModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const id = button.getAttribute('data-id');
    document.getElementById('btnHapus').href = "hapus_laporan.php?id=" + id;
  });
</script>

</body>
</html>
