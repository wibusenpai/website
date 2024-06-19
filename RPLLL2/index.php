<?php
    include "connect.php";

    $search_wisata = isset($_GET['search_wisata']) ? $_GET['search_wisata'] : '';
    $jenis_wisata = isset($_GET['jenis_wisata']) ? $_GET['jenis_wisata'] : '';

    $query_wisata = "SELECT wisata.id_wisata, wisata.nama_wisata, wisata.alamat, galeri_wisata.id_galeri_wisata, galeri_wisata.gambar, galeri_wisata.keterangan
            FROM wisata
            JOIN (SELECT id_wisata, MIN(id_galeri_wisata) as min_id_galeri_wisata 
            FROM galeri_wisata 
            GROUP BY id_wisata) as sub_gw
            ON wisata.id_wisata = sub_gw.id_wisata
            JOIN galeri_wisata
            ON sub_gw.id_wisata = galeri_wisata.id_wisata AND sub_gw.min_id_galeri_wisata = galeri_wisata.id_galeri_wisata
            WHERE (wisata.nama_wisata LIKE '%$search_wisata%' OR wisata.alamat LIKE '%$search_wisata%')";

    if ($jenis_wisata) {
        $query_wisata .= " AND wisata.jenis_wisata = '$jenis_wisata'";
    }

    $wisata = mysqli_query($connect, $query_wisata);

    $search_kuliner = isset($_GET['search_kuliner']) ? $_GET['search_kuliner'] : '';

    $query_kuliner = "SELECT kuliner.id_kuliner, kuliner.nama_kuliner, kuliner.alamat, galeri_kuliner.id_galeri_kuliner, galeri_kuliner.gambar, galeri_kuliner.keterangan
            FROM kuliner
            JOIN (SELECT id_kuliner, MIN(id_galeri_kuliner) as min_id_galeri_kuliner 
            FROM galeri_kuliner 
            GROUP BY id_kuliner) as sub_gk
            ON kuliner.id_kuliner = sub_gk.id_kuliner
            JOIN galeri_kuliner
            ON sub_gk.id_kuliner = galeri_kuliner.id_kuliner AND sub_gk.min_id_galeri_kuliner = galeri_kuliner.id_galeri_kuliner
            WHERE kuliner.nama_kuliner LIKE '%$search_kuliner%' OR kuliner.alamat LIKE '%$search_kuliner%'";

    $kuliner = mysqli_query($connect, $query_kuliner);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>BangkalanKu</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="assets/css/styles.css" rel="stylesheet">
    </head>
    <body>
        <!-- Header -->
        <header>
            <nav>
                <h1 class="logo">
                    <a href="">Bangkalan</a>
                </h1>
            </nav>
            <div class="title">BANGKALAN</div>
            <div class="bottom">
                <p class="date" id="date" style="color: #fafafa;"></p>
                <ul class="social">
                    <li><a href="https://www.youtube.com/">Youtube.</a></li>
                    <li><a href="https://www.instagram.com/">Instagram.</a></li>
                    <li><a href="https://www.facebook.com/">Facebook.</a></li>
                </ul>
            </div>
        </header>
        <!-- About -->
        <div class="container py-5">
            <h1 class="text-center">DESTINASI</h1>
            <hr>
            <br><br>
            <form method="GET" action="">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search_wisata" placeholder="Cari wisata..." value="<?php echo htmlspecialchars($search_wisata); ?>">
                    <select class="form-select" name="jenis_wisata">
                        <option value="">Pilih Jenis Wisata</option>
                        <option value="wisata religi" <?php if ($jenis_wisata == 'wisata religi') echo 'selected'; ?>>Wisata Religi</option>
                        <option value="wisata alam" <?php if ($jenis_wisata == 'wisata alam') echo 'selected'; ?>>Wisata Alam</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
            <div class="row row-cols-1 row-cols-md-3 g-4 py-5">
            <?php while ($row = mysqli_fetch_assoc($wisata)) { ?>
                <div class="col">
                    <div class="card">
                        <img src="<?php echo $row['gambar']; ?>" alt="<?php echo $row['keterangan']; ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['nama_wisata']; ?></h5>
                            <p class="card-text"><?php echo $row['alamat']; ?></p>
                        </div>
                        <div class="mb-5 d-flex justify-content-around">
                            <a href='maps_wisata.php?id=<?php echo $row['id_wisata']; ?>'><button class="btn btn-primary">Lihat</button></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>

        <div class="container py-5">
            <h1 class="text-center">KULINER</h1>
            <hr>
            <br><br>
            <form method="GET" action="">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search_kuliner" placeholder="Cari kuliner..." value="<?php echo htmlspecialchars($search_kuliner); ?>">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
            <div class="row row-cols-1 row-cols-md-3 g-4 py-5">
            <?php while ($row = mysqli_fetch_assoc($kuliner)) { ?>
                <div class="col">
                    <div class="card">
                        <img src="<?php echo $row['gambar']; ?>" alt="<?php echo $row['keterangan']; ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['nama_kuliner']; ?></h5>
                            <p class="card-text"><?php echo $row['alamat']; ?></p>
                        </div>
                        <div class="mb-5 d-flex justify-content-around">
                            <a href='maps_kuliner.php?id=<?php echo $row['id_kuliner']; ?>'><button class="btn btn-primary">Lihat</button></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; 2024 RPL. All rights reserved.  || <a style="color: #000;" href="admin/login.php">Admin</a></p>
        </footer>

        <script>
            var dateElement = document.getElementById("date");
            var today = new Date();
            var date = today.getDate();
            var month = today.getMonth() + 1;
            var formattedDate = ('0' + date).slice(-2) + ' / ' + ('0' + month).slice(-2);
            dateElement.innerHTML = formattedDate;

            // Menghapus parameter pencarian dari URL setelah halaman dimuat
            if(window.history.replaceState) {
                window.history.replaceState(null, null, window.location.pathname);
            }
        </script>  
    </body>
</html>
