<?php
    session_start();
    include "../connect.php";

    if (!isset($_SESSION['username'])) {
        header("Location:login.php");
    }

    $table = 'admin';
    $query = "SELECT * FROM $table";
    $result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin || Bangkalan</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
        <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../assets/css/admin.css">
    </head>

    <body>
        <div class="wrapper">
            <aside id="sidebar" class="js-sidebar">
                <!-- Content For Sidebar -->
                <div class="h-100">
                    <div class="sidebar-logo">
                        <a href="#">BANGKALAN</a>
                    </div>
                    <ul class="sidebar-nav">
                        <li class="sidebar-item">
                            <a href="#DataAdmin" onclick="showDataAdmin()" class="sidebar-link">
                                <i class="fa-regular fa-user pe-2"></i>
                                Data Admin
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#multi" data-bs-toggle="collapse"
                                aria-expanded="false"><i class="fa-solid fa-share-nodes pe-2"></i>
                                Data Wisata
                            </a>
                            <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="#DataDestinasi" onclick="showDataDestinasi()" class="sidebar-link">Data Destinasi</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#GaleriWisata" onclick="showGaleriWisata()" class="sidebar-link">Galeri Wisata</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#GaleriWisata" onclick="showUlasanWisata()" class="sidebar-link">Ulasan Wisata</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#posts" data-bs-toggle="collapse"
                                aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                                Data Kuliner
                            </a>
                            <ul id="posts" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="#DataKuliner" onclick="showDataKuliner()" class="sidebar-link">Data Kuliner</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#GaleriKuliner" onclick="showGaleriKuliner()" class="sidebar-link">Galeri Kuliner</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#UlasanKuliner" onclick="showUlasanKuliner()" class="sidebar-link">UlasanKuliner</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </aside>
            <div class="main">
                <nav class="navbar navbar-expand px-3 border-bottom">
                    <button class="btn" id="sidebar-toggle" type="button">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-collapse navbar">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                    <img src="../img/user.png" class="avatar img-fluid rounded" alt="">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="logout.php" class="dropdown-item">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <main class="content px-3 py-2 allContent-section">
                    <div class="container-fluid">
                        <div class="card border-0 allContent-section">
                            <div class="card-header" style="display: flex; justify-content: space-between;">
                                <h5 class="card-title">
                                    Data Admin
                                </h5>
                                <a href="FormAdmin.php"><button class="btn btn-success" type="button">Tambah Data</button></a>
                            </div>
                            <div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">Password</th>
                                            <th scope="col">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <th scope="row"><?php echo $row['id_admin']; ?></th>
                                            <td><?php echo $row['nama_admin']; ?></td>
                                            <td><?php echo $row['username']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['alamat']; ?></td>
                                            <td><?php echo $row['password']; ?></td>
                                            <td> 
                                                <a href='FormAdmin.php?id=<?php echo $row['id_admin']; ?>'><button class="btn btn-warning" type="button"> Edit </button></a>
                                                <a href='delete.php?id=<?php echo $row['id_admin']; ?>&table=<?php echo $table; ?>' onclick="return confirm('Anda Ingin Menghapus Data Ini?')"><button class="btn btn-danger" type="button"> Hapus </button></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row text-muted">
                            <div class="col-6 text-start">
                                <p class="mb-0">
                                    <a href="#" class="text-muted">
                                        <strong>Kelompok 9 RPL IF4A</strong>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
        <script src="../assets/js/script.js"></script>
        <script type="text/javascript" src="../assets/js/function.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
