<?php
    include "../../connect.php";

    $table = 'galeri_kuliner';
    $query = "SELECT galeri_kuliner.id_galeri_kuliner, kuliner.nama_kuliner, galeri_kuliner.gambar, galeri_kuliner.keterangan FROM $table
    JOIN kuliner ON galeri_kuliner.id_kuliner = kuliner.id_kuliner";
    $result = mysqli_query($connect, $query);
?>
<div class="container-fluid">
    <div class="card border-0 allContent-section">
        <div class="card-header" style="display: flex; justify-content: space-between;">
            <h5 class="card-title">
                Galeri Kuliner
            </h5>
            <a href="FormGaleriKuliner.php"><button class="btn btn-success" type="button">Tambah Data</button></a>
        </div>
        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nama Kuliner</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <th scope="row"><?php echo $row['id_galeri_kuliner']; ?></th>
                        <td><?php echo $row['nama_kuliner']; ?></td>
                        <td><img style="width: 30%;" src="<?php echo $row['gambar']; ?>" alt="<?php echo $row['keterangan']; ?>"></td>
                        <td> 
                            <a href='FormGaleriKuliner.php?id=<?php echo $row['id_galeri_kuliner'] ?>'><button class="btn btn-warning" type="button"> Edit </button></a>
                            <a href='delete.php?id=<?php echo $row['id_galeri_kuliner']; ?>&table=<?php echo $table; ?>' onclick="return confirm('Anda Ingin Menghapus Data Ini?')"><button class="btn btn-danger" type="button"> Hapus </button></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>