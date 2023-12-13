<?php 

include "session_user.php";
include "koneksi.php";

$user_id = $user_session["id"];
$query_peminjaman = mysqli_query($koneksi, "SELECT barang.nama as barang, total_pinjam, tanggal_pinjam FROM peminjaman JOIN(barang) ON barang.id = peminjaman.barang_id WHERE user_id = $user_id");

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>

  <div class="container">
    <div class="d-flex justify-content-between align-items-center py-4">
        <h2>Barang Pinjaman</h2>
    </div>  
    <a class="btn btn-warning" href="/">Kembali</a>
    <div class="table-container py-4 mt-2">
        <table class="table table-bordered">
            <thead>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Tanggal Pinjam</th>
            </thead>
            <tbody>
                <?php 
                    $no = 1;
                    while($peminjaman = mysqli_fetch_assoc($query_peminjaman)) {
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $peminjaman["barang"]; ?></td>
                    <td><?= $peminjaman["total_pinjam"]; ?></td>
                    <td><?= $peminjaman["tanggal_pinjam"]; ?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>


    
</div>

  </body>
</html>