<?php
require 'koneksi.php';

//Tampil Data(not Used)
function gambar_index()
{
    global $conn;
    $sql = "SELECT foto.fotoid, foto.judul_foto, foto.deskripsi_foto, foto.lokasi_file, user.userid, user.username, user.profile
    FROM foto
    INNER JOIN user ON foto.userid = user.userid";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

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
    $imagePath = "../../../album/" .$resultGambar['lokasi_file'];

    if ($resultGambar['lokasi_file'] != "" || $resultGambar['lokasi_file'] != null) {
        if (file_exists($imagePath)) {
            unlink("../../../album/" .$resultGambar['lokasi_file']);
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
