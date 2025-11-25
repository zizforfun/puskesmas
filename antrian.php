<?php
include "koneksi/koneksi.php";
include "component/navbar.php";
require_once './logic/auth.php';

// Ambil semua data pasien
$query = "SELECT * FROM pasien ORDER BY no_pasien ASC";
$result = mysqli_query($conn, $query);

// Kelompokkan pasien berdasarkan poli
$antrian = [
    'Anak' => [],
    'Gigi' => [],
    'Umum' => []
];

while ($row = mysqli_fetch_assoc($result)) {
    if (isset($antrian[$row['poli']])) {
        $antrian[$row['poli']][] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Antrian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 pt-5">
    <h3 class="text-center fw-bold text-primary mb-4">Daftar Antrian Pasien</h3>

    <?php
    $poliLabels = [
        'Anak' => ['Poli Anak', 'success'],
        'Gigi' => ['Poli Gigi', 'danger'],
        'Umum' => ['Poli Umum', 'info']
    ];

    foreach ($antrian as $kode => $pasienList):
        [$label, $color] = $poliLabels[$kode];
    ?>
    <div class="card mb-4 border-<?= $color ?>">
        <div class="card-header bg-<?= $color ?> text-white fw-bold"><?= $label ?></div>
        <div class="card-body">
            <?php if (count($pasienList) > 0): ?>
            <table class="table table-bordered table-sm text-center">
                <thead class="table-light">
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
                        <td><?= htmlspecialchars($pasien['no_pasien']) ?></td>
                        <td><?= htmlspecialchars($pasien['nama_lengkap']) ?></td>
                        <td><?= htmlspecialchars($pasien['umur']) ?></td>
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
<?php include "component/footer.php"; ?>
</body>
</html>
