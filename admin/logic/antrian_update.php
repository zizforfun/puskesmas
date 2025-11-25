<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'petugas') {
    header("Location: ../login.php");
    exit();
}

include '../../koneksi/koneksi.php';

$id = $_GET['id'];
$status = $_GET['status'];

// Update status antrian
mysqli_query($koneksi, "UPDATE antrian SET status='$status' WHERE id_antrian='$id'");

header("Location: antrian.php");
exit();