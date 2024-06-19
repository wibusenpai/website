<?php
    include "../../connect.php";

    $table = 'kuliner';
    $query = "SELECT * FROM $table";
    $result = mysqli_query($connect, $query);
?>
<div class="container-fluid">
    <div class="card border-0 allContent-section">
        <div class="card-header" style="display: flex; justify-content: space-between;">
            <h5 class="card-title">
                Data Kuliner
            </h5>
            <a href="FormKuliner.php"><button class="btn btn-success" type="button">Tambah Data</button></a>
        </div>
        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nama Kuliner</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jam Buka</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Titik Koordinat</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <th scope="row"><?php echo $row['id_kuliner']; ?></th>
                        <td><?php echo $row['nama_kuliner']; ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                        <td><?php echo $row['harga']; ?></td>
                        <td><?php echo $row['jam_buka']; ?></td>
                        <td><?php echo $row['deskripsi']; ?></td>
                        <td><?php echo $row['latLng']; ?></td>
                        <td> 
                            <a href='FormKuliner.php?id=<?php echo $row['id_kuliner']; ?>'><button class="btn btn-warning" type="button"> Edit </button></a>
                            <a href='delete.php?id=<?php echo $row['id_kuliner']; ?>&table=<?php echo $table; ?>' onclick="return confirm('Anda Ingin Menghapus Data Ini?')"><button class="btn btn-danger" type="button"> Hapus </button></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>