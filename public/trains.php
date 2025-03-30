<?php 
session_start();
include 'config.php'; 

$pageTitle = "Manage Trains";

// Ambil data dari database
$result = $conn->query("SELECT * FROM tb_Trains");

// Tambah / Update Data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['train_id'] ?? null;
    $train_name = $_POST['train_name'];
    $train_type = $_POST['train_type'];
    $departure_time = date("Y-m-d H:i:s", strtotime($_POST['departure_time']));
    $arrival_time = date("Y-m-d H:i:s", strtotime($_POST['arrival_time']));
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $price = $_POST['price'];

    if (!empty($id)) {
        // Update Data
        $query = "UPDATE tb_Trains 
                  SET train_name='$train_name', train_type='$train_type', departure_time='$departure_time', arrival_time='$arrival_time', origin='$origin', destination='$destination', price='$price' 
                  WHERE train_id='$id'";
    } else {
        // Tambah data baru
        $query = "INSERT INTO tb_Trains (train_name, train_type, departure_time, arrival_time, origin, destination, price) 
                  VALUES ('$train_name', '$train_type', '$departure_time', '$arrival_time', '$origin', '$destination', '$price')";
    }

    if ($conn->query($query) === TRUE) {
        header("Location: trains.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

// Hapus Data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM tb_Trains WHERE train_id='$id'");
    header("Location: trains.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Trains</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body class="bg-gray-100">
    
    <?php include "sidebar.html"; ?>
    <?php include "headerAdmin.html"; ?>

    <section class="pt-24 w-full lg:w-[calc(100%-16rem)] lg:ml-64">
        <div class="flex justify-center mt-4">
            <div class="bg-white p-4 rounded-lg shadow-md w-3/4">
                <form method="POST" action="">
                    <input type="hidden" name="train_id" id="trainId">
                    <div class="grid grid-cols-1 gap-8">
                        <div>
                            <label class="block text-gray-700">Nama Kereta</label>
                            <input type="text" name="train_name" id="train_name" required class="w-full px-3 py-2 border rounded">
                        </div>
                        <div>
                            <label class="block text-gray-700">Jenis Kereta</label>
                            <select name="train_type" id="train_type" required class="w-full px-3 py-2 border rounded">
                                <option value="Eksekutif">Eksekutif</option>
                                <option value="Bisnis">Bisnis</option>
                                <option value="Ekonomi">Ekonomi</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700">Waktu Keberangkatan</label>
                            <input type="datetime-local" name="departure_time" id="departure_time" required class="w-full px-3 py-2 border rounded">
                        </div>
                        <div>
                            <label class="block text-gray-700">Waktu Kedatangan</label>
                            <input type="datetime-local" name="arrival_time" id="arrival_time" required class="w-full px-3 py-2 border rounded">
                        </div>
                        <div>
                            <label class="block text-gray-700">Asal</label>
                            <input type="text" name="origin" id="origin" required class="w-full px-3 py-2 border rounded">
                        </div>
                        <div>
                            <label class="block text-gray-700">Tujuan</label>
                            <input type="text" name="destination" id="destination" required class="w-full px-3 py-2 border rounded">
                        </div>
                        <div>
                            <label class="block text-gray-700">Harga</label>
                            <input type="number" name="price" id="price" required class="w-full px-3 py-2 border rounded" step="0.01">
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
                            <th class="p-2 border">Nama Kereta</th>
                            <th class="p-2 border">Jenis</th>
                            <th class="p-2 border">Keberangkatan</th>
                            <th class="p-2 border">Kedatangan</th>
                            <th class="p-2 border">Asal</th>
                            <th class="p-2 border">Tujuan</th>
                            <th class="p-2 border">Harga</th>
                            <th class="p-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="text-center cursor-pointer" onclick="editTrain('<?= $row['train_id'] ?>', '<?= addslashes($row['train_name']) ?>', '<?= $row['train_type'] ?>', '<?= $row['departure_time'] ?>', '<?= $row['arrival_time'] ?>', '<?= addslashes($row['origin']) ?>', '<?= addslashes($row['destination']) ?>', '<?= $row['price'] ?>')">
                            <td class="p-2 border"> <?= $row['train_id'] ?> </td>
                            <td class="p-2 border"> <?= $row['train_name'] ?> </td>
                            <td class="p-2 border"> <?= $row['train_type'] ?> </td>
                            <td class="p-2 border"> <?= $row['departure_time'] ?> </td>
                            <td class="p-2 border"> <?= $row['arrival_time'] ?> </td>
                            <td class="p-2 border"> <?= $row['origin'] ?> </td>
                            <td class="p-2 border"> <?= $row['destination'] ?> </td>
                            <td class="p-2 border">Rp <?= number_format($row['price'], 2, ',', '.') ?></td>
                            <td class="p-2 border">
                            <a href="trains.php?hapus=<?= $row['train_id'] ?>" class="bg-yellow-500 text-white px-2 py-1 rounded">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script>
    function editTrain(id, train_name, train_type, departure_time, arrival_time, origin, destination, price) {
        document.getElementById("trainId").value = id;
        document.getElementById("train_name").value = train_name;
        document.getElementById("train_type").value = train_type;
        document.getElementById("departure_time").value = formatDateTimeLocal(departure_time);
        document.getElementById("arrival_time").value = formatDateTimeLocal(arrival_time);
        document.getElementById("origin").value = origin;
        document.getElementById("destination").value = destination;
        document.getElementById("price").value = price;

        document.getElementById("addBtn").classList.add("hidden");
        document.getElementById("updateBtn").classList.remove("hidden");
    }

    // Fungsi untuk mengubah format datetime dari DB ke input datetime-local
    function formatDateTimeLocal(datetime) {
        let date = new Date(datetime);
        return date.toISOString().slice(0, 16);
    }

    function resetForm() {
        document.getElementById("trainId").value = "";
        document.getElementById("train_name").value = "";
        document.getElementById("train_type").value = "Eksekutif";
        document.getElementById("departure_time").value = "";
        document.getElementById("arrival_time").value = "";
        document.getElementById("origin").value = "";
        document.getElementById("destination").value = "";
        document.getElementById("price").value = "";

        document.getElementById("addBtn").classList.remove("hidden");
        document.getElementById("updateBtn").classList.add("hidden");
    }
    </script>
</body>
</html>
