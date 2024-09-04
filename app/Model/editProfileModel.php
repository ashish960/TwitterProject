<?php
namespace editProfileModel;

class editProfile {

    function insert($data, $user_id, $conn) {

        $updates = [];
        
        foreach ($data as $key => $value) {
            if (!empty($value)) { 
                $updates[] = "$key = '$value'";
            }
        }
     
        $setClause = implode(', ', $updates);

        $sql = "UPDATE `users` SET $setClause WHERE id = $user_id";


        $success = mysqli_query($conn, $sql);
        return $success;
    }
}
?>
