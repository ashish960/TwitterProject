<?php
namespace userSignupModel;

class signUp{

    function insert($data,$conn) {

      if (isset($data['password'])) {
         $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
     }

        
     $key = implode(',', array_keys($data));
     $value = "'" . implode("','", array_values($data)) . "'";
        

        $sql="INSERT INTO `users` ( $key ) VALUES ( $value )";
        $success=mysqli_query($conn,$sql);
        return $success;
    }


}

?>
