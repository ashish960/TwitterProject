<?php
require_once '../Controller/retweetController.php';
use retweet\retweetController as retweet;

session_start();
$controller = new retweet;
$userId = $_SESSION['user_id'];
if ($_POST['action'] === 'retweet') {

    $controller->retweetPost($userId, $_POST['post_id']);
} 
?>
