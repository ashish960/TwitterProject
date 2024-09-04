<?php
   namespace dbconn;
 class connection{
            private $username="root";
            private $servername="localhost";
            private $password="";
            private $database="tweetphp";
            public $connection;

            public function __construct(){
              $conn=  $this->connection=mysqli_connect(
                    $this->servername,
                    $this->username,
                    $this->password,
                    $this->database
               ); 
               if(empty($conn)){
                      die('connection failed:');
               }
            
            }

         
   }

?>