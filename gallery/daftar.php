<?php
require 'function.php';

// session_start();

if(isset($_SESSION['id_user'])){
    header('Location: index.php');
    exit();
}

// Check apakah Remember
if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    $cookieUsername = mysqli_real_escape_string($conn, $_COOKIE['username']);
    $cookiePassword = mysqli_real_escape_string($conn, $_COOKIE['password']);

    $query = "SELECT * FROM user WHERE username='$cookieUsername' AND password='$cookiePassword'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['id_user'] = $user['userid'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['password'] = $user['password'];

        header('Location: index.php');
        exit();
    }
}

regist();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONTS -->
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <!-- BOOTSRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Daftar Memorize</title>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navigasi d-flex justify-content-center ">
        <img src="src/logo1.png" alt="logo memorize" class="atas">
    </nav>
    <!-- NAVBAR END -->
    <section class="container-sm mt-5 mb-4">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10 formulir p-4">
                <div class="d-flex justify-content-center">
                    <img src="src/Camera.png" alt="kamera">
                </div>
                <h1 class="judul">Daftar Akun</h1>
                <form method="POST" autocomplete="off" onsubmit="return checkPassword() && validasiEmail();">
                    <div class="form-group row justify-content-center">
                        <div class="col-md-6">
                            <label for="NL">Nama Lengkap</label>
                            <input type="text" class="form-control buttonku" name="namaAnda" id="UN" required>
                        </div>
                        <div class="col-md-6">
                            <label for="NA">Username</label>
                            <input type="text" class="form-control buttonku" name="username" id="NA" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 ">
                            <label for="EM" class="text-center">Email</label>
                            <input type="email" class="form-control buttonku" name="email" id="EM" required>
                        </div>

                        <div class="col-md-6 ">
                            <label for="AL" class="text-center">Alamat</label>
                            <input type="text" class="form-control buttonku" name="alamat" id="AL" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="PW">Kata Sandi</label>
                            <input type="password" class="form-control buttonku" name="password" id="PW" required>
                        </div>
                        <div class="col-md-6">
                            <label for="KPW">Konfirmasi Sandi</label>
                            <input type="password" class="form-control buttonku" id="KPW" required>
                        </div>
                    </div>


                    <div class="d-flex justify-content-center consubmit">
                        <input type="submit" class="btn-block buttonku" value="Daftar">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        function checkPassword() {
            const password = document.getElementById("PW").value;
            const confirmPassword = document.getElementById("KPW").value;

            if (password.length < 8) {
                alert('Kata sandi minimal 8 karakter');
                return false;
            }

            if (password !== confirmPassword) {
                alert("Kata sandi tidak cocok. Silakan coba lagi.");
                return false;
            }
            return true;
        }


        function validasiEmail() {
            const email = document.getElementById('EM').value;
            const emailVerify = (input) => {
                const regex = /^[a-z0-9_]+@[a-z]{3,}\.[a-z\.]{3,}$/;
                return regex.test(input);
            };
            if (!emailVerify(email)) {
                alert('Format email tidak valid');
                return false;
            }
            return true;
        }
    </script>
</body>

</html>