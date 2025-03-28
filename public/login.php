<?php
include "config.php"; // Menggunakan konfigurasi database
session_start();

if (isset($_SESSION["is_login"])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['login'])) {
    $email = $_POST['email']; 
    $password = $_POST['password'];
    $hash_password = hash("sha256", $password);

    // Gunakan prepared statement untuk keamanan
    $sql = $conn->prepare("SELECT * FROM tb_users WHERE email = ? AND password = ?");
    $sql->bind_param("ss", $email, $hash_password);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION["email"] = $data["email"];
        $_SESSION["is_login"] = true;

        // Cek apakah email adalah admin
        if ($email === "admin@admin.com") {
            $_SESSION["is_admin"] = true; // Tandai sebagai admin
            header("Location: dashboard.php");
        } else {
            $_SESSION["is_admin"] = false; // Tandai sebagai user biasa
            header("Location: index.php");
        }
        exit();
    } else {
        echo "Login gagal! Periksa email atau password.";
    }

    $sql->close();
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | TripMate</title>
    <link rel="stylesheet" href="style.css"/>
    <style>x
        .hidden {
            display: none;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <!-- Halaman Login -->
    <div id="loginPage" class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-red-600 mb-6">Login ke TripMate</h2>
        
        <form id="loginForm" action="login.php" method="POST">
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500" placeholder="Masukkan email" name="email" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500" placeholder="Masukkan password" name="password" required>
            </div>

            <button type="submit" name="login" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 font-semibold transition duration-300">Login</button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            Belum punya akun? <a href="#" id="showRegister" class="text-red-600 hover:text-red-700 font-semibold">Buat Akun Baru</a>
        </p>
    </div>

    <!-- Halaman Register -->
    <i><?= $register_message ?></i>
    <div id="registerPage" class="hidden bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-red-600 mb-6 ">Buat Akun TripMate</h2>
        
        <form id="registerForm" action="register.php" method="POST">
            <div class="mb-4">
                <label for="newName" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" id="newName" class="w-full px-4 py-2 border rounded-lg" placeholder="Masukkan nama" required>
            </div>

            <div class="mb-4">
                <label for="newEmail" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="newEmail" class="w-full px-4 py-2 border rounded-lg" placeholder="Masukkan email" required>
            </div>

            <div class="mb-4">
                <label for="newPassword" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="newPassword" class="w-full px-4 py-2 border rounded-lg" placeholder="Buat password" required>
            </div>

            <div class="mb-4">
                <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" name="confirm_password" id="confirmPassword" class="w-full px-4 py-2 border rounded-lg" placeholder="Ulangi password" required>
            </div>

            <button type="submit" name="register" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 font-semibold transition duration-300">
                Daftar
            </button>
        </form>


        <p class="text-center text-sm text-gray-600 mt-4">
            Sudah punya akun? <a href="#" id="showLogin" class="text-red-600 hover:text-red-700 font-semibold">Login</a>
        </p>
    </div>

    <script src="js/script.js"></script>

</body>
</html>
