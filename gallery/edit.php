<?php
require('function.php');
if (!isset($_SESSION['username']) && !isset($_SESSION['password']) && !isset($_SESSION['id_user'])) {
    header("location: login.php");
}

if (detail_data_user(trim($_SESSION['id_user']))) {
    $row1 = mysqli_fetch_assoc($result);
}

$gambar = mysqli_fetch_assoc(detail_gambar(trim($_GET['id'])));
$albums = show_album(trim($_SESSION['id_user']));
update_gambar();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <title>MEMORIZE | Edit Gambar</title>
    <style>

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="src/logo1.png" alt="logo memorize" class="logo-img">
            </a>
            <div class="d-sm-flex align-items-center justify-content-center page-title-container edit">
                <h2 class="m-0 pe-5 page-title edit" data-bs-toggle="modal" data-bs-target="#addAlbumModal">Edit Gambar
                </h2>
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

    <div class="container mt-5 mb-4">
        <div class="row">
            <div class="">
                <div class="card p-3">
                    <div class="row no-gutters">
                        <div class="col-md-6">
                            <img src="album/<?= $gambar['lokasi_file'] ?>" class="card-img-top rounded-3" alt="...">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <form method="post">
                                    <input type="hidden" name="id" value="<?= $gambar['fotoid'] ?>">
                                    <!-- <input type="hidden" name="albumid" value="<?php //$gambar['albumid'] ?>"> -->
                                    <label for="judul" class="form-label">Judul Gambar</label>
                                    <input type="text" value="<?= $gambar['judul_foto'] ?>" class="form-control" id="judul" name="judul">

                                    <label for="album" class="form-label" id="alb">Album (*jika ingin*)</label>
                                    <?php if ($albums->num_rows > 0) { ?>
                                        <select name="albumid" class="form-select">
                                            <?php while ($album = $albums->fetch_assoc()) {
                                                $selected = ($album["albumid"] == $gambar['albumid']) ? 'selected' : ''; ?>
                                                <option value="<?= $album['albumid'] ?>" <?= $selected ?>><?= $album['nama_album'] ?></option>
                                        <?php }
                                        } ?>
                                        </select>

                                        <label for="album" class="form-label" id="kat">Kategori</label>
                                        <select id="album" class="form-select" aria-label="kategori gambar" name="kategori" required>
                                            <option value="santai" <?= ($gambar['kategori'] == 'santai') ? 'selected' : '' ?>>Santai</option>
                                            <option value="alam" <?= ($gambar['kategori'] == 'alam') ? 'selected' : '' ?>>Alam</option>
                                            <option value="kuliner" <?= ($gambar['kategori'] == 'kuliner') ? 'selected' : '' ?>>Kuliner</option>
                                            <option value="benda" <?= ($gambar['kategori'] == 'benda') ? 'selected' : '' ?>>Benda</option>
                                            <?= $gambar['kategori'] ?>
                                        </select>

                                        <label for="desk" class="form-label" id="deskripsi">Deskripsi</label>
                                        <textarea type="text" class="form-control" id="desk" rows="5" name="deskripsi"><?= $gambar['deskripsi_foto'] ?></textarea>
                                        <div class="btn-position">
                                            <button type="submit" class="btn btn-danger mb-1 w-100">Simpan Perubahan</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Repeat the above div for more images -->
        </div>
    </div>

    <div class="mt-5 .footer">
        <footer class="text-center text-lg-start" style="background-color: #DC3535;">
            <!-- Copyright -->
            <div class="text-center text-white p-3" style="background-color: #DC3535;">
                Copyright©:
                <a class="text-white" href="">Farrel Corp. 2024</a>
            </div>
            <!-- Copyright -->
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>