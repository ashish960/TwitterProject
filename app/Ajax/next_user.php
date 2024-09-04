<?php
require_once '../Controller/followController.php';
require_once '../Model/followModel.php';
use follow\followController as follow;
use followModel\follow as followModel;

$model = new followModel;
$offset = isset($_POST['offset']) ? (int)$_POST['offset'] : 0;
$users = $model->getUsersToFollow($offset, 5);
?>
<div class="follow" style="flex: 1 1 300px; max-width: 25vw;">
<div class="card" style="min-width:300px; position: -webkit-sticky;position: sticky;top:20px; border:none;">
 <?php foreach($users as $user): ?>
    <div class="grid-share" style="display: flex; padding-top: 5px;" id="who-to-follow">
      <img src="../../public/images/users/<?php echo  $user['img']; ?>"alt="" style="width: 50px; height: 50px; border-radius: 50%;margin-left:5px; margin-right: 10px;">
      <div>
        <strong><?php echo $user['username']; ?></strong>
        <p><?php echo $user['name']; ?></p>
      </div>
      <button type="button" class="btn btn-outline-primary" style="height: 40px; border-radius: 50%; margin:6px 15px auto auto;"  id="follow-btn-<?php echo $user['id']; ?>" onclick="followUser(<?php echo $user['id']; ?>)"><h6>Follow</h6></button>
      </div>
      <hr>
     <?php endforeach; ?>
 </div>
 </div>