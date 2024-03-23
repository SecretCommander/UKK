<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "galeri";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!-- User CRUDL -->
<?php
// Registrasi Fungsi
function register($conn, $username, $namaL, $password, $email, $alamat)
{
    $sql = "INSERT INTO user (username, nama_lengkap, password, email, alamat) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $namaL, $password, $email, $alamat);

    try {
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) { // MySQL error kode untuk duplikat
            return 'duplikat';
        } else {
            return false;
        }
    }
}

function regist()
{
    global $conn;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username   = mysqli_real_escape_string($conn, $_POST['username']);
        $nama       = mysqli_real_escape_string($conn, $_POST['namaAnda']);
        $password   = mysqli_real_escape_string($conn, $_POST['password']);
        $email      = mysqli_real_escape_string($conn, $_POST['email']);
        $alamat     = mysqli_real_escape_string($conn, $_POST['alamat']);

        $result = register($conn, $username, $nama, $password, $email, $alamat);
        if ($result === true) {
            echo "<script>alert('Registrasi berhasil'); window.location.href='login.php';</script>";
        } elseif ($result === 'duplikat') {
            echo "<script>alert('Registrasi gagal, Username sudah ada');</script>";
        } else {
            echo "<script>alert('Registrasi gagal');</script>";
        }
    }
}


// Login Fungsi
function login($conn, $username, $password)
{
    $sql = "SELECT userid FROM user WHERE username=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['id_user'] = $row['userid'];
        return true;
    } else {
        return false;
    }
}

function user_data()
{
    global $conn;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $remember = isset($_POST['check']);

        if (login($conn, $username, $password)) {
            if ($remember) {
                setcookie('username', $username, time() + (86400 * 30), "/"); // 86400 = 1 day
                setcookie('password', $password, time() + (86400 * 30), "/"); // 86400 = 1 day
            }

            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Username atau Password Salah');</script>";
            // echo '<div class="alert alert-danger position-absolute top-0 start-50 translate-middle mt-4 z-3">Username atau Password Salah</div>';
        }
    }
}

// Detail User
function detail_data_user($userid)
{
    global $conn;
    global $result;
    $sql = "SELECT * FROM user WHERE userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) {
        return true;
    } else {
        return false;
    }
}

// Update User
function update_user()
{
    global $conn;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = trim($_POST['id_user']);
        $username       = mysqli_real_escape_string($conn, $_POST['username']);
        $nama_lengkap   = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
        $email          = mysqli_real_escape_string($conn, $_POST['email']);
        $alamat         = mysqli_real_escape_string($conn, $_POST['alamat']);

        $queryShow = "SELECT * FROM user WHERE userid = ?";
        $stmtShow = $conn->prepare($queryShow);
        $stmtShow->bind_param("i", $id);
        $stmtShow->execute();
        $result = $stmtShow->get_result()->fetch_assoc();


        if ($_FILES["profile"]["name"] != "") {
            $split = explode('.', $_FILES['profile']['name']);
            $ext = end($split);

            $filepath = "profile/" . $result['profile'];
            $foto = uniqid() . "." . $ext;
            if (file_exists($filepath) && $filepath != "profile/") {
                unlink($filepath);
            }
            move_uploaded_file($_FILES["profile"]["tmp_name"], "profile/" . $foto);
        } else {
            $foto = $result["profile"];
        }

        $sql = "UPDATE user SET username=?, profile=?, nama_lengkap=?, email=?, alamat=? WHERE userid=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $username, $foto, $nama_lengkap, $email, $alamat, $id);

        try {
            $stmt->execute();
            echo "<script>alert('Profile sudah teredit');window.location='profileUser.php';</script>";
        } catch (mysqli_sql_exception $e) {
            echo "<script>alert('Update Failed: " . $e->getMessage() . "');</script>";
        }
    }
}
?>



<!-- Album CRUD -->
<?php
function show_album($userid){
    global $conn;
    $sql = "SELECT albumid, nama_album FROM album where userid=$userid";
    $result = $conn->query($sql);
    return $result;
}
// Buat Album
function create_album()
{
    global $conn;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_user   = mysqli_real_escape_string($conn, $_POST['id_user']);
        $nama       = mysqli_real_escape_string($conn, $_POST['album']);
        $deskripsi   = htmlspecialchars($_POST['deskripsiAlbum']);

        $base_path = "album/" . $id_user . "/";

        if (!file_exists($base_path)) {
            mkdir($base_path);
        }

        $album_path = $base_path . $nama;

        if (!file_exists($album_path)) {
            if (mkdir($album_path)) {
                $sql = "INSERT INTO album (nama_album, deskripsi, userid) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssi", $nama, $deskripsi, $id_user);

                if ($stmt->execute()) {
                    echo "<script>alert('Album ditambahkan'); window.location.href='album.php';</script>";
                } else {
                    echo "<script>alert('Album gagal ditambah'); window.location.href='album.php';</script>";
                }
                $stmt->close();
            } else {
                echo "<script>alert('Gagal membuat album.'); window.location.href='album.php';</script>";
            }
        } else {
            echo "<script>alert('Album sudah ada.'); window.location.href='album.php';</script>";
        }
    }
}

// Tampil Album serta previewnya
function album_show($userId)
{
    global $conn;
    $sql = "SELECT album.*, foto.lokasi_file FROM album LEFT JOIN foto ON album.albumid = foto.albumid WHERE album.userid = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $albums = array();

    while ($row = $result->fetch_assoc()) {
        if (!isset($albums[$row['albumid']])) {
            $albums[$row['albumid']] = $row;
        }
    }

    // Tutup statement
    $stmt->close();

    // Kembalikan array hasil
    return $albums;
}

// Edit album
function edit_album()
{
    global $conn;
    $id                 = mysqli_real_escape_string($conn, trim($_POST['id']));
    $album              = mysqli_real_escape_string($conn, $_POST['nama_album']);
    $nama_album         = htmlspecialchars($_POST['album']);
    $deskripsi          = htmlspecialchars($_POST['deskripsi']);

    $lokasiFiles = array();
    $sql = "SELECT lokasi_file FROM foto WHERE albumid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $lokasiFiles[] = $row['lokasi_file'];
    }

    $sql = "UPDATE album set nama_album = ? , deskripsi = ? WHERE albumid = ? ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nama_album, $deskripsi, $id);

    $oldDirName = 'album/' . trim($_SESSION['id_user']) . "/" . $album;
    $newDirName = 'album/' . trim($_SESSION['id_user']) . "/" . $nama_album;
    if (file_exists($oldDirName)) {
        if (rename($oldDirName, $newDirName)) {
            try {
                if ($stmt->execute()) {
                    foreach ($lokasiFiles as $lokasiFile) {
                        $basename = basename($lokasiFile);
                        $newLokasiFile = trim($_SESSION['id_user']) . "/" . $nama_album . "/" . $basename;
                        $updateSql = "UPDATE foto SET lokasi_file = ? WHERE lokasi_file = ?";
                        $updateStmt = $conn->prepare($updateSql);
                        $updateStmt->bind_param("ss", $newLokasiFile, $lokasiFile);
                        $updateStmt->execute();
                    }
                    echo "<script>alert('Album berhasil diedit!')</script>";
                } else {
                    throw new Exception("Edit Gagal");
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "<script>alert('Gagal mengubah nama album')</script>";
        }
    } else {
        echo "<script>alert('Direktori album lama tidak ditemukan')</script>";
    }
}

function hapus_dir_berulang($dir)
{
    $files = array_diff(scandir($dir), array('.', '..'));
    foreach ($files as $file) {
        $path = "$dir/$file";
        is_dir($path) ? hapus_dir_berulang($path) : unlink($path);
    }
    return rmdir($dir);
}


// Hapus Album
function hapus_album()
{
    global $conn;
    $id = mysqli_real_escape_string($conn, trim($_POST['id']));
    $nama_album = mysqli_real_escape_string($conn, trim($_POST['nama_album']));

    //Hapus komentar dan like yang berkaitan dengan foto
    $delete_comments_sql = "DELETE FROM komentar WHERE fotoid IN (SELECT fotoid FROM foto WHERE albumid = ?)";
    $stmt_comments = $conn->prepare($delete_comments_sql);
    $stmt_comments->bind_param("i", $id);
    $stmt_comments->execute();
    $stmt_comments->close();

    $delete_likes_sql = "DELETE FROM likefoto WHERE fotoid IN (SELECT fotoid FROM foto WHERE albumid = ?)";
    $stmt_likes = $conn->prepare($delete_likes_sql);
    $stmt_likes->bind_param("i", $id);
    $stmt_likes->execute();
    $stmt_likes->close();

    // Hapus foto yang berkaitan
    $delete_photos_sql = "DELETE FROM foto WHERE albumid = ?";
    $stmt = $conn->prepare($delete_photos_sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // Hapus album
    $sql = "DELETE FROM album WHERE albumid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    $base_path = "album/" . $_SESSION['id_user'] . "/";
    $album_path = $base_path . $nama_album;

    if (file_exists($album_path)) {
        hapus_dir_berulang($album_path);
    }

    try {
        if ($stmt->execute()) {
            header("Location: album.php");
            exit();
        } else {
            throw new Exception("Hapus Gagal");
        }
    } catch (Exception $e) {
        header("Location: error.php?message=" . urlencode($e->getMessage()));
        exit();
    }
}

// Menentukan aksi
function action_album()
{
    if (isset($_POST['edit'])) {
        edit_album();
    } else if (isset($_POST['hapus'])) {
        hapus_album();
    } else if (isset($_POST['tambah'])) {
        tambah_gambar();
    } else {
        echo "<script>alert('Gagal melakukan aksi');";
    }
}

// Tampil Album Detail
function album_detail($albumId)
{
    global $conn;
    $sql = "SELECT * FROM album WHERE albumid = ? ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $albumId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}
?>
<!-- Gambar -->
<?php
// Memunculkan Gambar
function gambar_show($albumId)
{
    global $conn;
    $sql = "SELECT * FROM foto WHERE albumid = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $albumId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

//Gambar Lainnya
function lainnya($kategori, $gambarId)
{
    global $conn;
    $sql = "SELECT foto.fotoid, foto.judul_foto, foto.lokasi_file, user.userid, user.username, user.profile
    FROM foto
    INNER JOIN user ON foto.userid = user.userid
    WHERE foto.kategori = ? AND foto.fotoid != ? ORDER BY RAND()";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $kategori, $gambarId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function gambar_index()
{
    global $conn;
    $sql = "SELECT foto.fotoid, foto.judul_foto, foto.lokasi_file, user.userid, user.username, user.profile
    FROM foto
    INNER JOIN user ON foto.userid = user.userid ORDER BY RAND()";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

//Search
function search($keyword)
{
    global $conn;
    $sql = "SELECT foto.fotoid, foto.judul_foto, foto.lokasi_file, user.userid, user.username, user.profile
    FROM foto
    INNER JOIN user ON foto.userid = user.userid 
    WHERE foto.judul_foto LIKE ? OR user.username LIKE ?
    ORDER BY RAND()";

    $keyword = "%" . $keyword . "%";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $keyword, $keyword);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

//kategori
function kategori($kategori)
{
    global $conn;
    $sql = "SELECT foto.fotoid, foto.judul_foto, foto.lokasi_file, user.userid, user.username, user.profile
            FROM foto
            INNER JOIN user ON foto.userid = user.userid 
            WHERE foto.kategori = ?
            ORDER BY RAND()";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $kategori);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}
function upload($gambar, $album, $userid)
{
    if (isset($gambar['name'])) {
        $error = $gambar['error'];
        $split = explode('.', $gambar['name']);
        $ext = $split[count($split) - 1];

        $foto = uniqid() . "." . $ext;
        if ($error === 4) {
            echo "<script>
                alert('pilih gambar terlebih dahulu');
                </script>";
            return false;
        }

        $dir     = "album/" . $userid . "/" . $album . "/";
        $tmpfile = $gambar['tmp_name'];
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true); // Create directory recursively
        }

        if (move_uploaded_file($tmpfile, $dir . $foto)) {
            return $foto;
        } else {
            echo "Failed to move uploaded file.";
            return false;
        }
    } else {
        return null;
    }
}

//Muncul semua gambar user
function all_gambar($userid)
{
    global $conn;
    $sql = "SELECT * FROM foto WHERE userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}


// Fungsi Tambah Gambar
function tambah_gambar()
{
    global $conn;
    $albumid    = mysqli_real_escape_string($conn, trim($_POST['albumid']));
    $album      = mysqli_real_escape_string($conn, $_POST['nama_album']);
    $userid     = mysqli_real_escape_string($conn, trim($_POST['userid']));
    $judul_foto = mysqli_real_escape_string($conn, $_POST['judul_gambar']);
    $deskripsi  = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $kategori   = mysqli_real_escape_string($conn, $_POST['kategori']);


    $gambarnya  = upload($_FILES['gambar'], $album, $userid);
    $album_path = $userid . "/" . $album . "/" . $gambarnya;

    $stmt = $conn->prepare("INSERT INTO foto (judul_foto, deskripsi_foto, lokasi_file, kategori, albumid, userid) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssii", $judul_foto,  $deskripsi, $album_path, $kategori, $albumid, $userid);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: gallery.php?album=" . $albumid);
    } else {
        $stmt->close();
        echo "Error: " . $stmt->error;
    }
}

// fungsi Detail gambar
function detail_gambar($gambarid)
{
    global $conn;
    $sql = "SELECT * FROM foto WHERE fotoid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $gambarid);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}

// fungsi Detail gambar INNER JOIN
function detail_gambar_viewer($gambarid)
{
    global $conn;
    $sql = "SELECT foto.*, user.username FROM foto INNER JOIN user ON foto.userid = user.userid WHERE fotoid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $gambarid);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}

//Fungsi update gambar
function moveFileToAlbum($file, $destinasi, $lokasidb) {
    if (file_exists($file)) {
        if (!is_dir($destinasi)) {
            mkdir($destinasi, 0755, true); 
        }
        $filename = basename($file);
        $newFilePath = $destinasi. '/' .$filename;
        $lokasi = $lokasidb. '/' .$filename;
        if (rename($file, $newFilePath)) {
            return $lokasi; 
        } else {
            return false;
        }
    } else {
        return false; 
    }
}
function update_gambar()
{
    global $conn;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id     = trim($_POST['id']);
        $album  = trim($_POST['albumid']);
        $judul       = mysqli_real_escape_string($conn, $_POST['judul']);
        $deskripsi   = mysqli_real_escape_string($conn, $_POST['deskripsi']);
        $kategori    = mysqli_real_escape_string($conn, $_POST['kategori']);
        
        // kalo kategori bisa pilih
        $sql = "SELECT lokasi_file FROM foto WHERE fotoid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $edit_album = mysqli_query($conn, "SELECT nama_album FROM album WHERE albumid = $album");
        $hasil = mysqli_fetch_assoc($edit_album);

        

        $newDirectory = 'album/'.trim($_SESSION['id_user']).'/'.$hasil['nama_album']; 
        $lokasidb = trim($_SESSION['id_user']).'/'.$hasil['nama_album'];
        $filePath = 'album/'.$row['lokasi_file']; // Ganti dengan ekstensi file yang sesuai (contoh: .jpg)
    
        // Memindahkan file ke direktori baru
        $lokasi = moveFileToAlbum($filePath, $newDirectory, $lokasidb);


            //edit gambarnya
        // $queryShow = "SELECT * FROM foto WHERE foto = ?";
        // $stmtShow = $conn->prepare($queryShow);
        // $stmtShow->bind_param("i", $id);
        // $stmtShow->execute();
        // $result = $stmtShow->get_result()->fetch_assoc();


        // if ($_FILES["gambar"]["name"] != "") {
        //     $split = explode('.', $_FILES['gambar']['name']);
        //     $ext = end($split);

        //     $filepath = "album/" . $result['lokasi_file'];
        //     $foto = uniqid() . "." . $ext;
        //     if (file_exists($filepath) && $filepath != "album/") {
        //         unlink($filepath);
        //     }
        //     move_uploaded_file($_FILES["gambar"]["tmp_name"], "gambar/" . $foto);
        // } else {
        //     $foto = $result['lokasi_file'];
        // }

        // SOURCE : $lokasi , $album,  lokasi_file=?, albumid=?
        $sql = "UPDATE foto SET judul_foto=?, deskripsi_foto=?, kategori=?, lokasi_file=?, albumid=? WHERE fotoid=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssii", $judul, $deskripsi, $kategori,$lokasi, $album, $id);

        try {
            $stmt->execute();
            echo "<script>alert('Perubahan disimpan');window.location='gallery.php?album=" . $album . "';</script>";
        } catch (mysqli_sql_exception $e) {
            echo "<script>alert('Gagal ubah: " . $e->getMessage() . "');</script>";
        }
    }
}

//Fungsi Hapus Gambar
function delete_gambar()
{
    $idg = $_GET["id"];
    global $conn;

    $stmt_delete_komentar = $conn->prepare("DELETE FROM komentar WHERE fotoid = ?");
    $stmt_delete_komentar->bind_param("i", $idg);
    $stmt_delete_komentar->execute();
    $stmt_delete_komentar->close();

    $stmt_delete_like = $conn->prepare("DELETE FROM likefoto WHERE fotoid = ?");
    $stmt_delete_like->bind_param("i", $idg);
    $stmt_delete_like->execute();
    $stmt_delete_like->close();

    $queryShow = "SELECT lokasi_file FROM foto where fotoid = ?;";
    $stmt = $conn->prepare($queryShow);
    $stmt->bind_param("i", $idg);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $stmt->close();
        return false;
    }

    $resultGambar = $result->fetch_assoc();
    $imagePath = "album/" . $resultGambar['lokasi_file'];

    if ($resultGambar['lokasi_file'] != "" || $resultGambar['lokasi_file'] != null) {
        if (file_exists($imagePath)) {
            unlink("album/" . $resultGambar['lokasi_file']);
        }
    }
    $stmt->close();

    $sql = "DELETE FROM foto WHERE fotoid = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $idg);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
<!-- KOMENTAR -->
<?php
function komentar_show($gambarid, $userid)
{
    global $conn;
    $sql = "SELECT komentar.*, user.username FROM komentar INNER JOIN user ON komentar.userid = user.userid WHERE fotoid = ? AND komentar.userid != ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $gambarid, $userid);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}

function komentar_show_user($gambarid, $userid)
{
    global $conn;
    $sql = "SELECT komentar.*, user.username FROM komentar INNER JOIN user ON komentar.userid = user.userid WHERE fotoid = ? AND komentar.userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $gambarid, $userid);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}

function tambah_komen()
{
    global $conn;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idK = mysqli_real_escape_string($conn, $_POST['gambarid']);
        $idU = mysqli_real_escape_string($conn, $_POST['userid']);
        $komentar = mysqli_real_escape_string($conn, $_POST['komentar']);

        $sql = "INSERT INTO komentar (fotoid, userid, isi_komentar) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $idK, $idU, $komentar);
        if ($stmt->execute()) {
            header("Location: {$_SERVER['REQUEST_URI']}");
            exit();
        }
    }
}

function delete_komentar()
{
    $idK = trim($_GET["id"]);
    global $conn;

    $sql = "DELETE FROM komentar WHERE komentarid = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $idK);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
<!-- LIKE -->
<?php
function like_gambar($userid, $gambarid)
{
    global $conn;

    $query = "SELECT * FROM likefoto WHERE userid = ? AND fotoid = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $userid, $gambarid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $insertQuery = "INSERT INTO likefoto (userid, fotoid, tanggal_like) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ii", $userid, $gambarid);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    } else {
        $deleteQuery = "DELETE FROM likefoto WHERE userid = ? AND fotoid = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("ii", $userid, $gambarid);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
function like_count($photoId)
{
    global $conn;
    $query = "SELECT COUNT(*) AS total_likes FROM likefoto WHERE fotoid = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $photoId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['total_likes'];
}

function check_like($userID, $gambarID)
{
    $userid = trim($userID);
    $gambarid = trim($gambarID);
    global $conn;
    $query = "SELECT * FROM likefoto WHERE userid = ? AND fotoid = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $userid, $gambarid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function generateLikeIcon($userId, $fotoId)
{
    if (isset($userId)) {
        $isLiked = check_like($userId, $fotoId);
        $heartClass = $isLiked ? "bi-balloon-heart-fill" : "bi-balloon-heart";
    } else {
        $heartClass = "bi-balloon-heart";
    }
    return '<span style="font-size: 1.5rem;" class="bi ' . $heartClass . ' heart-icon" data-gambar-id="' . $fotoId . '"></span>';
}
// <?= generateLikeIcon($_SESSION['id_user'] ?? null, $gambar['fotoid']) 
// <span style="font-size: 1.3rem;" class="mb-5" id="like-count<?= $gambar['fotoid'] "><?= like_count($gambar['fotoid']) </span>
?>