<?php
    include "../../connect.php";

    $table = 'ulasan_wisata';
    $query = "SELECT ulasan_wisata.id_ulasan_wisata, wisata.nama_wisata, ulasan_wisata.ulasan, ulasan_wisata.rating FROM $table
    JOIN wisata ON ulasan_wisata.id_wisata = wisata.id_wisata";
    $result = mysqli_query($connect, $query);
?>
<div class="container-fluid">
    <div class="card border-0 allContent-section">
        <div class="card-header" style="display: flex; justify-content: space-between;">
            <h5 class="card-title">
                Ulasan Destinasi Wisata
            </h5>
        </div>
        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nama Wisata</th>
                        <th scope="col">Ulasan</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <th scope="row"><?php echo $row['id_ulasan_wisata']; ?></th>
                        <td><?php echo $row['nama_wisata']; ?></td>
                        <td><?php echo $row['ulasan']; ?></td>
                        <td><?php echo $row['rating']; ?></td>
                        <td> 
                            <a href='delete.php?id=<?php echo $row['id_ulasan_wisata']; ?>&table=<?php echo $table; ?>' onclick="return confirm('Anda Ingin Menghapus Data Ini?')"><button class="btn btn-danger" type="button"> Hapus </button></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>