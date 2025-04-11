<?php
session_start();
include 'config.php';


// Hapus data
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $conn->query("DELETE FROM tb_Itinerary WHERE list_id = $id");
    header("Location: planning.php");
    exit();
}

// Simpan / Update data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $list_name = $_POST['list_name'];
    $departure_date = $_POST['departure_date'];
    $return_date = $_POST['return_date'];
    $departure_city = $_POST['departure_city'];
    $destination_city = $_POST['destination_city'];

    if (strtotime($return_date) < strtotime($departure_date)) {
        die("Tanggal kembali harus lebih besar atau sama dengan tanggal keberangkatan.");
    }

    // Trip days dihitung otomatis di DB, jadi gak perlu hitung di PHP
    if (isset($_POST['update']) && isset($_POST['list_id'])) {
        // UPDATE
        $list_id = intval($_POST['list_id']);
        $stmt = $conn->prepare("UPDATE tb_Itinerary SET list_name=?, departure_date=?, return_date=?, departure_city=?, destination_city=? WHERE list_id=?");
        $stmt->bind_param("sssssi", $list_name, $departure_date, $return_date, $departure_city, $destination_city, $list_id);
    } else {
        // INSERT
        $stmt = $conn->prepare("INSERT INTO tb_Itinerary (user_id, list_name, departure_date, return_date, departure_city, destination_city) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $user_id, $list_name, $departure_date, $return_date, $departure_city, $destination_city);
    }

    if ($stmt->execute()) {
        header("Location: planning.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Ambil semua data itinerary
$result = $conn->query("SELECT * FROM tb_Itinerary ORDER BY timestamp DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning | TripMate</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-100">

<?php include "header.html"; ?>

<section class="pt-24 w-full">
    <div class="container mx-auto flex flex-col lg:flex-row justify-center items-start gap-8 min-h-screen">
        <!-- FORM -->
        <div class="w-full lg:w-1/2 p-8 bg-white rounded-2xl shadow-xl">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Plan Your Trip</h2>
            <form method="POST" action="">
                <input type="hidden" name="list_id" id="list_id">
                <div class="grid grid-cols-1 gap-8">
                    <div>
                        <label class="block text-gray-700">Itinerary Name</label>
                        <input type="text" name="list_name" id="list_name" required class="w-full px-3 py-2 border rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">Departure Date</label>
                        <input type="date" name="departure_date" id="departure_date" required class="w-full px-3 py-2 border rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">Return Date</label>
                        <input type="date" name="return_date" id="return_date" required class="w-full px-3 py-2 border rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">Trip Days</label>
                        <input type="text" id="trip_days" readonly class="w-full px-3 py-2 border rounded bg-gray-100">
                    </div>
                    <div>
                        <label class="block text-gray-700">Departure City</label>
                        <select name="departure_city" id="departure_city" required class="w-full px-3 py-2 border rounded">
                            <option value="">Pilih Kota</option>
                            <option value="Surabaya">Surabaya</option>
                            <option value="Jakarta">Jakarta</option>
                            <option value="Bandung">Bandung</option>
                            <option value="Yogyakarta">Yogyakarta</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700">Destination City</label>
                        <select name="destination_city" id="destination_city" required class="w-full px-3 py-2 border rounded">
                            <option value="">Pilih Kota</option>
                            <option value="Surabaya">Surabaya</option>
                            <option value="Jakarta">Jakarta</option>
                            <option value="Bandung">Bandung</option>
                            <option value="Yogyakarta">Yogyakarta</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 flex justify-between">
                    <button type="submit" name="tambah" id="addBtn" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah</button>
                    <button type="submit" name="update" id="updateBtn" class="bg-green-500 text-white px-4 py-2 rounded hidden">Update</button>
                    <button type="button" onclick="resetForm()" class="bg-gray-400 text-white px-4 py-2 rounded">Reset</button>
                </div>
            </form>
        </div>

        <!-- TABEL -->
        <div class="w-full lg:w-1/2 bg-white p-4 rounded-2xl shadow-xl overflow-x-auto">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Your Plan</h2>
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-red-600 text-white">
                        <th class="p-2 border">Nama</th>
                        <th class="p-2 border">Pergi</th>
                        <th class="p-2 border">Kembali</th>
                        <th class="p-2 border">Durasi</th>
                        <th class="p-2 border">Asal</th>
                        <th class="p-2 border">Tujuan</th>
                        <th class="p-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr class="text-center hover:bg-gray-100 cursor-pointer" onclick='editData(<?= json_encode($row) ?>)'>
                        <td class="p-2 border"><?= $row['list_name'] ?></td>
                        <td class="p-2 border"><?= $row['departure_date'] ?></td>
                        <td class="p-2 border"><?= $row['return_date'] ?></td>
                        <td class="p-2 border"><?= $row['trip_days'] ?></td>
                        <td class="p-2 border"><?= $row['departure_city'] ?></td>
                        <td class="p-2 border"><?= $row['destination_city'] ?></td>
                        <td class="p-2 border">
                            <a href="planning.php?hapus=<?= $row['list_id'] ?>" class="bg-yellow-500 text-white px-2 py-1 rounded">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
function editData(data) {
    document.getElementById("list_id").value = data.list_id;
    document.getElementById("list_name").value = data.list_name;
    document.getElementById("departure_date").value = data.departure_date;
    document.getElementById("return_date").value = data.return_date;
    document.getElementById("departure_city").value = data.departure_city;
    document.getElementById("destination_city").value = data.destination_city;
    calculateDays();

    document.getElementById("addBtn").classList.add("hidden");
    document.getElementById("updateBtn").classList.remove("hidden");
}

function resetForm() {
    document.getElementById("list_id").value = "";
    document.getElementById("list_name").value = "";
    document.getElementById("departure_date").value = "";
    document.getElementById("return_date").value = "";
    document.getElementById("trip_days").value = "";
    document.getElementById("departure_city").value = "";
    document.getElementById("destination_city").value = "";

    document.getElementById("addBtn").classList.remove("hidden");
    document.getElementById("updateBtn").classList.add("hidden");
}

document.getElementById('departure_date').addEventListener('change', calculateDays);
document.getElementById('return_date').addEventListener('change', calculateDays);

function calculateDays() {
    const dep = new Date(document.getElementById('departure_date').value);
    const ret = new Date(document.getElementById('return_date').value);
    if (!isNaN(dep) && !isNaN(ret) && ret >= dep) {
        const diffDays = Math.ceil((ret - dep) / (1000 * 60 * 60 * 24));
        document.getElementById('trip_days').value = diffDays;
    } else {
        document.getElementById('trip_days').value = '';
    }
}
</script>

</body>
</html>
