<?php
    include "connect.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_kuliner = $_POST['id_kuliner'];
        $ulasan = $_POST['ulasan'];
        $rating = $_POST['rating'];  // Ambil rating dari input form
        
        $query = "INSERT INTO ulasan_kuliner (id_kuliner, ulasan, rating) VALUES ('$id_kuliner', '$ulasan', '$rating')";
        $message = "Data berhasil ditambahkan";
    
        if (mysqli_query($connect, $query)) {
            header("Location: maps_kuliner.php?id=$id_kuliner");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($connect);
        }
    }
?>
