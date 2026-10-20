<?php
$host     = "localhost";
$user     = "root";
$password = "123456"; 
$database = "db_informasi_kantin";

$koneksi = mysqli_connect($host, $user, $password, $database);

if (!$koneksi) {
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}
?>