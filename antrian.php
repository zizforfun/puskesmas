<?php
include "koneksi/koneksi.php";
include "component/navbar.php";

// Ambil antrian yang statusnya masih menunggu
$query = "
    SELECT 
        a.id_antrian,
        a.no_antrian,
        a.tanggal_kunjungan,
        a.status,
        p.nama_lengkap,
        p.umur,
        p.no_hp,
        j.nama_poli
    FROM antrian a
    JOIN pasien p ON a.id_pasien = p.id_pasien
    JOIN jenis_poli j ON a.id_poli = j.id_poli
    WHERE a.status = 'menunggu'
    ORDER BY a.id_poli, a.no_antrian ASC
";

$result = mysqli_query($conn, $query);

// Kelompokkan berdasarkan poli
$antrian = [];
while ($row = mysqli_fetch_assoc($result)) {
    $antrian[$row['nama_poli']][] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Antrian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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

<body>

<div class="page-wrapper">

    <div class="content">
        <div class="container mt-5 pt-4">
            <h3 class="text-center fw-bold text-success mb-4">Cek Antrian Pasien</h3>

            <?php foreach ($antrian as $poli => $list): ?>
                <div class="card mb-4">
                    <div class="card-header bg-success text-white fw-bold">
                        <?= htmlspecialchars($poli); ?>
                    </div>
                    <div class="card-body">
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
                                <?php foreach ($list as $row): ?>
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
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include "component/footer.php"; ?>

</div>

</body>
</html>
