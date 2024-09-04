<?php namespace  userLoginModel;

class Login{
    function login($email,$conn) {
        
        $sql = "select * from `users` where email = '$email' ";  
        $query = $conn->query( $sql );
        return mysqli_fetch_assoc( $query );
      
    }
}
                     
