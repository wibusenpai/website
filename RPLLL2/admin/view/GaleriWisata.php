<?php
include "../../connect.php";

$table = 'galeri_wisata';
$query = "SELECT galeri_wisata.id_galeri_wisata, wisata.nama_wisata, galeri_wisata.gambar, galeri_wisata.keterangan FROM $table
JOIN wisata ON galeri_wisata.id_wisata = wisata.id_wisata";
$result = mysqli_query($connect, $query);
?>
<div class="container-fluid">
    <div class="card border-0 allContent-section">
        <div class="card-header" style="display: flex; justify-content: space-between;">
            <h5 class="card-title">
                Galeri Destinasi Wisata
            </h5>
            <a href="FormGaleriWisata.php"><button class="btn btn-success" type="button">Tambah Data</button></a>
        </div>
        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nama Wisata</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <th scope="row"><?php echo $row['id_galeri_wisata']; ?></th>
                        <td><?php echo $row['nama_wisata']; ?></td>
                        <td><img style="width: 30%;" src="../img/<?php echo $row['gambar']; ?>" alt="<?php echo $row['keterangan']; ?>"></td>
                        <td> 
                            <a href='FormGaleriWisata.php?id=<?php echo $row['id_galeri_wisata'] ?>'><button class="btn btn-warning" type="button"> Edit </button></a>
                            <a href='delete.php?id=<?php echo $row['id_galeri_wisata']; ?>&table=<?php echo $table; ?>' onclick="return confirm('Anda Ingin Menghapus Data Ini?')"><button class="btn btn-danger" type="button"> Hapus </button></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
