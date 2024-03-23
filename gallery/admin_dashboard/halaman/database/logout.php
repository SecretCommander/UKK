<?php
session_start();
unset($_SESSION['admin_id']);
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['levelA']);
session_destroy();

// if (isset($_COOKIE['username'])) {
//     unset($_COOKIE['id_user']);
//     unset($_COOKIE['username']);
//     unset($_COOKIE['password']);
//     setcookie('id_user', '', time() - 86400 * 30, "/");
//     setcookie('username', '', time() - 86400 * 30, "/");
//     setcookie('password', '', time() - 86400 * 30, "/");
// }

header("location: ../../index.php");
?>