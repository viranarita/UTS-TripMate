<?php
$servername = "localhost"; // Sesuaikan dengan konfigurasi server Anda
$username = "root"; // Ganti sesuai username MySQL Anda
$password = ""; // Ganti sesuai password MySQL Anda
$dbname = "db_tripmate";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>