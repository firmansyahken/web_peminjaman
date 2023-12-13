<?php 

session_start();
include "koneksi.php";

if(isset($_POST["login"])) {
    $nama = $_POST["nama"];
    $password = $_POST["password"];
    $login = mysqli_query($koneksi, "SELECT * FROM user WHERE nama = '$nama' AND password = '$password'");
    $user = mysqli_fetch_assoc($login);
    if(mysqli_num_rows($login) === 1) {
        $_SESSION["login"] = true;
        $_SESSION["user"] = $user;
        $_SESSION["level"] = $user["level"];
        if($user["level"] === "0") {
            header("Location: index.php");
        } else {
            header("Location: /admin");
        }
    } else {
        echo "<script>
            alert('Username / Password Salah!');
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login Form</title>
</head>

<body>

    <form method="post">

        <div class="container mt-5 py-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card py-5 px-5">
                        <h3 class="text-center">Login</h3>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="username" name="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>