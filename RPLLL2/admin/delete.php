<?php
include "../connect.php";

$id = $_GET['id'];
$table = $_GET['table'];

$query = "DELETE FROM $table WHERE id_$table='$id'";
if (mysqli_query($connect, $query)) {
    header("Location: admin.php");
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($connect);
}

?>