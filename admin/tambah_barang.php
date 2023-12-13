<?php 

include "session_admin.php";
include "../koneksi.php";

if(isset($_POST["simpan"])) {
    $nama = $_POST["nama"];
    $stok = $_POST["stok"];
    $tanggal_beli = $_POST["tanggal_beli"];
    $kondisi = $_POST["kondisi"];

    $barang = mysqli_query($koneksi, "INSERT INTO barang VALUES(NULL, '$nama', $stok, '$tanggal_beli', '$kondisi')");
    if($barang) {
        echo "<script>
            alert('Data berhasil ditambahkan!');
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

    <div class="container py-5">
        <h2>Konfirmasi Peminjaman</h2>
        <form method="post" class="row g-3 mt-5">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama">
            </div>
            <div class="col-md-6">
                <label class="form-label">Stok</label>
                <input type="text" class="form-control" name="stok">
            </div>
            <div class="col-md-6">
                <label for="inputState" class="form-label">Tanggal Beli</label>
                <input type="date" name="tanggal_beli" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="inputState" class="form-label">Kondisi</label>
                <select class="form-select" name="kondisi" aria-label="Default select example">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                </select>
            </div>
            <div class="col-6">
                <button type="submit" name="simpan" class="btn btn-warning">Simpan</button>
                <a href="index.php" class="btn btn-danger">Batal</a>
            </div>
        </form>

    </div>

</body>

</html>