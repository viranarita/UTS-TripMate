<?php
include 'config.php'; 

$id = $_GET['id'];

// Query untuk mengambil gambar dari tabel tb_Attractions
$sql1 = "SELECT image_url FROM tb_Attractions WHERE attraction_id = ?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("s", $id);
$stmt1->execute();
$stmt1->store_result();

if ($stmt1->num_rows > 0) {
    $stmt1->bind_result($imageData1);
    $stmt1->fetch();

    header("Content-Type: image/jpeg");
    echo $imageData1;
} else {
    // Jika gambar dari tb_Attractions tidak ditemukan, coba ambil gambar dari tb_Culinary
    $sql2 = "SELECT image_url FROM tb_Culinary WHERE culinary_id = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("s", $id);
    $stmt2->execute();
    $stmt2->store_result();

    if ($stmt2->num_rows > 0) {
        $stmt2->bind_result($imageData2);
        $stmt2->fetch();

        header("Content-Type: image/jpeg");
        echo $imageData2;
    } else {
        // Jika gambar dari tb_Culinary tidak ditemukan, coba ambil gambar dari tb_Hotels
        $sql3 = "SELECT image_url FROM tb_Hotels WHERE hotel_id = ?";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->bind_param("s", $id);
        $stmt3->execute();
        $stmt3->store_result();

        if ($stmt3->num_rows > 0) {
            $stmt3->bind_result($imageData3);
            $stmt3->fetch();

            header("Content-Type: image/jpeg");
            echo $imageData3;
        } else {
            // Jika gambar dari ketiga tabel tidak ditemukan
            http_response_code(404);
            echo "Gambar tidak ditemukan.";
        }

        $stmt3->close();
    }

    $stmt2->close();
}

$stmt1->close();
$conn->close();
?>
