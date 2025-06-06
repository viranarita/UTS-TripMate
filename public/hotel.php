<?php 
session_start();
include 'config.php'; 

$pageTitle = "Manage Hotels";

// Fungsi untuk generate ID otomatis HTL001, HTL002, ...
function generateID() {
    global $conn;

    // Ambil ID terbesar saat ini
    $query = "SELECT MAX(hotel_id) as max_id FROM tb_Hotels";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $lastId = $row['max_id'];

    if ($lastId) {
        // Ambil angka dari HTLxxx
        $num = (int)substr($lastId, 3);
        $newId = $num + 1;
    } else {
        $newId = 1;
    }

    return "HTL" . str_pad($newId, 3, '0', STR_PAD_LEFT);
}

// Ambil ID terbaru untuk ditampilkan di form
$autoID = generateID();

// Ambil data dari database
$result = $conn->query("SELECT * FROM tb_Hotels");

// Tambah / Update Data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['hotel_id'] ?? null;
    $name = $_POST['name'];
    $location = $_POST['location'];
    $price_per_night = $_POST['price_per_night'];

    // Proses upload gambar
    $image_blob = null;
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
        $image_blob = addslashes(file_get_contents($_FILES['image_url']['tmp_name']));
    }

    if (!empty($id)) {
        // Update Data
        if ($image_blob) {
            $query = "UPDATE tb_Hotels 
                      SET name='$name', location='$location', price_per_night='$price_per_night', image_url='$image_blob' 
                      WHERE hotel_id='$id'";
        } else {
            $query = "UPDATE tb_Hotels 
                      SET name='$name', location='$location', price_per_night='$price_per_night' 
                      WHERE hotel_id='$id'";
        }
    } else {
        // Tambah data baru
        $generatedID = generateID();
        $query = "INSERT INTO tb_Hotels (hotel_id, name, location, price_per_night, image_url) 
                  VALUES ('$generatedID', '$name', '$location', '$price_per_night', '$image_blob')";
    }

    if ($conn->query($query) === TRUE) {
        header("Location: hotel.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

// Hapus Data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM tb_Hotels WHERE hotel_id='$id'");
    header("Location: hotel.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Hotels</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body class="bg-gray-100">
    
    <?php include "sidebar.html"; ?>
    <?php include "headerAdmin.html"; ?>

    <section class="pt-24 w-full lg:w-[calc(100%-16rem)] lg:ml-64">
        <div class="flex justify-center mt-4">
            <div class="bg-white p-4 rounded-lg shadow-md w-3/4">
                <form method="POST" action="" enctype="multipart/form-data">
                    <input type="hidden" name="hotel_id" id="hotelId">
                    <div class="grid grid-cols-1 gap-8">
                        <div>
                            <label class="block text-gray-700">Nama</label>
                            <input type="text" name="name" id="name" required class="w-full px-3 py-2 border rounded">
                        </div>
                        <div>
                            <label class="block text-gray-700">Lokasi (Kota)</label>
                            <input type="text" name="location" id="location" required class="w-full px-3 py-2 border rounded">
                        </div>
                        <div>
                            <label class="block text-gray-700">Harga</label>
                            <input type="number" name="price_per_night" id="price_per_night" required class="w-full px-3 py-2 border rounded">
                        </div>
                        <div>
                            <label class="block text-gray-700">Gambar (File)</label>
                            <input type="file" name="image_url" id="image_url" class="w-full px-3 py-2 border rounded">
                        </div>
                    </div>
                    <div class="mt-4 flex justify-between">
                        <button type="submit" id="addBtn" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah</button>
                        <button type="submit" id="updateBtn" class="bg-green-500 text-white px-4 py-2 rounded hidden">Update</button>
                        <button type="button" onclick="resetForm()" class="bg-gray-400 text-white px-4 py-2 rounded">Reset</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="flex justify-center mt-4 mb-4">
            <div class="bg-white p-4 rounded-lg shadow-md w-3/4">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-red-600 text-white">
                            <th class="p-2 border">ID</th>
                            <th class="p-2 border">Nama</th>
                            <th class="p-2 border">Lokasi (Kota)</th>
                            <th class="p-2 border">Harga Per Malam</th>
                            <th class="p-2 border">Gambar</th>
                            <th class="p-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="text-center cursor-pointer" onclick="editHotel('<?= $row['hotel_id'] ?>', '<?= addslashes($row['name']) ?>', '<?= addslashes($row['location']) ?>', '<?= $row['price_per_night'] ?>')">
                            <td class="p-2 border"><?= $row['hotel_id'] ?></td>
                            <td class="p-2 border"><?= $row['name'] ?></td>
                            <td class="p-2 border"><?= $row['location'] ?></td>
                            <td class="p-2 border"><?= $row['price_per_night'] ?></td>
                            <td class="p-2 border">
                                <?php if (!empty($row['image_url'])): ?>
                                    <img src="data:image/jpeg;base64,<?= base64_encode($row['image_url']) ?>" alt="Gambar" class="w-16 h-16 object-cover">
                                <?php else: ?>
                                    <span class="text-gray-500">No Image</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-2 border">
                                <a href="hotel.php?hapus=<?= $row['hotel_id'] ?>" class="bg-yellow-500 text-white px-2 py-1 rounded">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
    function editHotel(id, name, location, price_per_night) {
        document.getElementById("hotelId").value = id;
        document.getElementById("name").value = name;
        document.getElementById("location").value = location;
        document.getElementById("price_per_night").value = price_per_night;

        document.getElementById("addBtn").classList.add("hidden");
        document.getElementById("updateBtn").classList.remove("hidden");
    }

    function resetForm() {
        document.getElementById("hotelId").value = "";
        document.getElementById("name").value = "";
        document.getElementById("location").value = "";
        document.getElementById("price_per_night").value = "";
        document.getElementById("image_url").value = "";

        document.getElementById("addBtn").classList.remove("hidden");
        document.getElementById("updateBtn").classList.add("hidden");
    }

    document.getElementById("hotelForm").addEventListener("submit", function(e) {
        const fileInput = document.getElementById("image_url");
        if (fileInput.files.length > 0) {
            const fileName = fileInput.files[0].name.toLowerCase();
            if (!fileName.endsWith(".jpg") && !fileName.endsWith(".jpeg")) {
                alert("Masukkan file JPG saja.");
                e.preventDefault(); // Mencegah form dikirim
            }
        }
    });
    </script>
</body>
</html>
