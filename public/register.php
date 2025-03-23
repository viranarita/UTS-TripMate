<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password

    // Periksa apakah email sudah digunakan
    $checkEmail = "SELECT email FROM tb_Users WHERE email = ?";
    $stmt = $conn->prepare($checkEmail);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Email sudah terdaftar"]);
    } else {
        // Simpan pengguna baru ke database
        $insertUser = "INSERT INTO tb_Users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertUser);
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Registrasi berhasil, silakan login"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Terjadi kesalahan saat registrasi"]);
        }
    }

    $stmt->close();
    $conn->close();
}
?>
