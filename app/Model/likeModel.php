<?php
namespace likeModel;
require_once '../../env/dbconn.php';
use dbconn\connection as connection;
if(!isset($_SESSION['user_id'])){
    session_start();
}

class like
{
   
    private $conn;

    public function __construct()
    {
        
         $connection = new connection;
         global $conn;
        
        $this->conn = $connection->connection;
    }


    public function likeUser($userId, $postId)
    {
        $stmt = $this->conn->prepare("
            INSERT INTO likes (user_id, post_id) VALUES (?, ?)
        ");
        $stmt->bind_param("ii", $userId, $postId);
        $stmt->execute();
        $stmt->close();
    }

    public function unfollowUser($followerId, $followedId)
    {
        $stmt = $this->conn->prepare("
            DELETE FROM follow WHERE follower_id = ? AND followed_id = ?
        ");
        $stmt->bind_param("ii", $followerId, $followedId);
        $stmt->execute();
        $stmt->close();
    }
}
?>
