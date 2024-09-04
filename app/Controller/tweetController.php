<?php
require_once '../../env/dbconn.php';

require_once '../Validation/tweetValidation.php';
require_once '../Model/tweetModel.php';


use dbconn\connection as connection;

use tweetModel\tweet as userTweet;
use tweetValidation\tweetValidation as tweetValidation;


class tweet{
    

    public function userTweet($status,$tweetPost){
        
        session_start();
        //checklogin
        if(!isset($_SESSION['user_id'])){
            header('location: ../View/index.php');
        }

            $insert=new userTweet;
            $validate=new tweetValidation;
            $connect = new connection;
            $user_id=$_SESSION["user_id"];          

            if($_SERVER['REQUEST_METHOD'] =='POST'){ 
                $data = [
                  "status"=>$status,
                  "user_id"=>$user_id,
                  "img"=>$tweetPost
                ];
            }

                 

            $errors= $validate->validateTweet($data);
             
            
            if(empty($errors)){
                $data["img"]=$tweetPost["name"];


                $fileExtension = strtolower(pathinfo($tweetPost['name'], PATHINFO_EXTENSION));
                $allowedImageTypes = ['jpg', 'jpeg', 'png', 'gif'];
                $allowedVideoTypes = ['mp4', 'avi', 'mpeg'];


                $success= $insert->insert($data,$connect->connection);
                if($success==true){
                if ($tweetPost['name'] !== "") {
                    if (in_array($fileExtension, $allowedImageTypes)) {
                            
                            move_uploaded_file($tweetPost['tmp_name'] , '../../public/images/users/' .$tweetPost['name'] );
                    
                }
                elseif(in_array($fileExtension, $allowedVideoTypes)){
                    move_uploaded_file($tweetPost['tmp_name'] , '../../public/videos/users/' .$tweetPost['name'] );
             }
             header('location: ../View/profile.php');
             exit();
            }
            header('location: ../View/profile.php');
            exit();
          
    }

}
else{
                
    $_SESSION['tweet_errors']=$errors;
    header('location: ../View/profile.php');
    exit();
}


}

public static function getData($id) {
  $datas = [];
  $retweetPosts = [];
  $data2 = [];
  $connection = new connection;
  $conn = $connection->connection;
  

  $sql = "SELECT * FROM `usertweets` WHERE user_id = '$id' ORDER BY `created_at` DESC"; 
  $data = $conn->query($sql);


  $retweetPostsData = "SELECT * FROM `retweets` WHERE user_id = '$id' ORDER BY `created_at` DESC";
  $retweetData = $conn->query($retweetPostsData);
  
  
  while ($retweet = mysqli_fetch_assoc($retweetData)) {
      $retweetPosts[] = $retweet['post_id'];
  }
  

  foreach ($retweetPosts as $postId) {
      $sql2 = "SELECT * FROM `usertweets` WHERE id = '$postId' ORDER BY `created_at` DESC";
      $result = $conn->query($sql2);
      while ($row = mysqli_fetch_assoc($result)) {
          $data2[] = $row;
      }
  }


  while ($row = mysqli_fetch_assoc($data)) {
      $datas[] = $row;
  }
  

  $datas = array_merge($datas, $data2);

 
  usort($datas, function($a, $b) {
    return strcmp($b['created_at'], $a['created_at']);
});


  return $datas;
}




  public static function getUserLikes($id) {
    $connect = new connection;
    $conn=$connect->connection;
    $sql = "select count(*) as likeCount from `likes` where post_id = '$id' "; 
    $data = $conn->query( $sql );
    return mysqli_fetch_assoc( $data );
  }

  public static function getRetweets($id) {
       
    $connect = new connection;
    $conn=$connect->connection;
    $sql = "select count(*) as retweetCount from `retweets` where post_id = '$id' "; 
    $data = $conn->query( $sql );
    return mysqli_fetch_assoc( $data );
  }

  public static function getUserData($users_id) {
       
    $connection = new connection;
    $conn=$connection->connection;
    $sql = "SELECT * from `users` where id = '$users_id' "; 
    $data = $conn->query( $sql );
    return mysqli_fetch_assoc( $data );
  }

  
  public static function getPostData($post_id) {
  
    $connection = new connection;
    $conn=$connection->connection;

    $sql = "SELECT *  from `usertweets` where id = '$post_id' "; 
    $data = $conn->query( $sql );
   
    return mysqli_fetch_assoc( $data );

}
  

 


}






$tweet = new tweet();

if (isset($_POST['tweet'])) {
    $tweet->userTweet($_POST["status"],$_FILES["tweetPost"]);
} 
