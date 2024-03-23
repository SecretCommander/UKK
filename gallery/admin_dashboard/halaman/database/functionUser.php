<?php
require 'koneksi.php';

//Tampil Data(not Used)
function tampil_data_user()
{
    global $conn;
    $sql = "SELECT * FROM user";
    $result = mysqli_query($conn, $sql);
    return $result;
}

//Update Profile
function edit_user()
{
    global $conn;
    $id = htmlspecialchars(trim($_POST['id']));
    $nama = htmlspecialchars($_POST['nama_pembeli']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['pw']);
    $telp = htmlspecialchars($_POST['telp']);
    $email = htmlspecialchars($_POST['email']);
    $sql = "UPDATE pembeli SET nama_pembeli='$nama' ,username='$username', password='$password', telepon='$telp', email='$email' where id_pembeli='$id'";
    try {
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('User berhasil Diedit!')</script>";
        } else {
            throw new Exception("Insert query failed");
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

function delete_directory_recursive($dir) {
    $files = array_diff(scandir($dir), array('.', '..'));
    foreach ($files as $file) {
        $path = "$dir/$file";
        is_dir($path) ? delete_directory_recursive($path) : unlink($path);
    }
    return rmdir($dir);
}

function delete_user($var_id)
{
    $idp = $_GET["id"];
    global $conn;

    $queryShow = "SELECT * FROM user WHERE userid = ?";
    $stmtShow = mysqli_prepare($conn, $queryShow);
    mysqli_stmt_bind_param($stmtShow, "i", $var_id);
    mysqli_stmt_execute($stmtShow);
    $result = mysqli_stmt_get_result($stmtShow);
    $user = mysqli_fetch_assoc($result);

    //jika user memiliki profil hapus foto profil
    if ($user['profile']) {
        unlink("../../../profile/" . $user['profile']);
    }

    $queryDeleteLikes = "DELETE FROM likefoto WHERE userid = ?";
    $stmtDeleteLikes = mysqli_prepare($conn, $queryDeleteLikes);
    mysqli_stmt_bind_param($stmtDeleteLikes, "i", $var_id);
    mysqli_stmt_execute($stmtDeleteLikes);

    $queryDeleteComments = "DELETE FROM komentar WHERE userid = ?";
    $stmtDeleteComments = mysqli_prepare($conn, $queryDeleteComments);
    mysqli_stmt_bind_param($stmtDeleteComments, "i", $var_id);
    mysqli_stmt_execute($stmtDeleteComments);

    $queryDeletePhotos = "DELETE FROM foto WHERE userid = ?";
    $stmtDeletePhotos = mysqli_prepare($conn, $queryDeletePhotos);
    mysqli_stmt_bind_param($stmtDeletePhotos, "i", $var_id);
    mysqli_stmt_execute($stmtDeletePhotos);

    $queryDeleteAlbums = "DELETE FROM album WHERE userid = ?";
    $stmtDeleteAlbums = mysqli_prepare($conn, $queryDeleteAlbums);
    mysqli_stmt_bind_param($stmtDeleteAlbums, "i", $var_id);
    mysqli_stmt_execute($stmtDeleteAlbums);

    $base_path = "../../../album/" . $var_id;
    if (file_exists($base_path)) {
        delete_directory_recursive($base_path);
    }

    $queryDeleteUser = "DELETE FROM user WHERE userid = ?";
    $stmtDeleteUser = mysqli_prepare($conn, $queryDeleteUser);
    mysqli_stmt_bind_param($stmtDeleteUser, "i", $var_id);

    if (mysqli_stmt_execute($stmtDeleteUser)) {
        return true;
    } else {
        return false;
    }
}

