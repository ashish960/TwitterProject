
<?php
  require_once '../../env/dbconn.php';
  use dbconn\connection as connection;
class homeTweet{

    public static function getData() {
        $datas = [];
        $connection = new connection;
        $conn=$connection->connection;
        $sql = "select * from `usertweets` ORDER BY `created_at` DESC" ; 
        
        
        $data = $conn->query( $sql );
        
        while ($row = mysqli_fetch_assoc($data)) {
            $datas[] = $row; // Add each row to the $data array
        }
        return $datas;
    
      }


}

?>


