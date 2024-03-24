<?php
include 'koneksi.php';
session_start();
function tampil_data_admin()
{
    global $conn;
    $sql = "SELECT * FROM admin";
    $result = mysqli_query($conn, $sql);
    return $result;
}
function detail_data($id)
{
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    $sql = "SELECT * FROM admin where adminid=$id";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }
}



function loginnn()
{
    global $conn;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = login($conn, $username, $password);
        echo $result;
    }
}
function update()
{
    global $conn;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id             = $_POST['id_petugas'];
        $nama           = $_POST['nama'];
        $username       = $_POST['username'];
        $password       = $_POST['password'];
        $telp           = $_POST['telp'];
        $sql = "UPDATE admin SET nama='$nama' ,username='$username', password='$password', telp='$telp' where adminid='$id'";
        try {
            mysqli_query($conn, $sql);
            echo "<script>alert('Data yang anda Update sukses');window.location='tampil_data.php'</script>";
        } catch (mysqli_sql_exception $e) {
            return "Update Failed";
        }
    }
}

function delete_admin($var_id)
{
    global $conn;

    $sql = "DELETE FROM admin WHERE adminid = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $var_id);

        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;;
        }

        mysqli_stmt_close($stmt);
    }
}

function tambah_admin()
{
    global $conn;
    $nama = htmlspecialchars($_POST['nama_admin']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['pw']);
    $telp = htmlspecialchars($_POST['telp']);
    $level = htmlspecialchars($_POST['level']);
    $sql = "INSERT INTO admin (nama, username, password, telp, levelA) VALUES ('$nama','$username','$password','$telp', '$level')";
    try {
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Admin berhasil ditambahkan!')</script>";
        } else {
            throw new Exception("Insert query failed");
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

function edit_admin()
{
    global $conn;
    $id = htmlspecialchars(trim($_POST['id']));
    $nama = htmlspecialchars($_POST['nama_admin']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['pw']);
    $telp = htmlspecialchars($_POST['telp']);
    $level = htmlspecialchars($_POST['level']);
    $sql = "UPDATE admin SET nama='$nama' ,username='$username', password='$password', levelA='$level', telp='$telp' WHERE adminid ='$id'";
    try {
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Admin berhasil Diedit!')</script>";
        } else {
            throw new Exception("Insert query failed");
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

function Action()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // menyimpan data kedalam variabel
        if (isset($_POST['add'])) {
            tambah_admin();
        } else if (isset($_POST['edit'])) {
            edit_admin();
        } else {
            echo "<script>alert('Gagal melakukan aksi');";
        }
    }
}


function login($conn, $username, $password)
{
    $sql = "SELECT * FROM admin WHERE username=? and password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['admin_id'] = $row['adminid'];
        $_SESSION['level'] = $row['levelA'];
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
        // $remember = isset($_POST['check']);

        if (login($conn, $username, $password)) {
            // if ($remember) {
            //     setcookie('username', $username, time() + (86400 * 30), "/"); // 86400 = 1 day
            //     setcookie('password', $password, time() + (86400 * 30), "/"); // 86400 = 1 day
            // }

            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            header("Location: halaman/database/admin-datalist.php");
            exit();
        } else {
            echo "<script>alert('Username atau Password Salah');</script>";
            // echo '<div class="alert alert-danger position-absolute top-0 start-50 translate-middle mt-4 z-3">Username atau Password Salah</div>';
        }
    }
}
?>