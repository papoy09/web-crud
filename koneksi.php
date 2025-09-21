<?php
$host = "localhost";   // biasanya 'localhost'
$user = "root";        // default user XAMPP
$pass = "";            // default password kosong
$db   = "kelompok_db";     // nama database kamu

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>