<?php
namespace retweetModel;
require_once '../../env/dbconn.php';
use dbconn\connection as connection;
if(!isset($_SESSION['user_id'])){
    session_start();
}

class retweet
{
   
    private $conn;

    public function __construct()
    {
        
         $connection = new connection;
         global $conn;
        
        $this->conn = $connection->connection;
    }


    public function retweetPost($userId, $postId)
    {
        $stmt = $this->conn->prepare("
            INSERT INTO retweets (user_id, post_id) VALUES (?, ?)
        ");
        $stmt->bind_param("ii", $userId, $postId);
        $stmt->execute();
        $stmt->close();
    }

    

}
?>
