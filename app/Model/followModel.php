<?php
namespace followModel;
require_once '../../env/dbconn.php';
use dbconn\connection as connection;

if(!isset($_SESSION['user_id'])){
    session_start();
}

class follow
{
    private $conn;

    public function __construct()
    {
         $connection = new connection;
         global $conn;
        
        $this->conn = $connection->connection;
    }

    public function getUsersToFollow($offset, $limit)
    {
        
        $followerId =$_SESSION['user_id'];

        $stmt = $this->conn->prepare("
            SELECT u.id, u.username, u.name, u.img
            FROM users u
            WHERE u.id NOT IN (
                SELECT followed_id FROM follows WHERE follower_id = ?
            )
            LIMIT ?, ?
        ");
        $stmt->bind_param("iii", $followerId, $offset, $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        $users = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $users;
    }

    public function followUser($followerId, $followedId)
    {
        $stmt = $this->conn->prepare("
            INSERT INTO follows (follower_id, followed_id) VALUES (?, ?)
        ");
        $stmt->bind_param("ii", $followerId, $followedId);
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
