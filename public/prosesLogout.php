<?php
    session_start();
    if(isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header('location: index.php');
        exit(); // Tambahkan exit setelah header() untuk memastikan tidak ada kode yang dieksekusi setelahnya
    }
?>