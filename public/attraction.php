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
    
    <?php include "sidebar.html" ?>

    <div class="flex justify-center ml-64 mt-4">
        <div class="bg-white p-4 rounded-lg shadow-md w-3/4">
            <form method="POST" action="destination.php">
                <input type="hidden" name="id" id="hotelId">
                <div class="grid grid-cols-1 gap-8">
                    <div>
                        <label class="block text-gray-700">Nama</label>
                        <input type="text" name="nama" id="nama" required class="w-full px-3 py-2 border rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">Kota</label>
                        <input type="text" name="kota" id="kota" required class="w-full px-3 py-2 border rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">Harga</label>
                        <input type="number" name="harga" id="harga" required class="w-full px-3 py-2 border rounded">
                    </div>
                </div>
                <div class="mt-4 flex justify-between">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah</button>
                    <button type="submit" id="updateBtn" class="bg-green-500 text-white px-4 py-2 rounded hidden">Update</button>
                    <button type="button" onclick="resetForm()" class="bg-gray-400 text-white px-4 py-2 rounded">Reset</button>
                </div>
            </form>
        </div>
    </div>

    <div class="flex justify-center ml-64 mt-4">
        <div class="bg-white p-4 rounded-lg shadow-md w-3/4">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-red-600 text-white">
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Nama</th>
                        <th class="p-2 border">Lokasi (Kota)</th>
                        <th class="p-2 border">Harga</th>
                        <th class="p-2 border">Gambar</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

</body>
</html>