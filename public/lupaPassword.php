<?php
include "config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];

    // Cek apakah email terdaftar
    $stmt = $conn->prepare("SELECT * FROM tb_Users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Di tahap ini kamu bisa generate token dan simpan di DB

        // Redirect ke halaman sukses atau tampilkan pesan
        echo "<script>alert('Link reset akan dikirim ke email Anda'); window.location.href = 'resetpassword.php';</script>";
    } else {
        echo "<script>alert('Email tidak ditemukan.'); window.location.href = 'lupaPassword.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password | TripMate</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-red-600 mb-6">Lupa Password</h2>
        <p class="text-sm text-gray-600 mb-4 text-center">Masukkan email yang terdaftar, kami akan kirimkan instruksi reset password.</p>
        
        <form action="lupaPassword.php" method="POST">
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 font-semibold transition duration-300">Kirim</button>
        </form>
        
        <p class="text-center text-sm text-gray-600 mt-4">
            Kembali ke <a href="login.php" class="text-red-600 hover:text-red-700 font-semibold">Halaman Login</a>
        </p>
    </div>
</body>
</html>
