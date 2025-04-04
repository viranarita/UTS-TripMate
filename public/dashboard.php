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
        <div class="flex justify-center mt-4">
            <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md">
                <div class="flex justify-between mb-6">
                    <div class="text-2xl font-semibold mb-1">10</div>
                    <div class="text-sm font-medium text-gray-400">Active Orders</div>
                </div>
            </div>
            <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md">
                <div class="flex justify-between mb-6">
                    <div class="text-2xl font-semibold mb-1">10</div>
                    <div class="text-sm font-medium text-gray-400">Active Orders</div>
                </div>
            </div>
            <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md">
                <div class="flex justify-between mb-6">
                    <div class="text-2xl font-semibold mb-1">10</div>
                    <div class="text-sm font-medium text-gray-400">Active Orders</div>
                </div>
            </div>
            <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md">
                <div class="flex justify-between mb-6">
                    <div class="text-2xl font-semibold mb-1">10</div>
                    <div class="text-sm font-medium text-gray-400">Active Orders</div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>