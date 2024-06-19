<?php
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_wisata = $_POST['id_wisata'];
    $ulasan = $_POST['ulasan'];
    $rating = $_POST['rating'];  // Ambil rating dari input form

    // Insert data ulasan dan rating ke database
    $query = "INSERT INTO ulasan_wisata (id_wisata, ulasan, rating) VALUES ('$id_wisata', '$ulasan', '$rating')";
    $message = "Data berhasil ditambahkan";

    if (mysqli_query($connect, $query)) {
        header("Location: maps_wisata.php?id=$id_wisata");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connect);
    }
}
?>
