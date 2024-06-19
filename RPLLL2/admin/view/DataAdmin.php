<?php
    include "../../connect.php";

    $table = 'admin';
    $query = "SELECT * FROM $table";
    $result = mysqli_query($connect, $query);
?>
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
                <?php $table = 'admin'; while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <th scope="row"><?php echo $row['id_admin']; ?></th>
                        <td><?php echo $row['nama_admin']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                        <td><?php echo $row['password']; ?></td>
                        <td> 
                            <a href='formadmin.php?id=<?php echo $row['id_admin']; ?>'><button class="btn btn-warning" type="button"> Edit </button></a>
                            <a href='delete.php?id=<?php echo $row['id_admin']; ?>&table=<?php echo $table; ?>' onclick="return confirm('Anda Ingin Menghapus Data Ini?')"><button class="btn btn-danger" type="button"> Hapus </button></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>