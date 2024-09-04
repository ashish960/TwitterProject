<?php
namespace follow;
require_once '../Model/followModel.php';
require_once '../../env/dbconn.php';
use dbconn\connection as connection;
use followModel\follow as follow;

class followController
{
    private $followModel;

    public function __construct()
    {
        $this->followModel = new follow();
    }

    public function whoToFollow()
    {
        $users = $this->followModel->getUsersToFollow(0, 5);
        return $users;
    }

    public function followUser($followerId, $followedId)
    {
        $this->followModel->followUser($followerId, $followedId);
    }

    public function unfollowUser($followerId, $followedId)
    {
        $this->followModel->unfollowUser($followerId, $followedId);
    }
}
?>
