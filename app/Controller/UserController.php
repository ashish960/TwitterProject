<?php
require_once '../../env/dbconn.php';

require_once '../Validation/signupValidation';
require_once '../Model/userSignupModel.php';


require_once '../Validation/loginValidation.php';
require_once '../Model/userLoginModel.php';


 
use dbconn\connection as connection;

use userSignupModel\signUp as signUp;
use Validation\signupValidation as signupValidation;

use userLoginModel\Login as login;
use loginValidation\loginValidation as loginValidation;

class User{


       //for signup
     public function userSignup($names,$email,$phoneno,$passwords,$confirm_password){
            
        $connect = new connection();
        $insert=new signUp;
        $validate=new signupValidation;


    
         if($_SERVER['REQUEST_METHOD'] =='POST'){ 
            $data = [
              "name" => $names,
              "email" => $email,
              "phoneno" => $phoneno,
              "password" => $passwords,
              "confirm_password" => $confirm_password
            ];
            
            $errors= $validate->signupValidation($data);
            if(empty($errors)){
                unset($data['confirm_password']);
                $success= $insert->insert($data,$connect->connection);
    
                if($success==true){
                    header('location: ../View/index.php');
                    exit();
                }else{
                 
                    header('location: ../View/serverError.php');
                    exit();
                }
            }
            else{
                  $_SESSION['signup_errors']=$errors;
                  header('location: ../View/index.php');
                  exit();
            }
            
           }
          
         }
         //signu_end


        
       //for login
       public function userLogin($email,$passwords){
        $connect = new connection();
        $login=new login;
        $validate=new loginValidation;

         if($_SERVER['REQUEST_METHOD'] =='POST'){ 
            $data = [
              "email" => $email,
              "password" => $passwords
            ];
            $errors= $validate->loginValidation($data);
            if(empty($errors)){
                $users= $login->login($email,$connect->connection);
                if(!empty($users)){
                
                    if(password_verify($passwords,$users['password']))
                    {     
                        $_SESSION["user_id"] = $users['id'];
                        $_SESSION["email"] = $users['email'];
                        header("Location: ../View/profile.php");
                        exit();
                    } else {
                        $errors['invalid_user'] = 'invalid emil or password';
                        $_SESSION['login_errors']=$errors;
                         header('location: ../View/index.php');
                         exit();
                    }
                }else{
                    $errors['invalid_user'] = 'user not found';
                    $_SESSION['login_errors']=$errors;
                    header('location: ../View/index.php');
                    exit();
                }
            }
            else{
                  $_SESSION['login_errors']=$errors;
                  header('location: ../View/index.php');
                  exit();
            }
            
           }
          
         }

         //login_end

         
     }
    
     $user = new User();

     if (isset($_POST['signup'])) {
         $user->userSignup($_POST["names"], $_POST["email"], $_POST["phoneno"], $_POST["passwords"], $_POST["confirm_password"]);
     } elseif (isset($_POST['login'])) {
         $user->userLogin($_POST["userEmail"], $_POST["userPassword"]);
     }

?>