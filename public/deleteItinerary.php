<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Pastikan ID adalah angka

    // Cek apakah ID valid
    if ($id <= 0) {
        die("Invalid ID!");
    }

    // Siapkan query DELETE
    $stmt = $conn->prepare("DELETE FROM tb_Itinerary WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: planning.php");
        exit(); // Penting agar tidak ada eksekusi lebih lanjut
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid Request!";
}

$conn->close();
?>
