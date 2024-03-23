<?php
require('koneksi.php');
include('functionAdmin.php');
?>
<html>

<head>
    <title>HAPUS DATA </title>
</head>

<body>
    <?php
    if (!empty($_GET['id'])) {
        if (delete_admin(trim($_GET['id']))) {
            echo "<script>alert('Item deleted successfully');</script>";
            header("Location: admin-datalist.php");
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