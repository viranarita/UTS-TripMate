<?php 
session_start();
include 'config.php'; 

$pageTitle = "Manage Culinaries";

function generateCulinaryID() {
    global $conn;
    $query = "SELECT MAX(culinary_id) as max_id FROM tb_Culinary";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $lastId = $row['max_id'];

    $newId = $lastId ? ((int)substr($lastId, 3)) + 1 : 1;
    return "CLN" . str_pad($newId, 3, '0', STR_PAD_LEFT);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['culinary_id'] ?? null;
    $name = $_POST['name'];
    $location = $_POST['location'];
    $price_range = $_POST['price_range'];

    $image_blob = null;
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
        $image_blob = addslashes(file_get_contents($_FILES['image_url']['tmp_name']));
    }

    if (!empty($id)) {
        // Update
        if ($image_blob) {
            $query = "UPDATE tb_Culinary 
                      SET name='$name', location='$location', price_range='$price_range', image_url='$image_blob' 
                      WHERE culinary_id='$id'";
        } else {
            $query = "UPDATE tb_Culinary 
                      SET name='$name', location='$location', price_range='$price_range' 
                      WHERE culinary_id='$id'";
        }
    } else {
        // Tambah
        $generatedID = generateCulinaryID();
        $query = "INSERT INTO tb_Culinary (culinary_id, name, location, price_range, image_url) 
                  VALUES ('$generatedID', '$name', '$location', '$price_range', '$image_blob')";
    }

    if ($conn->query($query) === TRUE) {
        header("Location: culinary.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM tb_Culinary WHERE culinary_id='$id'");
    header("Location: culinary.php");
    exit();
}

$result = $conn->query("SELECT * FROM tb_Culinary");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Culinaries</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body class="bg-gray-100">
    
    <?php include "sidebar.html"; ?>
    <?php include "headerAdmin.html"; ?>

    <section class="pt-24 w-full lg:w-[calc(100%-16rem)] lg:ml-64">
        <div class="flex justify-center mt-4">
            <div class="bg-white p-4 rounded-lg shadow-md w-3/4">
                <form method="POST" action="" enctype="multipart/form-data" id="culinaryForm">
                    <input type="hidden" name="culinary_id" id="culinaryId">
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
                            <label class="block text-gray-700 mb-2">Harga</label>
                            <select name="price_range" id="price_range" required class="w-full px-3 py-2 border rounded">
                                <option value="Murah">Murah</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Mahal">Mahal</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700">Gambar (JPG)</label>
                            <input type="file" name="image_url" id="image_url" accept=".jpg,.jpeg" class="w-full px-3 py-2 border rounded">
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
                            <th class="p-2 border">Harga</th>
                            <th class="p-2 border">Gambar</th>
                            <th class="p-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="text-center cursor-pointer" onclick="editCulinary('<?= $row['culinary_id'] ?>', '<?= addslashes($row['name']) ?>', '<?= addslashes($row['location']) ?>', '<?= $row['price_range'] ?>')">
                            <td class="p-2 border"><?= $row['culinary_id'] ?></td>
                            <td class="p-2 border"><?= $row['name'] ?></td>
                            <td class="p-2 border"><?= $row['location'] ?></td>
                            <td class="p-2 border"><?= $row['price_range'] ?></td>
                            <td class="p-2 border">
                                <?php if (!empty($row['image_url'])): ?>
                                    <img src="data:image/jpeg;base64,<?= base64_encode($row['image_url']) ?>" alt="Gambar" class="w-16 h-16 object-cover">
                                <?php else: ?>
                                    <span class="text-gray-500">No Image</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-2 border">
                                <a href="culinary.php?hapus=<?= $row['culinary_id'] ?>" class="bg-yellow-500 text-white px-2 py-1 rounded">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
    function editCulinary(id, name, location, price_range) {
        document.getElementById("culinaryId").value = id;
        document.getElementById("name").value = name;
        document.getElementById("location").value = location;
        document.getElementById("price_range").value = price_range;

        document.getElementById("addBtn").classList.add("hidden");
        document.getElementById("updateBtn").classList.remove("hidden");
    }

    function resetForm() {
        document.getElementById("culinaryId").value = "";
        document.getElementById("name").value = "";
        document.getElementById("location").value = "";
        document.getElementById("price_range").value = "Murah";
        document.getElementById("image_url").value = "";

        document.getElementById("addBtn").classList.remove("hidden");
        document.getElementById("updateBtn").classList.add("hidden");
    }

    document.getElementById("culinaryForm").addEventListener("submit", function(e) {
        const fileInput = document.getElementById("image_url");
        if (fileInput.files.length > 0) {
            const fileName = fileInput.files[0].name.toLowerCase();
            if (!fileName.endsWith(".jpg") && !fileName.endsWith(".jpeg")) {
                alert("Masukkan file JPG saja.");
                e.preventDefault();
            }
        }
    });
    </script>
</body>
</html>
