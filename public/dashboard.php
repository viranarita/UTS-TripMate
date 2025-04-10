<?php 
session_start();
include 'config.php';

// ambil total user
$sql = "SELECT COUNT(*) as total FROM tb_Users";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalUsers = $row['total'];

// Ambil total itinerary
$sql = "SELECT COUNT(*) as total FROM tb_Itinerary";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalItinerary = $row['total'];

// Hitung total flight
$sql_flight = "SELECT COUNT(*) AS total FROM tb_Flights";
$result_flight = mysqli_query($conn, $sql_flight);
$totalFlight = mysqli_fetch_assoc($result_flight)['total'];

// Hitung total bus
$sql_bus = "SELECT COUNT(*) AS total FROM tb_Buses";
$result_bus = mysqli_query($conn, $sql_bus);
$totalBus = mysqli_fetch_assoc($result_bus)['total'];

// Hitung total train
$sql_train = "SELECT COUNT(*) AS total FROM tb_Trains";
$result_train = mysqli_query($conn, $sql_train);
$totalTrain = mysqli_fetch_assoc($result_train)['total'];

// Total keseluruhan transportasi
$totalTransport = $totalFlight + $totalBus + $totalTrain;

// Hitung total attractions
$sql_attraction = "SELECT COUNT(*) AS total FROM tb_Attractions";
$result_attraction = mysqli_query($conn, $sql_attraction);
$totalAttractions = mysqli_fetch_assoc($result_attraction)['total'];

// Hitung total culinary
$sql_culinary = "SELECT COUNT(*) AS total FROM tb_Culinary";
$result_culinary = mysqli_query($conn, $sql_culinary);
$totalCulinary = mysqli_fetch_assoc($result_culinary)['total'];

// Total keseluruhan destinasi
$totalDestination = $totalAttractions + $totalCulinary;

// Total Itinerary Dibuat Perbulan
$sql = "SELECT 
            DATE_FORMAT(timestamp, '%M %Y') AS month,
            COUNT(*) AS total
        FROM tb_Itinerary
        WHERE timestamp IS NOT NULL
        GROUP BY DATE_FORMAT(timestamp, '%Y-%m')
        ORDER BY MIN(timestamp)";
        
$result = $conn->query($sql);

$monthLabels = [];
$monthData = [];

while ($row = $result->fetch_assoc()) {
    $monthLabels[] = $row['month'];
    $monthData[] = (int)$row['total'];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
    <link rel="stylesheet" href="style.css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
    @media print {
        .print\:hidden {
        display: none !important;
        }
        #sidebar,
        #headerAdmin {
        display: none !important;
        }
    }
    </style>
</head>

<body class="bg-gray-100">
    <div id="sidebar" class="print:hidden">
    <?php include "sidebar.html" ?>
    </div>
    
    <div id="headerAdmin" class="print:hidden">
    <?php include "headerAdmin.html" ?>
    </div>

    <div id="printArea">
    <section class="pt-24 pb-10 w-full lg:w-[calc(100%-16rem)] lg:ml-64">
        <div class="flex justify-center mt-4 space-x-4">
            <div class="bg-white rounded-lg border border-gray-100 p-6 shadow-md">
                <div class="flex justify-center">
                    <div class="text-4xl font-semibold p-2"><?php echo $totalUsers; ?></div>
                    <div class="text-sm font-medium text-gray-400 p-2 mt-3">Total Pengguna Aktif</div>
                </div>
            </div>
            <div class="bg-white rounded-lg border border-gray-100 p-6 shadow-md">
                <div class="flex justify-center">
                    <div class="text-4xl font-semibold p-2"><?php echo $totalItinerary; ?></div>
                    <div class="text-sm font-medium text-gray-400 p-2 mt-3">Total Itinerary Dibuat</div>
                </div>
            </div>
            <div class="bg-white rounded-lg border border-gray-100 p-6 shadow-md">
                <div class="flex justify-center">
                    <div class="text-4xl font-semibold p-2"><?php echo $totalTransport; ?></div>
                    <div class="text-sm font-medium text-gray-400 p-2 mt-3">Total Transportasi</div>
                </div>
            </div>
            <div class="bg-white rounded-lg border border-gray-100 p-6 shadow-md">
                <div class="flex justify-center">
                    <div class="text-4xl font-semibold p-2"><?php echo $totalDestination; ?></div>
                    <div class="text-sm font-medium text-gray-400 p-2 mt-3">Total Destinasi</div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Chart Section Start -->
    <section id="chart" class="pt-10 pb-10 w-full lg:w-[calc(100%-16rem)] lg:ml-64">
        <div class="container">
            <div class="flex flex-wrap justify-center gap-6">
                <!-- Chart 1 -->
                <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/2 max-w-md text-center">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Destinasi Terfavorit</h2>
                    <div class="w-full h-80 mx-auto">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
                <!-- Chart 2 -->
                <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/2 max-w-md text-center">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Jumlah Itinerary Dibuat Perbulan </h2>
                    <div class="w-full h-80 mx-auto">
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-10 pb-10 w-full lg:w-[calc(100%-16rem)] lg:ml-64">
    <div class="flex justify-center mt-4 mb-4">
            <div class="bg-white p-4 rounded-lg shadow-md w-3/4">
                <h2 class="mb-2 font-semibold text-lg">Itinerary Orang-Orang</h2>
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th class="p-2 border">Nama Itinerary</th>
                            <th class="p-2 border">Start Date</th>
                            <th class="p-2 border">End Date</th>
                            <th class="p-2 border">Status</th>
                            <th class="p-2 border">User ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT 
                                    list_name, 
                                    departure_date, 
                                    return_date, 
                                    user_id
                                FROM tb_Itinerary
                                ORDER BY departure_date DESC";

                        $result = mysqli_query($conn, $sql);
                        $today = date('Y-m-d');

                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['departure_date'] > $today) {
                                $status = '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-600">Pending</span>';
                            } elseif ($row['return_date'] < $today) {
                                $status = '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">Done</span>';
                            } else {
                                $status = '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-500">Proses</span>';
                            }

                            echo "<tr class='text-center'>";
                            echo "<td class='p-2 border'>{$row['list_name']}</td>";
                            echo "<td class='p-2 border'>{$row['departure_date']}</td>";
                            echo "<td class='p-2 border'>{$row['return_date']}</td>";
                            echo "<td class='p-2 border'>$status</td>";
                            echo "<td class='p-2 border'>{$row['user_id']}</td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                </table>
            </div>
        </div>
    </section>
    </div>
        <div class="pt-10 pb-10 w-full lg:w-[calc(100%-16rem)] lg:ml-64 flex justify-center print:hidden">
            <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow">
                🖨️ Print Laporan
            </button>
        </div>
    </body>

<script>
  // Chart 1 Destinasi Favorit
  document.addEventListener("DOMContentLoaded", function() {
        fetch("getChartData.php")
            .then(response => response.json())
            .then(data => {
                var ctx = document.getElementById("myChart").getContext('2d');

                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Destinasi Favorit',
                            data: data.data,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(54, 162, 235, 0.7)',
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(153, 102, 255, 0.7)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)'
                            ],
                            borderWidth: 2
                        }]
                    }
                });
            })
            .catch(error => console.error('Error:', error));
    });

  // Chart 2 Itinerary Perbulan
  const monthLabels = <?php echo json_encode($monthLabels); ?>;
  const monthData = <?php echo json_encode($monthData); ?>;

  document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("myChart2").getContext("2d");
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: monthLabels,
        datasets: [{
          label: 'Jumlah Itinerary',
          data: monthData,
          backgroundColor: 'rgba(54, 162, 235, 0.7)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 1
            }
          }
        }
      }
    });
  });
</script>


</html>