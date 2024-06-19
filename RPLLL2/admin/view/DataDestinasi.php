<?php
    include "../../connect.php";

    $table = 'wisata';
    $query = "SELECT * FROM $table";
    $result = mysqli_query($connect, $query);
?>
<div class="container-fluid">
    <div class="card border-0 allContent-section">
        <div class="card-header" style="display: flex; justify-content: space-between;">
            <h5 class="card-title">
                Data Destinasi Wisata
            </h5>
            <a href="FormWisata.php"><button class="btn btn-success" type="button">Tambah Data</button></a>
        </div>
        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nama Wisata</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Harga Tiket</th>
                        <th scope="col">Jam Buka</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Jenis Wisata</th>
                        <th scope="col">Titik Koordinat</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <th scope="row"><?php echo $row['id_wisata']; ?></th>
                        <td><?php echo $row['nama_wisata']; ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                        <td><?php echo $row['harga_tiket']; ?></td>
                        <td><?php echo $row['jam_buka']; ?></td>
                        <td><?php echo $row['deskripsi']; ?></td>
                        <td><?php echo $row['jenis_wisata']; ?></td>
                        <td><?php echo $row['latLng']; ?></td>
                        <td> 
                            <a href='FormWisata.php?id=<?php echo $row['id_wisata']; ?>'><button class="btn btn-warning" type="button"> Edit </button></a>
                            <a href='delete.php?id=<?php echo $row['id_wisata']; ?>&table=<?php echo $table; ?>' onclick="return confirm('Anda Ingin Menghapus Data Ini?')"><button class="btn btn-danger" type="button"> Hapus </button></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>