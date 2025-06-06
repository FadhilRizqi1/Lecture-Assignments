<?php
require_once 'koneksi.php';
$data_kursus_array = [];
$sql = "SELECT K.nama_kursus, K.deskripsi, I.nama_instruktur
        FROM Kursus K
        LEFT JOIN Instruktur I ON K.id_instruktur = I.id_instruktur
        ORDER BY K.nama_kursus ASC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data_kursus_array[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kursus Tersedia</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Manajemen Kursus UTS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="form_tambah_user.php">Tambah Pengguna</a></li>
                    <li class="nav-item"><a class="nav-link" href="form_reg_kursus.php">Pendaftaran Kursus</a></li>
                    <li class="nav-item"><a class="nav-link active" href="list_kursus.php">Daftar Kursus <span
                                class="sr-only">(current)</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="cari_peserta.php">Cari Peserta</a></li>
                    <li class="nav-item"><a class="nav-link" href="lap_pendaftar.php">Laporan Pendaftar</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h2>Daftar Kursus Tersedia</h2>
        <?php if (!empty($data_kursus_array)): ?>
        <div class="list-group mt-3">
            <?php foreach ($data_kursus_array as $kursus): ?>
            <div class="list-group-item">
                <h5 class="mb-1"><?php echo htmlspecialchars($kursus['nama_kursus']); ?></h5>
                <p class="mb-1">
                    <strong>Instruktur:</strong>
                    <?php echo htmlspecialchars($kursus['nama_instruktur'] ?? 'Belum ada instruktur'); ?>
                </p>
                <small class="text-muted">
                    <?php echo !empty($kursus['deskripsi']) ? htmlspecialchars($kursus['deskripsi']) : 'Tidak ada deskripsi.'; ?>
                </small>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="alert alert-info mt-3">Tidak ada kursus yang tersedia saat ini.</div>
        <?php endif; ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<?php
if (isset($conn)) {
    $conn->close();
}
?>