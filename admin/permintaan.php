<?php

include "session_admin.php";
include "../koneksi.php";

$query_keranjang = mysqli_query($koneksi, "SELECT keranjang.id as id, user.nama as peminjam, barang.nama as barang, 
total_pinjam, tanggal_pinjam FROM keranjang JOIN(user) ON user.id = keranjang.user_id 
JOIN(barang) ON barang.id = keranjang.barang_id");

if(isset($_GET["konfirmasi"])) {
    $id = $_GET["konfirmasi"];
    $barang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM keranjang WHERE id = $id"));
    $user_id = $barang["user_id"];
    $barang_id = $barang["barang_id"];
    $total_pinjam = $barang["total_pinjam"];
    $tanggal_pinjam = $barang["tanggal_pinjam"];
    $peminjaman = mysqli_query($koneksi, "INSERT INTO peminjaman VALUES(NULL, $user_id, $barang_id, $total_pinjam, '$tanggal_pinjam')");

    if($peminjaman) {
        mysqli_query($koneksi, "DELETE FROM keranjang WHERE id = $id");
        echo "<script>
            alert('Data berhasil dikonfirmasi!');
            window.location.href = 'permintaan.php';
        </script>";
    }
}

if(isset($_GET["tolak"])) {
    $id = $_GET["tolak"];
    $barang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM keranjang WHERE id = $id"));
    $barang_id = $barang["barang_id"];
    $total_pinjam = $barang["total_pinjam"];

    $stok = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT stok FROM barang WHERE id = $barang_id"))["stok"];

    $update_barang = mysqli_query($koneksi, "UPDATE barang SET stok = $stok + $total_pinjam WHERE id = $barang_id");
    $delete_keranjang = mysqli_query($koneksi, "DELETE FROM keranjang WHERE id = $id");

    if($delete_keranjang) {
        echo "<script>
            alert('Permintaan ditolak!');
            window.location.href = 'permintaan.php';
        </script>";
    }
}


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
            <h2>Permintaan Peminjaman</h2>
        </div>

        <a href="/admin" class="btn btn-warning">Kembali</a>

        <div class="table-container py-4 mt-2">
            <table class="table table-bordered">
                <thead>
                    <th>No</th>
                    <th>Peminjam</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Tanggal Pinjam</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($keranjang = mysqli_fetch_assoc($query_keranjang)) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $keranjang["peminjam"]; ?></td>
                            <td><?= $keranjang["barang"]; ?></td>
                            <td><?= $keranjang["total_pinjam"]; ?></td>
                            <td><?= $keranjang["tanggal_pinjam"]; ?></td>
                            <td>
                                <a href="permintaan.php?konfirmasi=<?= $keranjang['id']; ?>" class="btn btn-warning">Konfirmasi</a>
                                <a href="permintaan.php?tolak=<?= $keranjang['id']; ?>" class="btn btn-danger">Tolak</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>



    </div>

</body>

</html>