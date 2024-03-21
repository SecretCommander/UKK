<?php
session_start();
unset($_SESSION['id_user']);
unset($_SESSION['username']);
unset($_SESSION['password']);
session_destroy();

if (isset($_COOKIE['username'])) {
    unset($_COOKIE['id_user']);
    unset($_COOKIE['username']);
    unset($_COOKIE['password']);
    setcookie('id_user', '', time() - 86400 * 30, "/");
    setcookie('username', '', time() - 86400 * 30, "/");
    setcookie('password', '', time() - 86400 * 30, "/");
}

header("location: index.php");
?>