
<?php
require_once '../Controller/followController.php';
use follow\followController as follow;

if(!isset($_SESSION['user_id'])){
    session_start();
}

$controller = new follow;
$followerId = $_SESSION['user_id'];

if ($_POST['action'] === 'follow') {
   
    $controller->followUser($followerId, $_POST['followed_id']);
} elseif ($_POST['action'] === 'unfollow') {
    $controller->unfollowUser($followerId, $_POST['followed_id']);
}
?>

