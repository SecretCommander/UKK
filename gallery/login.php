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
    <title>Masuk Memorize</title>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navigasi d-flex justify-content-center ">
        <img src="src/logo1.png" alt="logo memorize" class="atas">
    </nav>
    <!-- NAVBAR END -->
    <section class="container d-flex justify-content-center align-items-center mt-5">
        <div class="row formulir p-4">
            <div class="col">
                <div class="d-flex justify-content-center">
                    <img src="src/Camera.png" alt="kamera">
                </div>
                <h1 class="judul">Selamat Datang!</h1>
                <form method="POST">
                    <div class="form-group">
                        <label for="NL">Nama Lengkap</label>
                        <input type="text" class="buttonku form-control" name="namaLengkap" id="NL" required>
                    </div>
                    <div class="form-group">
                        <label for="PW">Kata Sandi</label>
                        <input type="password" class="form-control buttonku" name="password" id="PW" required>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="check" id="RM" required>
                        <label for="RM" class="form-check-label">Remember Me</label>
                    </div>
                    <div class="d-flex justify-content-center consubmit">
                        <input type="submit" class="btn-block buttonku" value="Masuk">
                    </div>
                </form>
                <p class="text-center jarak">Belum punya akun? <a href="daftar.php">Daftar</a></p>
            </div>
        </div>
    </section>

</body>

</html>