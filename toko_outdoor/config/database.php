<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "toko_outdoor"; // Pastikan nama DB sesuai dengan yang dibuat di phpMyAdmin

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}
?>