<?php
require('function.php');
if (!isset($_SESSION['username']) && !isset($_SESSION['password']) && !isset($_SESSION['id_user'])) {
    header("location: login.php");
}

if (detail_data_user(trim($_SESSION['id_user']))) {
    $row1 = mysqli_fetch_assoc($result);
} else {
    die("Login Terlebih Dahulu");
}

$albums = album_show($_SESSION['id_user']);
create_album();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONTS -->
    <link rel="stylesheet" href="css/album.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- BOOTSRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- FLICKITY(carousel) -->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <title>MEMORIZE | Album Anda</title>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="src/logo1.png" alt="logo memorize" class="logo-img">
            </a>
            <div class="d-sm-flex align-items-center justify-content-center page-title-container">
                <h2 class="m-0 pe-5 page-title">Album Saya</h2>
            </div>
            <div class="dropdown me-2">
                <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="profile/<?php echo $row1['profile'] == "" || $row1['profile'] == null ? "nopict.png" : $row1['profile']; ?>" alt="profil" class="profil-img">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="profileUser.php">Profil</a></li>
                    <li><a class="dropdown-item" href="album.php">Album</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section>
        <div class="btn-flying" data-bs-toggle="modal" data-bs-target="#addAlbumModal">
            <i class=" bi bi-folder-plus"></i>
        </div>
        <!-- FOTO FOTO -->
        <div class="hilang row px-4 gy-4 mt-3">
        <?php
        foreach ($albums as $album) {?>
            <div class="col-lg-3 col-sm-3 col-xl-2 foto-image">
                <a href="gallery.php?album=<?= $album['albumid']?>">
                <div class="foto">
                <?php if(!empty($album['lokasi_file'])){?>
                    <img src="album/<?= $album['lokasi_file']?>" alt="">
                    <?php }?>
                </div>
                <div class="profile d-flex justify-content-center p-2">
                    <p class="ms-1"><?= $album['nama_album']?></p>
                </div>
                </a>
            </div>
        <?php } ?>
            <div class="col-lg-3 col-sm-3 col-xl-2 album-plus">
                <div class="btn-plus" data-bs-toggle="modal" data-bs-target="#addAlbumModal">
                    <i class="bi bi-folder-plus"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="addAlbumModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title mx-auto" id="exampleModalLabel">Tambah Album</h5>
                </div>
                <div class="modal-body">
                    <form id="addAlbumForm" method="post">
                        <input type="hidden" name="id_user" value="<?= $_SESSION['id_user'] ?>">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="albumName" placeholder="Nama Album" name="album" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" id="albumDescription" placeholder="Deskripsi Album" name="deskripsiAlbum" rows="3"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary me-auto" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="submitAlbum">Tambah</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <div class="mt-5 .footer">
        <footer class="text-center text-lg-start" style="background-color: #DC3535;">
            <!-- Copyright -->
            <div class="text-center text-white p-3" style="background-color: #DC3535;">
                Copyright©:
                <a class="text-white" href="https://www.instagram.com/farrel_fff?igsh=bG5qMm91NTZsOXA4">Farrel Corp. 2024</a>
            </div>
            <!-- Copyright -->
        </footer>
    </div>

    <!-- End of .container -->

    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var button = document.querySelector('.btn-flying');
            var footer = document.querySelector('.footer');
            var footerTop = footer.getBoundingClientRect().top;
            var windowHeight = window.innerHeight;

            window.addEventListener('scroll', function() {
                var buttonBottom = button.getBoundingClientRect().bottom;
                var distanceToFooter = footerTop - buttonBottom;

                if (distanceToFooter > windowHeight) {
                    button.style.bottom = '100px'; // Adjust this value accordingly
                } else {
                    button.style.bottom = distanceToFooter + 'px';
                }
            });
        });
    </script>

</body>

</html>