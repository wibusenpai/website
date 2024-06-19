<?php
include "../connect.php";

$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_galeri_kuliner = $_POST['id_galeri_kuliner'];
    $id_kuliner = $_POST['id_kuliner'];
    $gambar = $_POST['gambar'];
    $keterangan = $_POST['keterangan'];

    if ($id) {
        $query = "UPDATE `galeri_kuliner` SET `id_galeri_kuliner`='$id_galeri_kuliner',`id_kuliner`='$id_kuliner',`gambar`='$gambar',`keterangan`='$keterangan' WHERE id_galeri_kuliner='$id'";
        $message = "Data berhasil diperbarui";
    } else {
        $query = "INSERT INTO `galeri_kuliner`(`id_galeri_kuliner`, `id_kuliner`, `gambar`, `keterangan`) VALUES ('$id_galeri_kuliner','$id_kuliner','$gambar','$keterangan')";
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
        $query = "SELECT * FROM galeri_kuliner WHERE id_galeri_kuliner='$id'";
        $result = mysqli_query($connect, $query);
        $kuliner = mysqli_fetch_assoc($result);
        $id_galeri_kuliner = $kuliner['id_galeri_kuliner'];
        $id_kuliner = $kuliner['id_kuliner'];
        $gambar = $kuliner['gambar'];
        $keterangan = $kuliner['keterangan']; 
    } else {
        $id_galeri_kuliner = '';
        $id_kuliner = '';
        $gambar = '';
        $keterangan = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $id ? 'Edit Galeri Kuliner' : 'Tambah Galeri Kuliner'; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2><?php echo $id ? 'Edit Data Galeri Kuliner' : 'Tambah Data Galeri Kuliner'; ?></h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="id_galeri_kuliner" class="form-label">ID</label>
                <input type="text" class="form-control" id="id_galeri_kuliner" name="id_galeri_kuliner" value="<?php echo $id_galeri_kuliner; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama_kuliner" class="form-label">Nama Kuliner</label>
                <select class="form-select" id="id_kuliner" name="id_kuliner" required>
                    <option value="">Pilih Kuliner</option>
                    <?php
                    $query = "SELECT * FROM kuliner";
                    $result = mysqli_query($connect, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $nama_kuliner = $row['nama_kuliner'];
                            $selected = ($id_kuliner == $row['id_kuliner']) ? 'selected' : '';
                            echo "<option value='{$row['id_kuliner']}' $selected>$nama_kuliner</option>";
                        }
                    } else {
                        echo "<option value='' disabled>Tidak ada data kuliner</option>";
                    }
                    ?>
                </select>

            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Upload Gambar</label>
                <input type="file" class="form-control" id="gambar" name="gambar" value="<?php echo $gambar; ?>" required>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?php echo $keterangan; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary"><?php echo $id ? 'Update' : 'Submit'; ?></button>
        </form>
    </div>
</body>
</html>
