<?php
include "koneksi/koneksi.php"; // koneksi ke database

$query = "SELECT * FROM pasien ORDER BY no_pasien ASC";
$result = mysqli_query($koneksi, $query);

$antrian = [
    'A' => [],
    'G' => [],
    'U' => []
];

while ($row = mysqli_fetch_assoc($result)) {
    $prefix = substr($row['no_pasien'], 0, 1);
    if (isset($antrian[$prefix])) {
        $antrian[$prefix][] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Antrian Pasien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color: #f8f9fa;">

<div class="container mt-5">
    <h3 class="text-center fw-bold text-primary mb-4">Daftar Antrian Pasien</h3>

    <?php
    $poliLabels = [
        'A' => ['Poli Anak', 'success'],
        'G' => ['Poli Gigi', 'danger'],
        'U' => ['Poli Umum', 'info']
    ];

    foreach ($antrian as $kode => $pasienList):
        [$label, $color] = $poliLabels[$kode];
    ?>
    <div class="card mb-4 border-<?= $color ?>">
        <div class="card-header bg-<?= $color ?> text-white fw-bold"><?= $label ?></div>
        <div class="card-body">
            <?php if (count($pasienList) > 0): ?>
            <table class="table table-bordered table-sm">
                <thead class="table-light text-center">
                    <tr>
                        <th>No. Pasien</th>
                        <th>Nama</th>
                        <th>Umur</th>
                        <th>No. HP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pasienList as $pasien): ?>
                    <tr>
                        <td class="text-center"><?= htmlspecialchars($pasien['no_pasien']) ?></td>
                        <td><?= htmlspecialchars($pasien['nama_lengkap']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($pasien['umur']) ?></td>
                        <td><?= htmlspecialchars($pasien['no_hp']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p class="text-muted text-center">Belum ada pasien di <?= $label ?>.</p>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>

    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-outline-secondary">⬅ Kembali ke Menu Utama</a>
    </div>
</div>

</body>
</html>