<?php
include "connect.php";

$id = isset($_GET['id']) ? $_GET['id'] : '';

$img = "SELECT galeri_wisata.gambar, galeri_wisata.keterangan
    FROM galeri_wisata
    WHERE galeri_wisata.id_wisata = '$id'
    LIMIT 1;";
$gambar = mysqli_query($connect, $img);
$hasil = $connect->query($img);
if ($hasil->num_rows > 0) {
    $row = $hasil->fetch_assoc();  
    $gambar = $row['gambar'];
}

$sql = "SELECT * FROM wisata WHERE id_wisata='$id'";
$result = $connect->query($sql);
if ($result->num_rows > 0) {
    // Output data dari setiap baris
    $row = $result->fetch_assoc();
    
    $nama_wisata = $row['nama_wisata'];
    $alamat = $row['alamat'];
    $harga_tiket = $row['harga_tiket'];
    $jam_buka = $row['jam_buka'];
    $deskripsi = $row['deskripsi'];
    $latLng = $row['latLng'];
}

$query_galeri = "SELECT galeri_wisata.gambar, galeri_wisata.keterangan
    FROM galeri_wisata
    WHERE galeri_wisata.id_wisata = '$id';";

$album = mysqli_query($connect, $query_galeri);

$query_ulasan = "SELECT ulasan_wisata.ulasan, ulasan_wisata.rating
    FROM ulasan_wisata
    WHERE ulasan_wisata.id_wisata = '$id';";
$ulasan = mysqli_query($connect, $query_ulasan);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>BangkalanKu</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="assets/css/detail.css" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM/Eij5cXaG0N4Y0E8vXDb2VXcrbBBMPTAv7eq1" crossorigin="anonymous">

        <style>
            .header-img {
                background: url('<?php echo $gambar; ?>') no-repeat center center;
                background-size: cover;
                height: 50vh;
                position: relative;
            }
            .rating {
                direction: rtl;
                unicode-bidi: bidi-override;
                display: flex;
                justify-content: center;
                width: 200px;
            }

            .rating input {
                display: none;
            }

            .rating label {
                font-size: 2em;
                color: #ddd;
                cursor: pointer;
            }

            .rating input:checked ~ label,
            .rating label:hover,
            .rating label:hover ~ label {
                color: #ffca08;
            }

            .nav-buttons {
                display: flex;
                justify-content: center;
                gap: 10px;
                margin-top: 20px;
            }

            .nav-buttons button {
                background-color: #007bff;
                border: none;
                color: white;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .nav-buttons button:hover {
                background-color: #0056b3;
            }

            #map-container {
                display: flex;
                justify-content: center;
                margin-top: 20px;
            }

            #map {
                width: 80%;
                height: 400px;
                border: 2px solid #ddd;
                border-radius: 5px;
            }

            .reviews {
                margin: 20px;
            }

            .reviews h2 {
                margin-bottom: 20px;
                font-size: 24px;
                color: #333;
                text-align: center;
            }

            .review {
                background-color: #e0e0e0;
                padding: 15px;
                border-radius: 10px;
                margin-bottom: 20px;
                display: flex;
                flex-direction: column; /* Stack elements vertically */
            }

            .review:last-child {
                border-bottom: none;
            }

            .review img {
                width: 50px;
                height: 50px;
                margin-right: 10px;
            }

            .review p {
                margin: 0;
            }

            .review .rating {
            margin-top: 10px;
            font-size: 1.2em;
            }


            .review-form {
                margin: 20px;
                padding: 20px;
                border: 2px solid #ddd;
                border-radius: 5px;
                background-color: #f9f9f9;
            }

            .review-form h2 {
                margin-bottom: 20px;
                font-size: 24px;
                color: #333;
                text-align: center;
            }

            .review-form .form-label {
                font-size: 16px;
                color: #333;
            }

            .review-form .form-control {
                margin-bottom: 10px;
                font-size: 14px;
            }

            .review-form .rating {
                display: flex;
                justify-content: center;
                margin-top: 10px;
            }

            .review-form .rating input {
                display: none;
            }

            .review-form .rating label {
                font-size: 2em;
                color: #ddd;
                cursor: pointer;
                padding: 0 5px;
            }

            .review-form .rating input:checked ~ label,
            .review-form .rating label:hover,
            .review-form .rating label:hover ~ label {
                color: #ffca08;
            }

            .review-form .btn {
                display: block;
                width: 100%;
                padding: 10px;
                background-color: #007bff;
                border: none;
                color: white;
                font-size: 16px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .review-form .btn:hover {
                background-color: #0056b3;
            }
        </style>

    </head>
    <body>
        <!-- Header -->
        <header class="header-img">
            <div class="content">
                <h1><?php echo $nama_wisata; ?></h1>
            </div>
        </header>

        <!-- About -->
        <div class="about-section">
            <h2>About <?php echo $nama_wisata; ?></h2>
            <p>
                <?php echo $deskripsi; ?>
                <br>
                <br>
                Lokasi Wisata berada di <?php echo $alamat; ?>, Jam operasi wisata ini yaitu <?php echo $jam_buka; ?>, Untuk Harga masuknya adalah <?php echo $harga_tiket; ?>
            </p>
        </div>

        <!-- Maps -->
        <br>
        <div id="map-container">
            <div id="map"></div>
        </div>

        <div class="nav-buttons">
            <button onclick="calculateAndDisplayRoute()">Get Directions</button>
            <button onclick="startNavigation()">Start Navigation</button>
        </div>
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
        <script>
            let userLocation = null;
            const destination = L.latLng(<?php echo $latLng; ?>); // Lokasi tujuan

            // Inisialisasi peta
            const map = L.map('map').setView(destination, 14);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            const marker = L.marker(destination).addTo(map).bindPopup('Destination').openPopup();

            let control = null;

            // Fungsi untuk menghitung dan menampilkan rute dari lokasi user ke tujuan
            function calculateAndDisplayRoute() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(position => {
                        userLocation = L.latLng(position.coords.latitude, position.coords.longitude);

                        if (control) {
                            map.removeControl(control);
                        }

                        control = L.Routing.control({
                            waypoints: [
                                userLocation,
                                destination
                            ],
                            router: L.Routing.osrmv1({
                                serviceUrl: 'https://router.project-osrm.org/route/v1'
                            }),
                            createMarker: function(i, waypoint, n) {
                                const markerOptions = {
                                    draggable: false
                                };
                                return L.marker(waypoint.latLng, markerOptions);
                            }
                        }).addTo(map);
                    }, () => {
                        alert('Geolocation failed');
                    });
                } else {
                    alert('Browser does not support Geolocation');
                }
            }

            // Fungsi untuk memulai navigasi di peta
            function startNavigation() {
                if (userLocation) {
                    const url = `https://www.openstreetmap.org/directions?engine=fossgis_osrm_car&route=${userLocation.lat},${userLocation.lng};${destination.lat},${destination.lng}`;
                    window.open(url, '_blank');
                } else {
                    alert('User location not available. Please get directions first.');
                }
            }
        </script>

        <!-- Gallery -->
        <h2 style="margin: 20px;margin-top: 70px; border-top: 2px solid #ddd; padding-top: 20px;">Galeri Wisata</h2>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php 
                $index = 0;
                $isActive = 'active';
                $album = mysqli_query($connect, $query_galeri); // Re-run the query
                while ($row = mysqli_fetch_assoc($album)) { ?>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $isActive; ?>" aria-current="true" aria-label="Slide <?php echo $index + 1; ?>"></button>
                    <?php 
                    $index++;
                    $isActive = '';
                } ?>
            </div>
            <div class="carousel-inner">
                <?php 
                $index = 0;
                $isActive = 'active';
                $album = mysqli_query($connect, $query_galeri); // Re-run the query
                while ($row = mysqli_fetch_assoc($album)) { ?>
                    <div class="carousel-item <?php echo $isActive; ?>">
                        <img src="<?php echo $row['gambar']; ?>" class="d-block w-100" alt="<?php echo $row['keterangan']; ?>">
                    </div>
                    <?php 
                    $index++;
                    $isActive = '';
                } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Reviews -->
        <div class="reviews">
            <h2>Ulasan Wisata</h2>
            <?php while ($row = mysqli_fetch_assoc($ulasan)) { ?>
                <div class="review">
                    <p><img src="img/user.png" alt="anonym">Guest<br></p>
                    <p>Ulasan:<?php echo $row['ulasan']; ?></p>
                    <?php if ($row['rating'] !== NULL && $row['rating'] > 0) { ?>
                        <p>Rating: <?php echo str_repeat('★', $row['rating']) . str_repeat('☆', 5 - $row['rating']); ?></p>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>

        <!-- Review Form -->
        <div class="review-form">
            <h2>Tulis Ulasan</h2>
            <form action="submit_wisata.php" method="post">
                <input type="hidden" name="id_wisata" value="<?php echo $id; ?>">
                <div class="mb-3">
                    <label for="ulasan" class="form-label">Ulasan:</label>
                    <textarea class="form-control" id="ulasan" name="ulasan" rows="2" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating:</label>
                    <div class="rating">
                        <input type="radio" name="rating" id="star5" value="5"><label for="star5" class="fa fa-star">&#9733;</label>
                        <input type="radio" name="rating" id="star4" value="4"><label for="star4" class="fa fa-star">&#9733;</label>
                        <input type="radio" name="rating" id="star3" value="3"><label for="star3" class="fa fa-star">&#9733;</label>
                        <input type="radio" name="rating" id="star2" value="2"><label for="star2" class="fa fa-star">&#9733;</label>
                        <input type="radio" name="rating" id="star1" value="1"><label for="star1" class="fa fa-star">&#9733;</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <!-- Footer -->
        <footer class="footer">
            <p>&copy; 2024 RPL. All rights reserved.</p>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlknK0QK7HYpCwfa8dBtD8RXau8r/ab+q9vF5N1R4gZLGhtOUCZ5d2IxP6L" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGfrmCrYVYl2r0KVbb+37e1PStE3FnCj8i5i47QBiWXr9I8qkSLVx0xIM+7" crossorigin="anonymous"></script>
    </body>
</html>
