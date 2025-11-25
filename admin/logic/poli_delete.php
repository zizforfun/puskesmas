<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'petugas') {
    header("Location: ../login.php");
    exit();
}
include '../../koneksi/koneksi.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM jenis_poli WHERE id_poli='$id'");

header("Location: poli.php");
exit();