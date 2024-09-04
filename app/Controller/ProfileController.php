<?php
require_once '../../env/dbconn.php';

require_once '../Validation/editProfileValidation.php';
require_once '../Model/editProfileModel.php';


use dbconn\connection as connection;

use editProfileModel\editProfile as editProfile;
use editProfileValidation\profileValidation as profileValidation;

class profile{
    protected static $pdo;
    public function updateUserProfile($profilePreview,$profileImage,$profileName,$bio,$website,$location){
        
        session_start();
        //checklogin
        if(!isset($_SESSION['user_id'])){
           header('location: index.php');
         }

         
        $insert=new editProfile;
        $validate=new profileValidation;
        $connect = new connection;

        if($_SERVER['REQUEST_METHOD'] =='POST'){ 
            $data = [
              "username"=>$profileName,
              "bio"=>$bio,
              "website"=>$website,
              "location"=>$location,
              "img"=>$profileImage['name'],
              "imgCover"=>$profilePreview['name']
            ];
          

            $user_id=$_SESSION["user_id"];                 

            $errors= $validate->validateProfile($data);
        
           
            if(empty($errors)){
                $success= $insert->insert($data,$user_id,$connect->connection);
                
                $user ="select * from `users` where id = '$user_id' "; 
                $query = $connect->connection->query( $user );
                $user_data= mysqli_fetch_assoc( $query );
               

                
                $currentImg = $user_data['img'];
                $currentCover = $user_data['imgCover'];
                if($success==true){
                        if ($profileImage['name'] !== "") {
                           if ($currentImg !== 'default.jpg'){
                                   unlink('../../public/images/users'. $currentImg);
                                   
                                   move_uploaded_file($profileImage['tmp_name'] , '../../public/images/users/' .$profileImage['name'] );
                           
                       }
                       else{
                        move_uploaded_file($profileImage['tmp_name'] , '../../public/images/users/' .$profileImage['name'] );
                       }
                    }
                        if ($profilePreview['name'] !== "") {
                           if ($currentCover !== 'cover.png'){
                             unlink('../../public/images/users/'.$currentCover);
           
                             move_uploaded_file($profilePreview['tmp_name'] , '../../public/images/users/' .$profilePreview['name'] );
                           }else{
                            move_uploaded_file($profilePreview['tmp_name'] , '../../public/images/users/' .$profilePreview['name'] );
                           }
                       }
           
                    header('location: ../View/profile.php');
                    exit();
                }
            else{
                header('location: ../View/serverError.php');
                exit();
            }
        }
            else{
                
                $_SESSION['profile_update_errors']=$errors;
                header('location: ../View/profile.php');
                exit();
          }

        }



    }

    public static function getData($id) {
       
        $connect = new connection;
        $conn=$connect->connection;
        $sql = "select * from `users` where id = '$id' "; 
        $data = $conn->query( $sql );
        return mysqli_fetch_assoc( $data );
      }

   
}





$profile = new profile();

if (isset($_POST['editProfile'])) {
$profile->updateUserProfile($_FILES["profilePreview"], $_FILES["profileImage"], $_POST["profileName"], $_POST["bio"], $_POST["website"],$_POST["location"]);
}
