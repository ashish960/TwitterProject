
<?php
require_once '../Controller/likeController.php';
use like\likeController as like;

session_start();
$controller = new like;
$userId = $_SESSION['user_id'];
if ($_POST['action'] === 'like') {

    $controller->likeUser($userId, $_POST['post_id']);
} 
?>
