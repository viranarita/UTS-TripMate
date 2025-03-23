<?php
include 'config.php';

$query = "SELECT destination_city, COUNT(*) as count FROM tb_Itinerary GROUP BY destination_city";
$result = $conn->query($query);

$labels = [];
$data = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = $row['destination_city'];
    $data[] = $row['count'];
}

$conn->close();

echo json_encode([
    "labels" => $labels,
    "data" => $data
]);
?>
