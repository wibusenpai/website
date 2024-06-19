<?php
include "../connect.php";

$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_admin = $_POST['id_admin'];
    $username = $_POST['username'];
    $nama = $_POST['nama_admin'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $password = $_POST['password'];

    if ($id) {
        $query = "UPDATE admin SET username='$username', nama_admin='$nama', password='$password', alamat='$alamat', email='$email' WHERE id_admin='$id'";
        $message = "Data berhasil diperbarui";
    } else {
        $query = "INSERT INTO `admin`(`id_admin`, `username`, `nama_admin`, `password`, `alamat`, `email`) VALUES ('$id_admin', '$username', '$nama', '$password', '$alamat', '$email')";
        $message = "Data berhasil ditambahkan";
    }

    if (mysqli_query($connect, $query)) {
        $_SESSION['message'] = $message;
        header("Location: ../admin.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connect);
    }
} else {
    if ($id) {
        $query = "SELECT * FROM admin WHERE id_admin='$id'";
        $result = mysqli_query($connect, $query);
        $admin = mysqli_fetch_assoc($result);
        $id_admin = $admin['id_admin'];
        $nama = $admin['nama_admin'];
        $username = $admin['username'];
        $email = $admin['email'];
        $alamat = $admin['alamat'];
        $password = $admin['password'];
    } else {
        $id_admin = '';
        $nama = '';
        $username = '';
        $email = '';
        $alamat = '';
        $password = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $id ? 'Edit Admin' : 'Tambah Admin'; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2><?php echo $id ? 'Edit Data Admin' : 'Tambah Data Admin'; ?></h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="id_admin" class="form-label">ID</label>
                <input type="text" class="form-control" id="id_admin" name="id_admin" value="<?php echo $id_admin; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama_admin" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama_admin" name="nama_admin" value="<?php echo $nama; ?>" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat; ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary"><?php echo $id ? 'Update' : 'Submit'; ?></button>
        </form>
    </div>
</body>
</html>
