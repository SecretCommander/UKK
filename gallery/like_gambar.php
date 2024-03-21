<?php 
require_once('function.php');

if (isset($_POST['gambar_id'])) {
    $userId = $_SESSION['id_user'];
    $photoId = $_POST['gambar_id'];
    
    if (like_gambar($userId, $photoId)) {
        echo "Liked";
    } else {
        echo "Error occurred while processing like action.";
    }
}
?>