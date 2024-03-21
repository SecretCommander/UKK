<?php
require('function.php');
if (isset($_SESSION['id_user']) && detail_data_user(trim($_SESSION['id_user']))) {
    $rowU = mysqli_fetch_assoc($result);
}

if (detail_data_user(trim($_GET['user']))) {
    $row1 = mysqli_fetch_assoc($result);
}

$user = all_gambar(trim($_GET['user'])); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profil.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- BOOTSRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Memorize | Profil</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="src/logo1.png" alt="logo memorize" class="logo-img">
            </a>
            <div class="d-sm-flex align-items-center justify-content-center page-title-container edit">
                <h2 class="m-0 pe-5 page-title edit" data-bs-toggle="modal" data-bs-target="#addAlbumModal"><?= $row1['username']?></h2>
            </div>
            <?php
            if(empty($_SESSION['id_user'])){?>
            <div class="atas pas">
                <a href="login.php" class="btn linkan masuk">Masuk</a>
                <a href="daftar.php" class="btn linkan daftar">Daftar</a>
            </div>
            <?php } else{ ?>
            <div class="dropdown me-2">
                <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="profile/<?php echo $rowU['profile'] == "" || $rowU['profile'] == null ? "nopict.png" : $rowU['profile']; ?>" alt="profil" class="profil-img">
                </a>
                <ul class="dropdown-menu dropdown-menu-end custom-dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="profileUser.php">Profil</a></li>
                    <li><a class="dropdown-item" href="album.php">Album</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </div>
            <?php }?>
        </div>
    </nav>

    <div class="container-fluid profile">
        <div class="row profile-info">
            <div class="col-4 text-center">
                <!-- Image container -->
                <div class="image-container" style="text-align: center;">
                    <img src="profile/<?php echo $row1['profile'] == "" || $row1['profile'] == null ? "nopict.png" : $row1['profile']; ?>" alt="Profile">
                </div>
            </div>
            <div class="col-8">
                <!-- Text container -->
                <div class="text-container">
                    <h2><?= $row1['username']?></h2>
                    <p class="nama-lengkap"><?= $row1['nama_lengkap']?></p>
                    <p class="email"><?= $row1['email']?></p>
                    <p><?= $row1['alamat']?></p>
                </div>
            </div>
        </div>
        <div class="row profile-posts">
        <?php while($rowU = mysqli_fetch_assoc($user)){?>
            <div class="col-4 gambar">
                <a href="gambar.php?gambar=<?= $rowU['fotoid']?>">
                    <img src="album/<?= $rowU['lokasi_file']?>" alt="<?= $rowU['judul_foto']?>">
                </a>
            </div>
            <?php }?>
        </div>
    </div>

    <div class="mt-5 .footer">
        <footer class="text-center text-lg-start" style="background-color: #DC3535;">
            <div class="text-center text-white p-3" style="background-color: #DC3535;">
                Copyright©:
                <a class="text-white" href="">Farrel Corp. 2024</a>
            </div>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script> document.getElementById("gambar").addEventListener("change", function () {
            const file = this.files[0]; // Mendapatkan file yang dipilih oleh pengguna
            if (file) {
                const reader = new FileReader(); // Membuat objek FileReader
                reader.onload = function (e) {
                    document.getElementById("gambar-preview").setAttribute("src", e.target.result); // Menyetel atribut src dari elemen img dengan gambar yang dipilih
                    document.querySelector(".addfoto h2").style.display = "none";
                }
                reader.readAsDataURL(file); // Membaca file sebagai URL data
            }
        });</script>
</body>

</html>