<?php
include "../connect.php";

$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_galeri_wisata = $_POST['id_galeri_wisata'];
    $id_wisata = $_POST['id_wisata'];
    $keterangan = $_POST['keterangan'];

    // File upload handling
    $rand = rand();
    $ekstensi = array('png', 'jpg', 'jpeg', 'gif');
    $filename = $_FILES['gambar']['name'];
    $ukuran = $_FILES['gambar']['size'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if (!in_array($ext, $ekstensi)) {
        header("Location: admin.php?alert=gagal_ekstensi");
        exit();
    } else {
        if ($ukuran < 1044070) {
            $gambar = $rand . '_' . $filename;
            $upload_path = 'C:/xampp/htdocs/RPLLL/img/' . $gambar; // Path yang benar ke folder img
            move_uploaded_file($_FILES['gambar']['tmp_name'], $upload_path);
        } else {
            header("Location: admin.php?alert=gagal_ukuran");
            exit();
        }
    }

    if ($id) {
        $query = "UPDATE `galeri_wisata` SET `id_galeri_wisata`='$id_galeri_wisata', `id_wisata`='$id_wisata', `gambar`='$gambar', `keterangan`='$keterangan' WHERE id_galeri_wisata='$id'";
        $message = "Data berhasil diperbarui";
    } else {
        $query = "INSERT INTO `galeri_wisata`(`id_galeri_wisata`, `id_wisata`, `gambar`, `keterangan`) VALUES ('$id_galeri_wisata','$id_wisata','$gambar','$keterangan')";
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
        $query = "SELECT * FROM galeri_wisata WHERE id_galeri_wisata='$id'";
        $result = mysqli_query($connect, $query);
        $wisata = mysqli_fetch_assoc($result);
        $id_galeri_wisata = $wisata['id_galeri_wisata'];
        $id_wisata = $wisata['id_wisata'];
        $gambar = $wisata['gambar'];
        $keterangan = $wisata['keterangan'];
    } else {
        $id_galeri_wisata = '';
        $id_wisata = '';
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
    <title><?php echo $id ? 'Edit Galeri Wisata' : 'Tambah Galeri Wisata'; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2><?php echo $id ? 'Edit Data Galeri Wisata' : 'Tambah Data Galeri Wisata'; ?></h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="id_galeri_wisata" class="form-label">ID</label>
                <input type="text" class="form-control" id="id_galeri_wisata" name="id_galeri_wisata" value="<?php echo $id_galeri_wisata; ?>" required>
            </div>
            <div class="mb-3">
                <label for="id_wisata" class="form-label">Nama Wisata</label>
                <select class="form-select" id="id_wisata" name="id_wisata" required>
                    <option value="">Pilih Wisata</option>
                    <?php
                    $query = "SELECT * FROM wisata";
                    $result = mysqli_query($connect, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $nama_wisata = $row['nama_wisata'];
                            $selected = ($id_wisata == $row['id_wisata']) ? 'selected' : '';
                            echo "<option value='{$row['id_wisata']}' $selected>$nama_wisata</option>";
                        }
                    } else {
                        echo "<option value='' disabled>Tidak ada data wisata</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Upload Gambar</label>
                <input type="file" class="form-control" id="gambar" name="gambar" required>
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
