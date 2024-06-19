<?php
include "../connect.php";

$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_kuliner = $_POST['id_kuliner'];
    $nama_kuliner = $_POST['nama_kuliner'];
    $alamat = $_POST['alamat'];
    $harga = $_POST['harga'];
    $jam_buka = $_POST['jam_buka'];
    $deskripsi = $_POST['deskripsi'];
    $latLng = $_POST['latLng'];

    if ($id) {
        $query = "UPDATE `kuliner` SET `id_kuliner`='$id_kuliner',`nama_kuliner`='$nama_kuliner',`alamat`='$alamat',`harga`='$harga',`jam_buka`='$jam_buka',`deskripsi`='$deskripsi', `latLng`='$latLng' WHERE id_kuliner='$id'";
        $message = "Data berhasil diperbarui";
    } else {
        $query = "INSERT INTO `kuliner`(`id_kuliner`, `nama_kuliner`, `alamat`, `harga`, `jam_buka`, `deskripsi`,`latLng`) VALUES ('$id_kuliner','$nama_kuliner','$alamat','$harga','$jam_buka','$deskripsi','$latLng')";
        $message = "Data berhasil ditambahkan";
    }

    if (mysqli_query($connect, $query)) {
        $_SESSION['message'] = $message;
        header("Location: admin.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connect);
    }
} else {
    if ($id) {
        $query = "SELECT * FROM kuliner WHERE id_kuliner='$id'";
        $result = mysqli_query($connect, $query);
        $kuliner = mysqli_fetch_assoc($result);
        $id_kuliner = $kuliner['id_kuliner'];
        $nama_kuliner = $kuliner['nama_kuliner'];
        $alamat = $kuliner['alamat'];
        $harga = $kuliner['harga'];
        $jam_buka = $kuliner['jam_buka'];
        $deskripsi = $kuliner['deskripsi'];
        $latLng = $kuliner['latLng'];
    } else {
        $id_kuliner = '';
        $nama_kuliner = '';
        $alamat = '';
        $harga = '';
        $jam_buka = '';
        $deskripsi = '';
        $latLng = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $id ? 'Edit Kuliner' : 'Tambah Kuliner'; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2><?php echo $id ? 'Edit Data Kuliner' : 'Tambah Data Kuliner'; ?></h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="id_kuliner" class="form-label">ID</label>
                <input type="text" class="form-control" id="id_kuliner" name="id_kuliner" value="<?php echo $id_kuliner; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama_kuliner" class="form-label">Nama Kuliner</label>
                <input type="text" class="form-control" id="nama_kuliner" name="nama_kuliner" value="<?php echo $nama_kuliner; ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat; ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $harga; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jam_buka" class="form-label">Jam Buka</label>
                <input type="text" class="form-control" id="jam_buka" name="jam_buka" value="<?php echo $jam_buka; ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5"><?php echo $deskripsi; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="latLng" class="form-label">Titik Koordinat</label>
                <input type="text" class="form-control" id="latLng" name="latLng" value="<?php echo $latLng; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary"><?php echo $id ? 'Update' : 'Submit'; ?></button>
        </form>
    </div>
</body>
</html>
