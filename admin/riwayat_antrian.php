<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'petugas') {
    header("Location: ../login.php");
    exit();
}

include '../koneksi/koneksi.php';
include 'partials/header.php';
include 'partials/sidebar.php';

// Ambil data riwayat antrian
$query = "
    SELECT 
        r.*,
        p.nama_lengkap,
        j.nama_poli
    FROM riwayat_antrian r
    LEFT JOIN pasien p ON r.id_pasien = p.id_pasien
    LEFT JOIN jenis_poli j ON r.id_poli = j.id_poli
    ORDER BY r.id_riwayat DESC
";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Antrian</title>
    <link href="assets/style.css" rel="stylesheet">
</head>

<body>

<div class="container-fluid">

    <h2 class="mb-4">Riwayat Antrian</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-success">
            <tr>
                <th>No</th>
                <th>No Antrian</th>
                <th>Nama Pasien</th>
                <th>Poli</th>
                <th>No Urut</th>
                <th>Status</th>
                <th>Tanggal Kunjungan</th>
                <th>Waktu Dihapus</th>
            </tr>
        </thead>

        <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><b><?= $row['no_antrian']; ?></b></td>
                <td><?= $row['nama_lengkap']; ?></td>
                <td><?= $row['nama_poli']; ?></td>
                <td><?= $row['no_urut']; ?></td>

                <td>
                    <?php 
                        if ($row['status'] == 'menunggu') {
                            echo "<span class='badge bg-warning text-dark'>Menunggu</span>";
                        } elseif ($row['status'] == 'selesai') {
                            echo "<span class='badge bg-success'>Selesai</span>";
                        } else {
                            echo "<span class='badge bg-danger'>Batal</span>";
                        }
                    ?>
                </td>

                <td><?= $row['tanggal_kunjungan']; ?></td>
                <td><?= $row['waktu_dihapus']; ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>

    </table>

</div>

</body>
</html>

<?php include 'partials/footer.php'; ?>
