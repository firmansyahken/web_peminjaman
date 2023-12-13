<?php 

include "session_admin.php";
include "../koneksi.php";

$query_barang = mysqli_query($koneksi, "SELECT * FROM barang");

if(isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $delete = mysqli_query($koneksi, "DELETE FROM barang WHERE id = $id");
    if($delete) {
        echo "<script>
            alert('Data berhasil dihapus!');
            window.location.href = 'index.php';
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
        <h2>Data Peralatan</h2>
        <a href="../logout.php" class="btn btn-danger">Logout</a>
    </div>  
    <div class="d-flex align-items-center">
        <div style="margin-right: 10px;">
            <a href="/admin/permintaan.php" class="btn btn-primary">Daftar Permintaan Pinjaman</a>
        </div>
        <div>
            <a href="/admin/tambah_barang.php" class="btn btn-warning">Tambah Barang</a>
        </div>
    </div>  

    <div class="table-container py-4 mt-2">
        <table class="table table-bordered">
            <thead>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Tanggal Beli</th>
                <th>Kondisi</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                <?php 
                    $no = 1;
                    while($barang = mysqli_fetch_assoc($query_barang)) {
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $barang["nama"]; ?></td>
                    <td><?= $barang["stok"] < 1 ? "Stok Habis" : $barang["stok"]; ?></td>
                    <td><?= $barang["tanggal_beli"]; ?></td>
                    <td><?= $barang["kondisi"]; ?></td>
                    <td>
                        <a href="/admin/edit_barang.php?id=<?= $barang['id']; ?>" class="btn btn-warning">Edit</a>
                        <a onclick="return confirm('Yakin untuk dihapus ?')" href="/admin/index.php?delete=<?= $barang['id']; ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


    
</div>

  </body>
</html>