<?php
include "koneksi/koneksi.php";
include "component/navbar.php";

// Ambil antrian yang statusnya masih menunggu
$poliResult = mysqli_query($conn, "SELECT id_poli, nama_poli FROM jenis_poli");
$allPoli = [];
while ($row = mysqli_fetch_assoc($poliResult)) {
    $allPoli[$row['id_poli']] = $row['nama_poli'];
}

// Ambil antrian menunggu
$query = "
    SELECT 
        a.id_antrian,
        a.no_antrian,
        a.tanggal_kunjungan,
        a.status,
        p.nama_lengkap,
        p.umur,
        p.no_hp,
        j.id_poli,
        j.nama_poli
    FROM antrian a
    JOIN pasien p ON a.id_pasien = p.id_pasien
    JOIN jenis_poli j ON a.id_poli = j.id_poli
    WHERE a.status = 'menunggu'
    ORDER BY a.id_poli, a.no_antrian ASC
";
$result = mysqli_query($conn, $query);

$antrian = [];
while ($row = mysqli_fetch_assoc($result)) {
    $antrian[$row['id_poli']][] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Antrian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
        }
        .page-wrapper {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }
        .content {
            flex: 1;
        }
    </style>
</head>
<?php include 'component/navbar.php'; ?>
<body>

<div class="page-wrapper">

    <div class="content">
        <div class="container mt-5 pt-4">
    <h3 class="text-center fw-bold text-success mb-4">Cek Antrian Pasien</h3>

    <?php foreach ($allPoli as $id_poli => $nama_poli): ?>
        <div class="card shadow-sm poli-<?= strtolower(str_replace(' ', '-', str_replace('Poli ', '', $nama_poli))) ?>">
            <div class="card-header poli-head-<?= strtolower(str_replace(' ', '-', str_replace('Poli ', '', $nama_poli))) ?>">
                <?= htmlspecialchars($nama_poli); ?>
            </div>
            <div class="card-body">
                <?php if (empty($antrian[$id_poli])): ?>
                    <div class="alert alert-info text-center">
                        Tidak ada antrian menunggu untuk poli ini.
                    </div>
                <?php else: ?>
                    <table class="table table-bordered table-sm text-center">
                        <thead class="table-light">
                            <tr>
                                <th>No Antrian</th>
                                <th>Nama Pasien</th>
                                <th>Umur</th>
                                <th>No HP</th>
                                <th>Tanggal Kunjungan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($antrian[$id_poli] as $row): ?>
                            <tr>
                                <td><?= $row['no_antrian'] ?></td>
                                <td><?= $row['nama_lengkap'] ?></td>
                                <td><?= $row['umur'] ?></td>
                                <td><?= $row['no_hp'] ?></td>
                                <td><?= $row['tanggal_kunjungan'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
    </div>

    <?php include "component/footer.php"; ?>

</div>

</body>
</html>
