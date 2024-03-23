<?php
require('function.php');
if (!isset($_SESSION['username']) && !isset($_SESSION['password']) && !isset($_SESSION['id_user'])) {
    header("location: login.php");
} else if (!isset($_GET['album'])) {
    header("location: index.php");
}

if (detail_data_user(trim($_SESSION['id_user']))) {
    $row1 = mysqli_fetch_assoc($result);
}

$album = mysqli_fetch_assoc(album_detail($_GET['album']));
$result = gambar_show($_GET['album']);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    action_album();
    header("Location: gallery.php?album=" . $_GET['album'], true, 303);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONTS -->
    <link rel="stylesheet" href="css/galleri.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- BOOTSRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- FLICKITY(carousel) -->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <title>MEMORIZE | Buka Album</title>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="src/logo1.png" alt="logo memorize" class="logo-img">
            </a>
            <div class="d-sm-flex align-items-center justify-content-center page-title-container">
                <h2 class="m-0 pe-5 page-title" data-bs-toggle="modal" data-bs-target="#addAlbumModal"><?= $album['nama_album'] ?> <i class="bi bi-pencil-square"></i></h2>
            </div>
            <div class="dropdown me-2">
                <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="profile/<?php echo $row1['profile'] == "" || $row1['profile'] == null ? "nopict.png" : $row1['profile']; ?>" alt="profil" class="profil-img">
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
        </div>
    </nav>

    <section>
        <div class="btn-flying" data-bs-toggle="modal" data-bs-target="#addFotoModal">
            <i class=" bi bi-plus"></i>
        </div>
        <div class="mx-2 mt-4">
            <h1 class="verdana"><?= $album['nama_album'] ?> Album</h1>
            <h3 class="mt-3 ps-3">Deskripsi</h3>
            <p class="Poppins ps-3"><?= $album['deskripsi'] ?></p>
        </div>
        <!-- FOTO FOTO -->
        <div class="hilang row px-4 gy-4 mt-3">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-lg-3 col-sm-3 col-xl-2 foto-image">
                    <div class="foto">
                        <img src="album/<?= $row['lokasi_file'] ?>" alt="">
                    </div>
                    <div class="profile d-flex p-2 ps-1">
                        <p class="ms-1"><?= $row['judul_foto'] ?></p>
                        <div class="ms-auto">
                            <div class="dropup">
                                <i class="bi bi-three-dots ms-auto dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="edit.php?id=<?= $row['fotoid'] ?>">Edit</a></li>
                                    <li><a class="dropdown-item" href="delete_gambar.php?id=<?= $row['fotoid'] ?>&album=<?= $row['albumid'] ?>">Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-lg-3 col-sm-3 col-xl-2 album-plus">
                <div class="btn-plus" data-bs-toggle="modal" data-bs-target="#addFotoModal">
                    <i class="bi bi-plus"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal EDIT ALBUM-->
    <div class="modal fade" id="addAlbumModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title mx-auto" id="exampleModalLabel">Edit Album</h5>
                </div>
                <div class="modal-body">
                    <form id="addAlbumForm" method="post">
                        <input type="hidden" name="id" value="<?= $album['albumid'] ?>">
                        <input type="hidden" name="nama_album" value="<?= $album['nama_album'] ?>">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="albumName" placeholder="Nama Album" name="album" value="<?= $album['nama_album'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" id="albumDescription" placeholder="Deskripsi Album" name="deskripsi" rows="3"><?= $album['deskripsi'] ?></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger mx-auto" data-bs-dismiss="modal" name="hapus">Hapus Album</button>
                    <button type="submit" class="btn btn-primary" id="submitAlbum" name="edit"> Edit </button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal TAMBAH FOTO-->
    <div class="modal fade" id="addFotoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title mx-auto" id="exampleModalLabel">Tambah Gambar</h5>
                </div>
                <div class="modal-body">
                    <form id="addFotoForm" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="albumid" value="<?= $album['albumid'] ?>">
                        <input type="hidden" name="userid" value="<?= $_SESSION['id_user'] ?>">
                        <input type="hidden" name="nama_album" value="<?= $album['nama_album'] ?>">
                        <div class="mb-3 addfoto">
                            <label for="gambar"><img src="src/add.png" alt="add" id="gambar-preview"></label>
                            <input id="gambar" type="file" accept="image/*" name="gambar" required>
                            <h2>Tambah Gambar</h2>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="albumName" name="judul_gambar" placeholder="Judul Foto" required>
                        </div>
                        <div class="mb-3">
                            <select id="albumKategori" class="form-select" aria-label="kategori gambar" name="kategori" required>
                                <option disabled selected>Pilih Kategori</option>
                                <option value="santai">Santai</option>
                                <option value="alam">Alam</option>
                                <option value="kuliner">Kuliner</option>
                                <option value="benda">Benda</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" id="albumDescription" name="deskripsi" placeholder="Deskripsi Foto" rows="3"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="submitAlbum" name="tambah"> Tambah </button>
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
        document.getElementById("gambar").addEventListener("change", function() {
            const file = this.files[0]; // Mendapatkan file yang dipilih oleh pengguna
            if (file) {
                const reader = new FileReader(); // Membuat objek FileReader
                reader.onload = function(e) {
                    document.getElementById("gambar-preview").setAttribute("src", e.target.result); // Menyetel atribut src dari elemen img dengan gambar yang dipilih
                    document.querySelector(".addfoto h2").style.display = "none";
                }
                reader.readAsDataURL(file); // Membaca file sebagai URL data
            }
        });


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