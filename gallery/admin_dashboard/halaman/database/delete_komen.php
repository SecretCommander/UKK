<?php
require('functionGambar.php');
// if (!isset($_SESSION['username']) && !isset($_SESSION['password']) && !isset($_SESSION['id_user'])) {
//     header("location: login.php");
if (!isset($_GET['gambar'])) {
    echo "<script>window.history.back();</script>";
    exit();
}
?>
<html>

<head>
    <title>HAPUS DATA </title>
</head>

<body>
    <?php
    if (!empty($_GET['id'])) {
        if (delete_komentar()) {
            echo "<script>alert('komentar berhasil dihapus');</script>";
            header("Location: gambar.php?gambar=" . $_GET['gambar']);
            exit();
        } else {
            die("Gagal hapus");
        }
    } else {
        die("error");
    }
    ?>
</body>
</html>