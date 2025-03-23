<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php'; // Pastikan ada koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $list_name = $_POST['list_name'];
    $departure_date = $_POST['departure_date'];
    $return_date = $_POST['return_date'];
    $departure_city = $_POST['departure_city'];
    $destination_city = $_POST['destination_city'];
    $user_id = 1; // HARDCODED, nanti sesuaikan dengan sesi login

    // Cek apakah tanggal kembali valid
    if (strtotime($return_date) < strtotime($departure_date)) {
        die("Tanggal kembali harus lebih besar atau sama dengan tanggal keberangkatan.");
    }

    // Query insert
    $stmt = $conn->prepare("INSERT INTO tb_Itinerary (user_id, list_name, departure_date, return_date, departure_city, destination_city) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $user_id, $list_name, $departure_date, $return_date, $departure_city, $destination_city);

    if ($stmt->execute()) {
        echo "Data berhasil disimpan!";
        header("Location: planning.php?success=1"); // Redirect kembali ke form setelah berhasil
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Akses tidak valid!";
}
?>
