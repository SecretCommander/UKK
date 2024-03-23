<?php
require('functionGambar.php');
// if (!isset($_SESSION['username']) && !isset($_SESSION['password']) && !isset($_SESSION['id_user'])) {
//     header("location: login.php");
// }
?>
<html>

<head>
    <title>HAPUS DATA </title>
</head>

<body>
    <?php

    if (!empty($_GET['id'])) {
        if (delete_gambar()) {
            echo "<script>alert('Gambar berhasil dihapus');</script>";
            header("Location: gambar-datalist.php");
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