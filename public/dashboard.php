<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css"/>
</head>

<body class="bg-gray-100">
    <!-- Sidebar Start -->
    <aside class="bg-white fixed top-0 left-0 h-full w-96 min-w-[384px] shadow-lg flex flex-col z-10">

        <div class="flex flex-col h-full justify-between">
            
            <!-- Logo -->
            <div class="p-7 border-b border-gray-200">
                <a href="#home" class="font-bold text-lg text-primary">TripMate</a>
            </div>

            <!-- Menu (Akan Mengisi Ruang Tengah) -->
            <div class="flex-1">
                <div class="p-7 space-y-3 border-b border-gray-200 center">
                    <a href="#dashboard" class="text-base text-dark hover:text-primary">Dashboard</a>
                </div>
                <div class="p-7 space-y-3 border-b border-gray-200">
                    <a href="#dashboard" class="text-base text-dark hover:text-primary">Manage Places</a>
                </div>
                <div class="p-7 space-y-3 border-b border-gray-200">
                    <a href="#dashboard" class="text-base text-dark hover:text-primary">Manage Transportation</a>
                </div>
                <div class="p-7 space-y-3 border-b border-gray-200">
                    <a href="#dashboard" class="text-base text-dark hover:text-primary">Manage Packages</a>
                </div>
            </div>

            <!-- Logout Nempel di Bawah -->
            <div class="p-7 border-t border-gray-200">
                <form method="POST" action="prosesLogout.php">
                    <button type="submit" name="logout" class="text-base text-dark hover:text-primary w-full">Logout</button>
                </form>
            </div>

        </div>

    </aside>


    <!-- Sidebar End -->
</body>
</html>