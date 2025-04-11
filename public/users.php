<?php 
session_start();
include 'config.php'; 

$pageTitle = "Manage Users";

// Hapus Data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM tb_Users WHERE user_id='$id'");
    header("Location: users.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Users</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body class="bg-gray-100">
    
    <?php include "sidebar.html"; ?>
    <?php include "headerAdmin.html"; ?>

    <section class="pt-24 w-full lg:w-[calc(100%-16rem)] lg:ml-64">
    <div class="flex justify-center mt-4 mb-4">
            <div class="bg-white p-4 rounded-lg shadow-md w-3/4">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-red-600 text-white">
                            <th class="p-2 border">ID</th>
                            <th class="p-2 border">Nama</th>
                            <th class="p-2 border">Email</th>
                            <th class="p-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT * FROM tb_Users");
                        while ($row = $result->fetch_assoc()):
                        ?>
                        <tr class="text-center">
                            <td class="p-2 border"><?= $row['user_id'] ?></td>
                            <td class="p-2 border"><?= htmlspecialchars($row['name']) ?></td>
                            <td class="p-2 border"><?= htmlspecialchars($row['email']) ?></td>
                            <td class="p-2 border">
                                <a href="users.php?hapus=<?= $row['user_id'] ?>" 
                                onclick="return confirm('Yakin ingin menghapus user ini?')" 
                                class="bg-red-500 text-white px-2 py-1 rounded">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>
</html>