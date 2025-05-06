<?php
include "config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];

    // Pastikan password dan konfirmasi password cocok
    if ($newPassword !== $confirmPassword) {
        echo "<script>alert('Password dan konfirmasi password tidak cocok.'); window.location.href = 'resetPassword.php';</script>";
        exit;
    }

    // Hash password baru
    $hashedPassword = hash("sha256", $newPassword);

    // Update password
    $stmt = $conn->prepare("UPDATE tb_Users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $hashedPassword, $email);

    if ($stmt->execute()) {
        echo "<script>alert('Password berhasil diubah.'); window.location.href = 'login.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat mengubah password.'); window.location.href = 'resetPassword.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password | TripMate</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-red-600 mb-6">Reset Password</h2>
        <form action="resetPassword.php" method="POST">
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="new_password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                <input type="password" id="new_password" name="new_password" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" name="confirm_password" id="confirmPassword" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <input type="checkbox" id="showPassword" class="mr-2">
                <label for="showPassword" class="text-sm text-gray-700"> Tampilkan Password</label>
            </div>

            <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 font-semibold transition duration-300">Reset Password</button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            Kembali ke <a href="login.php" class="text-red-600 hover:text-red-700 font-semibold">Halaman Login</a>
        </p>
    </div>

    <script>
        document.querySelector("form").addEventListener("submit", function(event) {
            var password = document.getElementById("new_password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                event.preventDefault(); // Mencegah form untuk disubmit
                alert("Password dan konfirmasi password tidak cocok.");
            }
        });
    </script>
    <script>
        document.getElementById("showPassword").addEventListener("change", function () {
        var passwordField = document.getElementById("new_password");
        var confirmField = document.getElementById("confirmPassword");
        var type = this.checked ? "text" : "password";
        passwordField.type = type;
        confirmField.type = type;
    });
    </script>
</body>
</html>
