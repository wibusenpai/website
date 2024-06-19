<?php
include "../connect.php";

$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_wisata = $_POST['id_wisata'];
    $nama_wisata = $_POST['nama_wisata'];
    $alamat = $_POST['alamat'];
    $harga_tiket = $_POST['harga_tiket'];
    $jam_buka = $_POST['jam_buka'];
    $deskripsi = $_POST['deskripsi'];
    $jenis_wisata = $_POST['jenis_wisata'];
    $latLng = $_POST['latLng'];

    if ($id) {
        $query = "UPDATE `wisata` SET `id_wisata`='$id_wisata',`nama_wisata`='$nama_wisata',`alamat`='$alamat',`harga_tiket`='$harga_tiket',`jam_buka`='$jam_buka',`deskripsi`='$deskripsi',`jenis_wisata`='$jenis_wisata',`latLng`='$latLng' WHERE id_wisata='$id'";
        $message = "Data berhasil diperbarui";
    } else {
        $query = "INSERT INTO `wisata`(`id_wisata`, `nama_wisata`, `alamat`, `harga_tiket`, `jam_buka`, `deskripsi`, `jenis_wisata`, `latLng`) VALUES ('$id_wisata','$nama_wisata','$alamat','$harga_tiket','$jam_buka','$deskripsi','$jenis_wisata','$latLng')";
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
        $query = "SELECT * FROM wisata WHERE id_wisata='$id'";
        $result = mysqli_query($connect, $query);
        $wisata = mysqli_fetch_assoc($result);
        $id_wisata = $wisata['id_wisata'];
        $nama_wisata = $wisata['nama_wisata'];
        $alamat = $wisata['alamat'];
        $harga_tiket = $wisata['harga_tiket'];
        $jam_buka = $wisata['jam_buka'];
        $deskripsi = $wisata['deskripsi'];
        $jenis_wisata = $wisata['jenis_wisata'];
        $latLng = $wisata['latLng'];
    } else {
        $id_wisata = '';
        $nama_wisata = '';
        $alamat = '';
        $harga_tiket = '';
        $jam_buka = '';
        $deskripsi = '';
        $jenis_wisata = '';
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
    <title><?php echo $id ? 'Edit Wisata' : 'Tambah Wisata'; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2><?php echo $id ? 'Edit Data Wisata' : 'Tambah Data Wisata'; ?></h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="id_wisata" class="form-label">ID</label>
                <input type="text" class="form-control" id="id_wisata" name="id_wisata" value="<?php echo $id_wisata; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama_wisata" class="form-label">Nama Wisata</label>
                <input type="text" class="form-control" id="nama_wisata" name="nama_wisata" value="<?php echo $nama_wisata; ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat; ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga_tiket" class="form-label">Harga Tiket</label>
                <input type="number" class="form-control" id="harga_tiket" name="harga_tiket" value="<?php echo $harga_tiket; ?>" required>
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
                <label for="jenis_wisata" class="form-label">Jenis Wisata</label>
                <select class="form-control" id="jenis_wisata" name="jenis_wisata" required>
                    <option value="Wisata Religi" <?php echo $jenis_wisata == 'Wisata Religi' ? 'selected' : ''; ?>>Wisata Religi</option>
                    <option value="Wisata Alam" <?php echo $jenis_wisata == 'Wisata Alam' ? 'selected' : ''; ?>>Wisata Alam</option>
                </select>
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
