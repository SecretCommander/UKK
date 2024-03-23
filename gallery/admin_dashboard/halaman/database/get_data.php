<?php
include 'koneksi.php';
include 'functionAdmin.php';

if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

if (isset($_GET['id']) && isset($_GET['tipe'])) {
    $id = $_GET['id'];
    $tipe = $_GET['tipe'];

    // Query untuk mengambil data barang berdasarkan ID
    if($tipe === 'admin'){
        $sql = "SELECT adminid, nama, username, password, telp, levelA FROM admin WHERE adminid = $id";
    }
    

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Kembalikan data dalam format JSON
        header('Content-Type: application/json');
        echo json_encode($row);
    } else {
        echo "Data Admin tidak ditemukan";
    }
} else {
    echo "Parameter ID atau Tipe tidak diterima";
}
mysqli_close($conn);
