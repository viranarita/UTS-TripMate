<?php
include 'config.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Pastikan ID adalah angka
$row = null;

if ($id > 0) {
    $stmt = $conn->prepare("SELECT * FROM tb_Itinerary WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if (!$row) {
        die("Itinerary not found!");
    }
} else {
    die("Invalid ID!");
}

// Jika form dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $list_name = $_POST['list_name'];
    $departure_date = $_POST['departure_date'];
    $return_date = $_POST['return_date'];
    $departure_city = $_POST['departure_city'];
    $destination_city = $_POST['destination_city'];

    $stmt = $conn->prepare("UPDATE tb_Itinerary SET list_name=?, departure_date=?, return_date=?, departure_city=?, destination_city=? WHERE id=?");
    $stmt->bind_param("sssssi", $list_name, $departure_date, $return_date, $departure_city, $destination_city, $id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: planning.php");
        exit(); // Mencegah eksekusi lebih lanjut
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Itinerary</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-6">Edit Your Trip</h2>
        <form action="updateItinerary.php?id=<?= $row['id'] ?>" method="POST">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">

            <label class="block mb-4">
                <span class="text-gray-700">Itinerary Name</span>
                <input name="list_name" type="text" class="w-full p-3 border rounded-lg" value="<?= htmlspecialchars($row['list_name']) ?>" required>
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Departure Date</span>
                <input name="departure_date" type="date" class="w-full p-3 border rounded-lg" value="<?= $row['departure_date'] ?>" required>
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Return Date</span>
                <input name="return_date" type="date" class="w-full p-3 border rounded-lg" value="<?= $row['return_date'] ?>" required>
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Departure City</span>
                <select name="departure_city" class="w-full p-3 border rounded-lg">
                    <option value="Surabaya" <?= ($row['departure_city'] == 'Surabaya') ? 'selected' : '' ?>>Surabaya</option>
                    <option value="Jakarta" <?= ($row['departure_city'] == 'Jakarta') ? 'selected' : '' ?>>Jakarta</option>
                    <option value="Bandung" <?= ($row['departure_city'] == 'Bandung') ? 'selected' : '' ?>>Bandung</option>
                    <option value="Yogyakarta" <?= ($row['departure_city'] == 'Yogyakarta') ? 'selected' : '' ?>>Yogyakarta</option>
                </select>
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Destination City</span>
                <select name="destination_city" class="w-full p-3 border rounded-lg">
                    <option value="Surabaya" <?= ($row['destination_city'] == 'Surabaya') ? 'selected' : '' ?>>Surabaya</option>
                    <option value="Jakarta" <?= ($row['destination_city'] == 'Jakarta') ? 'selected' : '' ?>>Jakarta</option>
                    <option value="Bandung" <?= ($row['destination_city'] == 'Bandung') ? 'selected' : '' ?>>Bandung</option>
                    <option value="Yogyakarta" <?= ($row['destination_city'] == 'Yogyakarta') ? 'selected' : '' ?>>Yogyakarta</option>
                </select>
            </label>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">Update</button>
        </form>
    </div>
</body>
</html>
