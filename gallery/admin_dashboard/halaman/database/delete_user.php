<?php
require('koneksi.php');
include('functionUser.php');
?>
<html>

<head>
    <title>HAPUS DATA </title>
</head>

<body>
    <?php
    if (!empty($_GET['id'])) {
        if (delete_user(trim($_GET['id']))) {
            echo "<script>alert('Item deleted successfully');</script>";
            header("Location: user-datalist.php");
            exit();
        } else {
            die("Data tidak ditemukan");
        }
    } else {
        die("error");
    }
    mysqli_close($conn);
    ?>
    
</body>

</html>