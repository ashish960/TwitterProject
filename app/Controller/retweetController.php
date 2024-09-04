<?php
namespace retweet;
require_once '../Model/retweetModel.php';
require_once '../../env/dbconn.php';
use dbconn\connection as connection;
use retweetModel\retweet as retweet;

class retweetController
{
    private $retweetModel;

    public function __construct()
    {
        $this->retweetModel = new retweet();
    }

  

    public function retweetPost($userId, $postId)
    {
        $this->retweetModel->retweetPost($userId, $postId);
    }






     


}
?>