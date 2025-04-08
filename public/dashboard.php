<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
    <link rel="stylesheet" href="style.css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100">
    <?php include "sidebar.html" ?>
    <?php include "headerAdmin.html" ?>
    <section class="pt-24 pb-20 w-full lg:w-[calc(100%-16rem)] lg:ml-64">
        <div class="flex justify-center mt-4 space-x-4">
            <div class="bg-white rounded-lg border border-gray-100 p-6 shadow-md">
                <div class="flex justify-center">
                    <div class="text-4xl font-semibold p-2">10</div>
                    <div class="text-sm font-medium text-gray-400 p-2 mt-3">Total Pengguna Aktif</div>
                </div>
            </div>
            <div class="bg-white rounded-lg border border-gray-100 p-6 shadow-md">
                <div class="flex justify-center">
                    <div class="text-4xl font-semibold p-2">10</div>
                    <div class="text-sm font-medium text-gray-400 p-2 mt-3">Total Itinerary Dibuat</div>
                </div>
            </div>
            <div class="bg-white rounded-lg border border-gray-100 p-6 shadow-md">
                <div class="flex justify-center">
                    <div class="text-4xl font-semibold p-2">10</div>
                    <div class="text-sm font-medium text-gray-400 p-2 mt-3">Jumlah Trip Dibuat Bulan Ini</div>
                </div>
            </div>
            <div class="bg-white rounded-lg border border-gray-100 p-6 shadow-md">
                <div class="flex justify-center">
                    <div class="text-4xl font-semibold p-2">10</div>
                    <div class="text-sm font-medium text-gray-400 p-2 mt-3">Total Pendapatan</div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Chart Section Start -->
    <section id="chart" class="pb-20 w-full lg:w-[calc(100%-16rem)] lg:ml-64">
        <div class="container">
            <div class="flex flex-wrap justify-center gap-6">
                <!-- Chart 1 -->
                <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/2 max-w-md text-center">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Destinasi Terfavorit TripMate 1</h2>
                    <div class="w-full h-80 mx-auto">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
                <!-- Chart 2 -->
                <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/2 max-w-md text-center">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Destinasi Terfavorit TripMate 2</h2>
                    <div class="w-full h-80 mx-auto">
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-20 w-full lg:w-[calc(100%-16rem)] lg:ml-64">
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
                            <th class="p-2 border">Nama User</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>    
                </table>
            </div>
        </div>
    </section>

</body>

<script>
  // Chart 1 Dummy Data
  const ctx1 = document.getElementById('myChart').getContext('2d');
  const chart1 = new Chart(ctx1, {
    type: 'bar',
    data: {
      labels: ['Bali', 'Yogyakarta', 'Bandung', 'Lombok', 'Labuan Bajo'],
      datasets: [{
        label: 'Jumlah Pengunjung',
        data: [120, 90, 75, 60, 45],
        backgroundColor: ['#60a5fa', '#34d399', '#fbbf24', '#f87171', '#a78bfa'],
        borderRadius: 6,
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        title: {
          display: true,
          text: 'Top Destinasi TripMate 1',
          font: { size: 16 }
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: { stepSize: 20 }
        }
      }
    }
  });

  // Chart 2 Dummy Data
  const ctx2 = document.getElementById('myChart2').getContext('2d');
  const chart2 = new Chart(ctx2, {
    type: 'pie',
    data: {
      labels: ['Jakarta', 'Surabaya', 'Malang', 'Semarang', 'Bali'],
      datasets: [{
        label: 'Distribusi Favorit',
        data: [30, 25, 20, 15, 10],
        backgroundColor: ['#f87171', '#34d399', '#60a5fa', '#fbbf24', '#a78bfa'],
      }]
    },
    options: {
      responsive: true,
      plugins: {
        title: {
          display: true,
          text: 'Distribusi Favorit TripMate 2',
          font: { size: 16 }
        }
      }
    }
  });
</script>


</html>