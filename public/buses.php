<?php 
session_start();
include 'config.php'; 

$pageTitle = "Manage Buses";

// Fungsi untuk generate ID otomatis BUS001, BUS002, ...
function generateID() {
    global $conn;

    // Ambil ID terbesar saat ini
    $query = "SELECT MAX(bus_id) as max_id FROM tb_Buses";
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

    return "BUS" . str_pad($newId, 3, '0', STR_PAD_LEFT);
}

// Ambil data dari database
$result = $conn->query("SELECT * FROM tb_Buses");

// Tambah / Update Data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['bus_id'] ?? null;
    $bus_name = $_POST['bus_name'];
    $bus_class = $_POST['bus_class'];
    $departure_time = date("Y-m-d H:i:s", strtotime($_POST['departure_time']));
    $arrival_time = date("Y-m-d H:i:s", strtotime($_POST['arrival_time']));
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $price = $_POST['price'];

    if (!empty($id)) {
        // Update Data
        $query = "UPDATE tb_Buses 
                  SET bus_name='$bus_name', bus_class='$bus_class', departure_time='$departure_time', arrival_time='$arrival_time', origin='$origin', destination='$destination', price='$price' 
                  WHERE bus_id='$id'";
    } else {
        // Tambah data baru
        $generatedID = generateID();
        $query = "INSERT INTO tb_Buses (bus_id, bus_name, bus_class, departure_time, arrival_time, origin, destination, price) 
                  VALUES ('$generatedID', '$bus_name', '$bus_class', '$departure_time', '$arrival_time', '$origin', '$destination', '$price')";
    }

    if ($conn->query($query) === TRUE) {
        header("Location: buses.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

// Hapus Data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM tb_Buses WHERE bus_id='$id'");
    header("Location: buses.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Buses</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body class="bg-gray-100">
    
    <?php include "sidebar.html"; ?>
    <?php include "headerAdmin.html"; ?>

    <section class="pt-24 w-full lg:w-[calc(100%-16rem)] lg:ml-64">
        <div class="flex justify-center mt-4">
            <div class="bg-white p-4 rounded-lg shadow-md w-3/4">
                <form method="POST" action="">
                    <input type="hidden" name="bus_id" id="busId">
                    <div class="grid grid-cols-1 gap-8">
                        <div>
                            <label class="block text-gray-700">Nama Bus</label>
                            <input type="text" name="bus_name" id="bus_name" required class="w-full px-3 py-2 border rounded">
                        </div>
                        <div>
                            <label class="block text-gray-700">Kelas Bus</label>
                            <select name="bus_class" id="bus_class" required class="w-full px-3 py-2 border rounded">
                                <option value="VIP">VIP</option>
                                <option value="Eksekutif">Eksekutif</option>
                                <option value="Ekonomi">Ekonomi</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700">Waktu Keberangkatan</label>
                            <input type="datetime-local" name="departure_time" id="departure_time" value="<?= date('Y-m-d\TH:i', strtotime($row['departure_time'])) ?>" required class="w-full px-3 py-2 border rounded">

                        </div>
                        <div>
                            <label class="block text-gray-700">Waktu Kedatangan</label>
                            <input type="datetime-local" name="arrival_time" id="arrival_time" value="<?= date('Y-m-d\TH:i', strtotime($row['departure_time'])) ?>" required class="w-full px-3 py-2 border rounded">

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
                            <th class="p-2 border">Nama Bus</th>
                            <th class="p-2 border">Kelas</th>
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
                        <tr class="text-center cursor-pointer" 
                        onclick="editBus('<?= $row['bus_id'] ?>', '<?= addslashes($row['bus_name']) ?>', 
                        '<?= $row['bus_class'] ?>', '<?= $row['departure_time'] ?>', 
                        '<?= $row['arrival_time'] ?>', '<?= addslashes($row['origin']) ?>', 
                        '<?= addslashes($row['destination']) ?>', '<?= $row['price'] ?>')">
                        <td clas                            s="p-2 border"><?= $row['bus_id'] ?></td>
                        <td class="p-2 border"><?= $row['bus_name'] ?></td>
                        <td class="p-2 border"><?= $row['bus_class'] ?></td>
                        <td class="p-2 border"><?= $row['departure_time'] ?></td>
                        <td class="p-2 border"><?= $row['arrival_time'] ?></td>
                        <td class="p-2 border"><?= $row['origin'] ?></td>
                        <td class="p-2 border"><?= $row['destination'] ?></td>
                        <td class="p-2 border">Rp <?= number_format($row['price'], 2, ',', '.') ?></td>
                        <td class="p-2 border">
                            <a href="buses.php?hapus=<?= $row['bus_id'] ?>" class="bg-yellow-500 text-white px-2 py-1 rounded">Hapus</a>
                        </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>    

                </table>
            </div>
        </div>
    </section>
    <script>
    function editBus(id, bus_name, bus_class, departure_time, arrival_time, origin, destination, price) {
        document.getElementById("busId").value = id;
        document.getElementById("bus_name").value = bus_name;
        document.getElementById("bus_class").value = bus_class;
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
        return date.toISOString().slice(0, 16); // Format jadi YYYY-MM-DDTHH:MM
    }

    function resetForm() {
    document.getElementById("busId").value = "";
    document.getElementById("bus_name").value = "";
    document.getElementById("bus_class").value = "VIP";
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
