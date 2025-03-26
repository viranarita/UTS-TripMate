<?php
include 'config.php';
session_start();

if(isset($_POST["register"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hash_password = hash("sha256", $password);

    // Gunakan prepared statement untuk keamanan
    $sql = $conn->prepare("INSERT INTO tb_users (name, email, password) VALUES (?, ?, ?)");
    $sql->bind_param("sss", $name, $email, $hash_password);

    try {
        if ($sql->execute()) {
            // Auto-login setelah berhasil registrasi
            $_SESSION['is_login'] = true;
            $_SESSION['user_id'] = $conn->insert_id; // Ambil ID user yang baru dibuat
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;

            header("Location: index.php");
            exit();
        } else {
            echo "Daftar akun gagal, silakan coba lagi.";
        }
    } catch (mysqli_sql_exception $e) {
        echo "Email sudah dipakai, gunakan email lain.";
    }

    $sql->close();
    $conn->close();
} else {
    echo "Invalid request!";
}
?>
