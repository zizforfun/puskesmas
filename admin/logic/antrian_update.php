<?php
include '../../koneksi/koneksi.php';

$id = $_GET['id'];
$status = $_GET['status'];

mysqli_query($conn, "UPDATE antrian SET status='$status' WHERE id_antrian='$id'");

header("Location: ../antrian.php");
exit();
