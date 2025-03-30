<?php 
session_start();
include 'config.php'; 

$pageTitle = "Manage Packages";

// Ambil data dari database
$result = $conn->query("SELECT * FROM tb_Packages");

// Tambah / Update Data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['package_id'] ?? null;
    $name = $_POST['name'];
    $details = $_POST['details'];
    $price = $_POST['price'];

    if (!empty($id)) {
        // Update Data
        $query = "UPDATE tb_Packages 
                  SET name='$name', details='$details', price='$price' 
                  WHERE package_id='$id'";
    } else {
        // Tambah data baru
        $query = "INSERT INTO tb_Packages (name, details, price) 
                  VALUES ('$name', '$details', '$price')";
    }

    if ($conn->query($query) === TRUE) {
        header("Location: packages.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

// Hapus Data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM tb_Packages WHERE package_id='$id'");
    header("Location: packages.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Packages</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body class="bg-gray-100">
    
    <?php include "sidebar.html"; ?>
    <?php include "headerAdmin.html"; ?>

    <section class="pt-24 w-full lg:w-[calc(100%-16rem)] lg:ml-64">
        <div class="flex justify-center mt-4">
            <div class="bg-white p-4 rounded-lg shadow-md w-3/4">
                <form method="POST" action="">
                    <input type="hidden" name="package_id" id="packageId">
                    <div class="grid grid-cols-1 gap-8">
                        <div>
                            <label class="block text-gray-700">Nama Paket</label>
                            <input type="text" name="name" id="name" required class="w-full px-3 py-2 border rounded">
                        </div>
                        <div>
                            <label class="block text-gray-700">Detail</label>
                            <textarea name="details" id="details" required class="w-full px-3 py-2 border rounded"></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700">Harga</label>
                            <input type="number" step="0.01" name="price" id="price" required class="w-full px-3 py-2 border rounded">
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
                        <tr class="bg-primary text-white">
                            <th class="p-2 border">ID</th>
                            <th class="p-2 border">Nama Paket</th>
                            <th class="p-2 border">Detail</th>
                            <th class="p-2 border">Harga</th>
                            <th class="p-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="text-center cursor-pointer" onclick="editPackage('<?= $row['package_id'] ?>', '<?= addslashes($row['name']) ?>', '<?= addslashes($row['details']) ?>', '<?= $row['price'] ?>')">
                            <td class="p-2 border"> <?= $row['package_id'] ?> </td>
                            <td class="p-2 border"> <?= $row['name'] ?> </td>
                            <td class="p-2 border"> <?= $row['details'] ?> </td>
                            <td class="p-2 border"> Rp <?= number_format($row['price'], 2, ',', '.') ?> </td>
                            <td class="p-2 border">
                                <a href="packages.php?hapus=<?= $row['package_id'] ?>" class="bg-yellow-500 text-white px-2 py-1 rounded">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
    function editPackage(id, name, details, price) {
        document.getElementById("packageId").value = id;
        document.getElementById("name").value = name;
        document.getElementById("details").value = details;
        document.getElementById("price").value = price;

        document.getElementById("addBtn").classList.add("hidden");
        document.getElementById("updateBtn").classList.remove("hidden");
    }

    function resetForm() {
        document.getElementById("packageId").value = "";
        document.getElementById("name").value = "";
        document.getElementById("details").value = "";
        document.getElementById("price").value = "";

        document.getElementById("addBtn").classList.remove("hidden");
        document.getElementById("updateBtn").classList.add("hidden");
    }
    </script>
</body>
</html>