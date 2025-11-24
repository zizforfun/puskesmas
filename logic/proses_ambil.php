<?php
include "../koneksi/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $poli             = $_POST['poli'];
    $NIK              = $_POST['NIK'];
    $nama_lengkap     = $_POST['nama_lengkap'];
    $tanggal_lahir    = $_POST['tanggal_lahir'];
    $Jenis_Kelamin    = $_POST['Jenis_Kelamin'];
    $umur             = $_POST['umur'];
    $alamat           = $_POST['alamat'];
    $status_pernikahan= $_POST['status_pernikahan'];
    $no_hp            = $_POST['no_hp'];

    // --- Generate nomor pasien otomatis ---
    $query = "SELECT no_pasien FROM pasien 
              WHERE no_pasien LIKE '{$poli}%' 
              ORDER BY no_pasien DESC LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $lastNumber = (int)substr($row['no_pasien'], 1); // ambil angka setelah prefix
        $newNumber  = $lastNumber + 1;
    } else {
        $newNumber = 1;
    }

    $formattedNumber = str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    $no_pasien = $poli . $formattedNumber;

    // --- Simpan ke database ---
    $sql = "INSERT INTO pasien 
            (no_pasien, NIK, nama_lengkap, tanggal_lahir, poli, Jenis_Kelamin, umur, alamat, status_pernikahan, no_hp) 
            VALUES 
            ('$no_pasien', '$NIK', '$nama_lengkap', '$tanggal_lahir', '$poli', '$Jenis_Kelamin', '$umur', '$alamat', '$status_pernikahan', '$no_hp')";

    if (mysqli_query($conn, $sql)) {
        // redirect ke halaman ambilantrian dengan pesan sukses
        header("Location: ../ambilantrian.php?msg=Antrian berhasil diambil. Nomor pasien: $no_pasien");
        exit;
    } else {
        // redirect dengan pesan error
        header("Location: ../ambilantrian.php?msg=Terjadi kesalahan: " . mysqli_error($conn));
        exit;
    }
}
?>