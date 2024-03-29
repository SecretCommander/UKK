<?php
require('function.php');

if (isset($_SESSION['id_user']) && detail_data_user(trim($_SESSION['id_user']))) {
    $row1 = mysqli_fetch_assoc($result);
    tambah_komen();
}

$gambar = mysqli_fetch_assoc(detail_gambar_viewer(trim($_GET['gambar'])));
$ada = mysqli_num_rows(komentar_show(trim($_GET['gambar']), 0));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- FONTS -->
    <link rel="stylesheet" href="css/gambar.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- BOOTSRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- FLICKITY(carousel) -->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <title>MEMORIZE | Gambar</title>
    <style>

    </style>
</head>

<body>
    <nav class="navbar navigasi navbar-expand-lg">
        <div class="container-fluid d-flex flex-nowrap">
            <a class="navbar-brand" href="index.php"><img src="src/logo1.png" alt="logo memorize"></a>
            <div class="d-flex justify-content-center align-items-center flex-grow-1 atas">
                <form class="d-flex ukur" role="search" method="POST" action="search.php">
                    <input class="form-control mr-2 cari" type="search" placeholder="Cari Gambar" aria-label="Search" id="search" name="search">
                    <button class="btn submit" type="submit"><i class="bi bi-search fw-bold ikon "></i></button>
                </form>
            </div>
            <?php
            if (empty($_SESSION['id_user'])) { ?>
                <div class="atas pas">
                    <a href="login.php" class="btn linkan masuk">Masuk</a>
                    <a href="daftar.php" class="btn linkan daftar">Daftar</a>
                </div>
            <?php } else { ?>
                <div class="dropdown me-2 atas pas">
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
            <?php } ?>
        </div>
    </nav>

    <div class="container mt-5 mb-4">
        <div class="row">
            <div class="">
                <div class="card p-3">
                    <div class="row no-gutters">
                        <div class="col-md-6">
                            <img src="album/<?= $gambar['lokasi_file'] ?>" class="card-img-top rounded-3" alt="<?= $gambar['judul_foto'] ?>">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <form action="" method="post" id="commentForm">
                                    <div class="d-flex justify-content-between align-items-baseline">
                                        <h3 class="mb-2 mt-1"><?= $gambar['judul_foto'] ?></h3>
                                        <span>
                                            <?php if (isset($_SESSION['id_user'])) : ?>
                                                <?php if (check_like($_SESSION['id_user'], $gambar['fotoid'])) : ?>
                                                    <span style="font-size: 1.5rem;" class="bi bi-balloon-heart-fill heart-icon" data-gambar-id="<?= $gambar['fotoid'] ?>"></span>
                                                <?php else : ?>
                                                    <span style="font-size: 1.5rem;" class="bi bi-balloon-heart heart-icon" data-gambar-id="<?= $gambar['fotoid'] ?>"></span>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <span style="font-size: 1.5rem;" class="bi bi-balloon-heart heart-icon" data-gambar-id="<?= $gambar['fotoid'] ?>"></span>
                                            <?php endif; ?>
                                            <span style="font-size: 1.3rem;" class="mb-5" id="like-count<?= $gambar['fotoid'] ?>"><?= like_count($gambar['fotoid']) ?></span>
                                        </span>
                                    </div>
                                    <!-- <p><span> //date('d-m-Y', strtotime($gambar['tanggal_unggah']))</span><span>, //ucfirst($gambar['kategori']) </span></p> -->
                                    <p class="pt-1"><?= $gambar['deskripsi_foto'] ?></p>
                                    <h6 class="author">Author: <span><?= $gambar['username'] ?></span></h6>

                                    <div class="d-flex align-items-center mt-3">
                                        <h4>Komentar</h4>
                                        <i class="bi bi-caret-down-fill ms-auto toggle-icon" data-bs-toggle="collapse" data-bs-target="#comments" aria-expanded="false" aria-controls="comments"></i>
                                    </div>
                                    <div class="collapse comment-section" id="comments">
                                        <div class="komments">
                                            <?php
                                            if ($ada <= 0) { ?>
                                                <p> Belum ada komentar.</p>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if (isset($_SESSION['id_user']) && $_SESSION['id_user'] != '') {
                                                $komentar = komentar_show_user(trim($_GET['gambar']), $_SESSION['id_user']);

                                                while ($komenU = mysqli_fetch_assoc($komentar)) { ?>
                                                    <p class="user-comment my-2">
                                                        <span><span class="fw-bold"><?= $komenU['username'] ?></span><span class="fw-normal"> <?= $komenU['isi_komentar'] ?></span></span>
                                                        <a href="delete_komen.php?id=<?= $komenU['komentarid'] ?>&gambar=<?= trim($_GET['gambar']) ?>" style="color:black"><i class="me-2 bi bi-trash3"></i></a>
                                                        <!-- <p>//date('d-m-Y', strtotime($komenU['tanggal_komentar'])) ></p> -->
                                                    </p>
                                            <?php }
                                            } ?>

                                            <?php
                                            if (isset($_SESSION['id_user'])) {
                                                $komentar = komentar_show(trim($_GET['gambar']), $_SESSION['id_user']);
                                            } else {
                                                $komentar = komentar_show(trim($_GET['gambar']), 0);
                                            }

                                            while ($komen = mysqli_fetch_assoc($komentar)) { ?>
                                                <p class="user-comment my-2"><span><span class="fw-bold"><?= $komen['username'] ?></span><span class="fw-normal"> <?= $komen['isi_komentar'] ?></span></span></p><?php } ?>
                                        </div>
                                    </div>
                                    <div class="btn-position">
                                        <input type="hidden" name="gambarid" value="<?= trim($_GET['gambar']) ?>">
                                        <input type="hidden" name="userid" value="<?= isset($_SESSION['id_user']) ? trim($_SESSION['id_user']) : '' ?>">
                                        <input type="text" class="mb-1 w-100 me-1 komen" placeholder="Komentar" name="komentar">
                                        <button type="button" class="btn btn-danger mb-1" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-link-45deg" id="custom-icon"></i></button>
                                        <div class="dropup">
                                            <ul class="dropdown-menu">
                                                <li><button type="button" class="dropdown-item" onclick="shareToFacebook()" id="FB">Facebook</button></li>
                                                <li><button type="button" class="dropdown-item" onclick="shareToWhatsApp()" id="WA">Whatsapp</button></li>
                                                <li><button type="button" class="dropdown-item" onclick="copyUrlToClipboard()" id="LI">Salin link</button></li>
                                            </ul>
                                        </div>
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
    <h2 class="text-center mb-4">Gambar Lainnya</h2>
    <div class="hilang row px-4 gy-4">
        <?php
        $lainnya_result = lainnya($gambar['kategori'], trim($_GET['gambar']));
        while ($lainnya = mysqli_fetch_assoc($lainnya_result)) { ?>
            <div class="col-lg-3 col-sm-3 col-xl-2 foto-image">
                <div class="foto">
                    <a href="gambar.php?gambar=<?= $lainnya['fotoid'] ?>">
                        <img src="album/<?= $lainnya['lokasi_file'] ?>" alt="<?= $lainnya['judul_foto'] ?>">
                    </a>
                </div>
                <div class="profile mt-2 d-flex align-items-center">
                    <a href="profil.php?user=<?= $lainnya['userid'] ?>">
                        <img src="profile/<?php echo $lainnya['profile'] == "" || $lainnya['profile'] == null ? "nopict.png" : $lainnya['profile']; ?>" alt="profile <?= $lainnya['username'] ?>">
                    </a>
                    <span class="ms-1"><?= $lainnya['username'] ?></span>
                    <span class="ms-auto"> <?php if (isset($_SESSION['id_user'])) : ?>
                            <?php if (check_like($_SESSION['id_user'], $lainnya['fotoid'])) : ?>
                                <span class="bi bi-balloon-heart-fill heart-icon" data-gambar-id="<?= $lainnya['fotoid'] ?>"></span>
                            <?php else : ?>
                                <span class="bi bi-balloon-heart heart-icon" data-gambar-id="<?= $lainnya['fotoid'] ?>"></span>
                            <?php endif; ?>
                        <?php else : ?>
                            <span class="bi bi-balloon-heart heart-icon" data-gambar-id="<?= $lainnya['fotoid'] ?>"></span>
                        <?php endif; ?>
                        <span class="mb-5" id="like-count<?= $lainnya['fotoid'] ?>"><?= like_count($lainnya['fotoid']) ?></span>
                    </span>
                    </span>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="mt-5">
        <footer class="text-center text-lg-start" style="background-color: #DC3535;">
            <!-- <div class="hilang row px-1"> -->
            <!-- Logo -->
            <!-- <div class="col-lg-2 col-md-6 col-sm-6 order-md-last order-sm-last order-lg-first ">
                    <img src="src/memorize.png" alt="logo memorize" class="img-fluid image-resize">
                </div> -->
            <!-- Main Content -->
            <!-- <div class="col-lg-7 col-md-12 text-center my-auto bp border-start  border-end border-dark ">
                    <div class="d-flex flex-column align-items-center test">
                        <a href="" class="link-underline-light"><h5 class="text-white mb-3">Ayo Bergabung!</h5></a>
                        <h3 class="text-white mb-4">Berbagi Gambar / Memori Kepada Dunia</h3>
                    </div>
                </div> -->
            <!-- Social Media Buttons -->
            <!-- <div class="col-lg-3 text-center my-auto col-md-6 col-sm-6 order-md-last order-sm-last ">
                    <h3 class="text-white my-2">Ikuti Kami!</h3>
                    <div class="d-flex justify-content-center align-items-center py-3">
                        <button type="button" class="btn sosmed btn-lg btn-floating mx-2"
                            style="background-color: #A94438;">
                            <i class="bi bi-facebook"></i>
                        </button>
                        <button type="button" class="btn sosmed btn-lg btn-floating mx-2"
                            style="background-color: #A94438;">
                            <i class="bi bi-instagram"></i>
                        </button>
                        <button type="button" class="btn sosmed btn-lg btn-floating mx-2"
                            style="background-color: #A94438;">
                            <i class="bi bi-twitter"></i>
                        </button>
                    </div>
                </div>
            </div> -->
            <!-- Copyright -->
            <div class="text-center text-white p-3" style="background-color: #DC3535;">
                <!-- rgba(0, 0, 0, 0.2); -->
                Copyright©:
                <a class="text-white" href="https://www.instagram.com/farrel_fff?igsh=bG5qMm91NTZsOXA4">Farrel Corp. 2024</a>
            </div>
            <!-- Copyright -->
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- KOMEN buka tutup -->
    <script>
        $(document).ready(function() {
            $('#comments').on('show.bs.collapse', function() {
                $('.toggle-icon').removeClass('bi-caret-down-fill').addClass('bi-caret-up-fill');
            })
            $('#comments').on('hide.bs.collapse', function() {
                $('.toggle-icon').removeClass('bi-caret-up-fill').addClass('bi-caret-down-fill');
            })
        });
    </script>

    <!-- Copy URL function -->
    <script>
        function shareToWhatsApp() {
            var message = encodeURIComponent(window.location.href);
            var url = 'https://wa.me/?text=' + message;
            window.open(url, '_blank');
        }

        function shareToFacebook() {
            var url = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(window.location.href);
            window.open(url, '_blank');
        }

        function copyUrlToClipboard() {
            navigator.clipboard.writeText(window.location.href);
            alert("Link telah disalin!");
        }
    </script>

    <!-- Login dulu sebelum komentar -->
    <script>
        var isUserLoggedIn = <?= isset($_SESSION['id_user']) ? 'true' : 'false' ?>;
        document.getElementById('commentForm').addEventListener('submit', function(event) {
            if (!isUserLoggedIn) {
                alert('Silakan login terlebih dahulu untuk memberikan komentar.');
                event.preventDefault();
            }
        });

        // Ubah warna + transisi like
        document.addEventListener('DOMContentLoaded', function() {
            var heartIcons = document.querySelectorAll('.heart-icon');

            heartIcons.forEach(function(icon) {
                icon.addEventListener('click', function() {
                    if (!isUserLoggedIn) {
                        alert('Silakan login terlebih dahulu untuk memberikan like.');
                        event.preventDefault();
                        return;
                    }
                    // Toggle heart icon classes
                    this.classList.toggle('bi-balloon-heart');
                    this.classList.toggle('bi-balloon-heart-fill');

                    // Toggle heart color
                    if (this.classList.contains('bi-balloon-heart-fill')) {
                        this.style.color = 'red';
                        updateLikeCount(this, 1);
                    } else {
                        this.style.color = '';
                        updateLikeCount(this, -1);
                    }

                    // Disable the button to prevent multiple clicks
                    this.disabled = true;

                    var gambarId = this.getAttribute('data-gambar-id');
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'like_gambar.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                console.log('Like action successful');
                                // var likeCountElement = document.getElementById('like-count' + gambarId);
                                // likeCountElement.textContent = xhr.responseText;
                                // console.log(xhr.responseText);
                            } else {
                                console.error('Error:', xhr.status);
                            }

                            setTimeout(function() {
                                icon.disabled = false;
                            }, 1500); // Adjust the delay as needed (1000 milliseconds = 1 second)
                        }
                    };
                    xhr.send('gambar_id=' + encodeURIComponent(gambarId));
                });
            });
        });

        function updateLikeCount(icon, increment) {
            var gambarId = icon.getAttribute('data-gambar-id');
            var likeCountElement = document.getElementById('like-count' + gambarId);
            var currentLikeCount = parseInt(likeCountElement.textContent);

            var newLikeCount = currentLikeCount + increment;
            newLikeCount = Math.max(0, newLikeCount);
            likeCountElement.textContent = newLikeCount;
        }
    </script>
</body>

</html>