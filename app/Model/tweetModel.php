<?php
namespace tweetModel;

class tweet {

    function insert($data,$conn) {
        
     $key = implode(',', array_keys($data));
     $value = "'" . implode("','", array_values($data)) . "'";
        

        $sql="INSERT INTO `usertweets` ( $key ) VALUES ( $value )";
        $success=mysqli_query($conn,$sql);
        return $success;
    }





}

?>


