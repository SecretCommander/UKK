<!DOCTYPE html>
<html lang="en">
<?php
require('function.php');
if (isset($_SESSION['id_user']) && detail_data_user(trim($_SESSION['id_user']))) {
    $row1 = mysqli_fetch_assoc($result);
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONTS -->
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <!-- BOOTSRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- FLICKITY(carousel) -->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <title>Masuk Memorize</title>
    <title>MEMORIZE</title>
</head>

<body>
    <!-- NAVBAR -->
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

    <section>
        <div class="carousel mt-3" data-flickity='{"autoPlay": true}'>
            <div class="carousel-cell" style="background-image: url(src/1.jpg)"></div>
            <div class="carousel-cell" style="background-image: url(src/2.jpg)"></div>
            <div class="carousel-cell" style="background-image: url(src/3.jpg)"></div>
        </div>
        <h1 class="text-center mt-5 mb-2 ">Kategori</h1>
        <div class="row justify-content-center p-4 g-3 template ">
            <div class="col-lg-3 col-sm-6 d-flex justify-content-center">
                <div class="link-kategori">
                    <a href="kategori.php?kat=santai">
                        <img src="src/santai.jpg" alt="kategori santai" class="kategori">
                        <p>Santai</p>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 d-flex justify-content-center">
                <div class="link-kategori">
                    <a href="kategori.php?kat=alam">
                        <img src="src/alam.png" alt="kategori alam" class="kategori">
                        <p>Alam</p>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 d-flex justify-content-center">
                <div class="link-kategori">
                    <a href="kategori.php?kat=kuliner">
                        <img src="src/kuliner.png" alt="kategori kuliner" class="kategori">
                        <p>Kuliner</p>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 d-flex justify-content-center">
                <div class="link-kategori">
                    <a href="kategori.php?kat=benda">
                        <img src="src/benda.png" alt="kategori benda" class="kategori">
                        <p>Benda</p>
                    </a>
                </div>
            </div>
        </div>
        <!-- FOTO FOTO -->
        <h2 class="text-center mb-4">Gambar</h2>
        <div class="row px-4 gy-4">

            <?php
            $gambar_result = gambar_index();
            while ($gambar = mysqli_fetch_assoc($gambar_result)) { ?>
                <div class="col-lg-3 col-sm-3 col-xl-2 foto-image">
                    <div class="foto">
                        <a href="gambar.php?gambar=<?= $gambar['fotoid'] ?>">
                            <img src="album/<?= $gambar['lokasi_file'] ?>" alt="<?= $gambar['judul_foto'] ?>">
                        </a>
                    </div>
                    <div class="profile mt-2 d-flex align-items-center">
                        <a href="profil.php?user=<?= $gambar['userid'] ?>">
                            <img src="profile/<?php echo $gambar['profile'] == "" || $gambar['profile'] == null ? "nopict.png" : $gambar['profile']; ?>" alt="profile <?= $gambar['username'] ?>" alt="">
                        </a>
                        <span class="ms-1"><?= $gambar['username'] ?></span>
                        <span class="ms-auto"> <?php if (isset($_SESSION['id_user'])) : ?>
                                <?php if (check_like($_SESSION['id_user'], $gambar['fotoid'])) : ?>
                                    <span class="bi bi-balloon-heart-fill heart-icon" data-gambar-id="<?= $gambar['fotoid'] ?>"></span>
                                <?php else : ?>
                                    <span class="bi bi-balloon-heart heart-icon" data-gambar-id="<?= $gambar['fotoid'] ?>"></span>
                                <?php endif; ?>
                            <?php else : ?>
                                <span class="bi bi-balloon-heart heart-icon" data-gambar-id="<?= $gambar['fotoid'] ?>"></span>
                            <?php endif; ?>
                            <span class="mb-5" id="like-count<?= $gambar['fotoid'] ?>"><?= like_count($gambar['fotoid']) ?></span>
                        </span>
                    </div>
                </div>
            <?php } ?>

        </div>
    </section>
    <div class="mt-5">
        <footer class="text-center text-lg-start" style="background-color: #DC3535;">
            <div class="hilang row px-1">
                <!-- Logo -->
                <div class="col-lg-2 col-md-6 col-sm-6 order-md-last order-sm-last order-lg-first ">
                    <img src="src/memorize.png" alt="logo memorize" class="img-fluid image-resize">
                </div>
                <!-- Main Content -->
                <div class="col-lg-7 col-md-12 text-center my-auto bp border-start  border-end border-dark ">
                    <div class="d-flex flex-column align-items-center test">
                    <?php if (empty($_SESSION['id_user'])){ ?>
                        <a href="daftar.php" class="link-underline-light">
                            <h5 class="text-white mb-3">Ayo Bergabung!</h5>
                        </a>
                        <?php } ?>
                        <h3 class="text-white <?php echo empty($_SESSION['id_user']) ? 'mb-4' : 'mb-1'; ?>">Berbagi Gambar / Memori Kepada Dunia</h3>
                    </div>
                </div>
                <!-- Social Media Buttons -->
                <div class="col-lg-3 text-center my-auto col-md-6 col-sm-6 order-md-last order-sm-last ">
                    <h3 class="text-white my-2">Ikuti Kami!</h3>
                    <div class="d-flex justify-content-center align-items-center py-3">
                        <a href="https://www.facebook.com/farrel.awaly">
                            <button type="button" class="btn sosmed btn-lg btn-floating mx-2" style="background-color: #A94438;">
                                <i class="bi bi-facebook"></i>
                            </button>
                        </a>
                        <a href="https://www.instagram.com/farrel_fff?igsh=bG5qMm91NTZsOXA4">
                            <button type="button" class="btn sosmed btn-lg btn-floating mx-2" style="background-color: #A94438;">
                                <i class="bi bi-instagram"></i>
                            </button>
                        </a>
                        <a href="https://twitter.com/SecretManThing">
                            <button type="button" class="btn sosmed btn-lg btn-floating mx-2" style="background-color: #A94438;">
                                <i class="bi bi-twitter"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Copyright -->
            <div class="text-center text-white p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                Copyright©:
                <a class="text-white" href="https://www.instagram.com/farrel_fff?igsh=bG5qMm91NTZsOXA4">Farrel Corp. 2024</a>
            </div>
            <!-- Copyright -->
        </footer>
    </div>

    <!-- End of .container -->

    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script>
        var isUserLoggedIn = <?= isset($_SESSION['id_user']) ? 'true' : 'false' ?>;
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