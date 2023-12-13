<?php 

include "session_user.php";
include "koneksi.php";

$user_id = $user_session["id"];
$nama = $user_session["nama"];

$id = $_GET["id"];

$query_barang = mysqli_query($koneksi, "SELECT * FROM barang WHERE id = $id");
$barang = mysqli_fetch_assoc($query_barang);

if($barang["kondisi"] === "Rusak") {
    echo "<script>
        alert('Barang sedang rusak!. Tidak bisa dipinjam');
        window.location.href = 'index.php';
    </script>";
    exit;
}

if($barang["stok"] < 1) {
    echo "<script>
        alert('Stok barang sudah habis!. Tidak bisa dipinjam');
        window.location.href = 'index.php';
    </script>";
    exit;
}

if(isset($_POST["pinjam"])) {
    $total_pinjam = $_POST["total_pinjam"];
    $tanggal_pinjam = $_POST["tanggal_pinjam"];
    $stok = $barang["stok"];

    if($total_pinjam > $stok) {
        echo "<script>
            alert('Stok barang tidak cukup!');
            window.location.href = 'index.php'
        </script>";

        exit;
    }

    $pinjam = mysqli_query($koneksi, "INSERT INTO keranjang VALUES(NULL, $user_id, $id, $total_pinjam, '$tanggal_pinjam')");
    
    if($pinjam) {
        mysqli_query($koneksi, "UPDATE barang SET stok = ($stok - $total_pinjam) WHERE id = $id");
        echo "<script>
            alert('Barang berhasil dipinjam!');
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
                <input type="text" class="form-control" value="<?= $nama ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Barang</label>
                <input type="text" name="barang_id" class="form-control" value="<?= $barang['nama']; ?>">
            </div>
            <div class="col-md-6">
                <label for="inputCity" class="form-label">Jumlah</label>
                <input type="number" name="total_pinjam" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="inputState" class="form-label">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" class="form-control" value="<?= date("Y-m-d");?>">
            </div>
            <div class="col-6">
                <button type="submit" name="pinjam" class="btn btn-warning">Pinjam</button>
                <a href="/" class="btn btn-danger">Batal</a>
            </div>
        </form>

    </div>

</body>

</html>