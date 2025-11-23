<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "puskema_aziz"; 

$koneksi = mysqli_connect($host, $user, $pass, $database);
if(!$koneksi){
    die("koneksi gagal");
}
