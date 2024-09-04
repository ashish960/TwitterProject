<?php
namespace like;
require_once '../Model/likeModel.php';
require_once '../../env/dbconn.php';
use dbconn\connection as connection;
use likeModel\like as like;

class likeController
{
    private $likeModel;

    public function __construct()
    {
        $this->likeModel = new like();
    }

  

    public function likeUser($userId, $postId)
    {
        $this->likeModel->likeUser($userId, $postId);
    }



    public static function getData($id) {
       
        $connect = new connection;
        $conn=$connect->connection;
        $sql = "select * from `users` where id = '$id' "; 
        $data = $conn->query( $sql );
        return mysqli_fetch_assoc( $data );
      }



     


}
?>