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
    <section class="pt-24 w-full lg:w-[calc(100%-16rem)] lg:ml-64">
        <div class="flex justify-center mt-4 space-x-4">
            <div class="bg-white rounded-lg border border-gray-100 p-6 shadow-md">
                <div class="flex justify-center">
                    <div class="text-4xl font-semibold p-2">10</div>
                    <div class="text-sm font-medium text-gray-400 p-2 mt-3">Active Orders</div>
                </div>
            </div>
        </div>
        <p class="text-gray-400">HALO</p>
    </section>

</body>
</html>