<?php
 include_once 'modals/tweet.php';
 include_once '../Model/homeTweetModel.php';
 include_once '../Controller/ProfileController.php';
 include_once '../Controller/followController.php';
 include_once '../Controller/likeController.php';
 include_once  '../View/modals/comment.php';

 include_once 'modals/editProfile.php';
 include_once '../Controller/tweetController.php';



 use follow\followController as follow;
?>

<?php

//checklogin and get user data
if(!isset($_SESSION['user_id'])){
  header('location: index.php');
}else{
  $user_id = $_SESSION['user_id'];
  $user =profile::getData($user_id);
  $user_tweets=tweet::getData($user_id);
  
  
}
?>


<?php
  $user_tweets=homeTweet::getData();
  $controller = new follow;
 $users= $controller->whoToFollow();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body style="background-color:#EBEBEB;">



<div class="contentContainer" style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; padding: 20px;">


<!--  -->

  <div class="profile" style="flex: 1 1 300px; max-width: 250px;">
    <div class="card" style="width: 100%; border-radius: 8px; background-color: #EBEBEB; position: -webkit-sticky;position: sticky;top:20px;">
      <div class="card-body" >
        <div class="container1" style="display:flex;margin-bottom:20px;">
        <img src="../../public/images/tweethome.png" alt="" height="23px" width="23px" style="margin:0px 10px 0px 3px;">
        <a class="nav-link active" aria-current="page" href="home.php" id="home">Home</a>
        </div>
        
        <div class="container2" style="display:flex;margin-bottom:20px;">
        <img  src="../../public/images/tweetprof.png"  alt="" height="23px" width="23px" style="margin:0px 10px 0px 3px;">
        <a class="nav-link active" aria-current="page" href="profile.php" id="home">Profile</a>
        </div>

        <div class="container3" style="display:flex;margin-bottom:20px;">
        <img src="../../public/images/tweetnotif.png" alt="" height="23px" width="23px" style="margin:0px 10px 0px 3px;">
        <a class="nav-link active" aria-current="page" href="home.php" id="home">Notification</a>
        </div>

        <div class="container4" style="display:flex;margin-bottom:20px;">
        <img src="../../public/images/message.png" alt="" height="23px" width="23px" style="margin:0px 10px 0px 3px;">
        <a class="nav-link active" aria-current="page" href="home.php" id="home">Message</a>
        </div>

        <form  action="../Controller/logoutController.php" method="POST" >
        <div class="container4" style="display:flex;margin-bottom:20px;">
        <img src="../../public/images/logout.png" alt="" height="23px" width="23px" style="margin:0px 10px 0px 3px;">
        <input type="submit" name="logout" value="Logout"  style="border:none;background-color: #EBEBEB;margin-top:0px;">
        </div>
        </form>
           <!-- logoutbutton -->
    
            
         
      
   <!-- LOGOUTBUTTON -->
        <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#tweet" style="width:100%;border-radius:25px;">Tweet</button>

    


      </div>
    </div>
  </div>


  <div class="tweet" style="flex: 1 1 400px; max-width: 55vw;">
    <div class="card text-center" style="border: none; border-radius: 8px; margin-top: 4px;">
      <div class="card-header" style=" display:flex;background-color: white;">
        <Strong >Tweets</Strong>
        <Strong style="color:#0F92C7;margin-left:30px;" >Tweets & replies</Strong>
      </div>
      <!--  -->
      <!--  -->

  <!--  -->
  <!--  -->
      <?php foreach($user_tweets as $user_tweet){ 
        //for date and time format
        $createdAt = new DateTime($user_tweet['created_at']);
        $time= $createdAt->format('h:i A');
        $date = $createdAt->format('M j, Y');
        ?>

        <?php
         $user_id=$user_tweet['user_id'];
         $user = profile::getData($user_id);

        ?>
        
               
      <div class="card-body">
        <div class="imageNameContainer" style="display:flex;">
      <img src="../../public/images/users/<?php echo  $user['img']; ?>" alt="" style="width: 40px; height: 40px; border-radius: 50%;margin-left:5px; margin-right: 10px;">
      <div style="display:flex;margin-left:10px;">
          <strong><?php echo $user['name']?></strong>
          <p style="margin-left:5px;"><?php echo $user['username'] == null ? "@username" : "@" . $user['username'];?></p>
      </div>
      </div>

         
        <div class="contentContainer">
          <textarea name="" id=""style="margin:0px;padding:0px;width:100%;max-height:200px;border:none;outline:none;"readonly><?php echo $user_tweet['status'] ?></textarea>
        </div>
        <div class="container">
    <?php

    $fileExtension = pathinfo($user_tweet['img'], PATHINFO_EXTENSION);
    $videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv'];
    
    if (in_array(strtolower($fileExtension), $videoExtensions)) {
        echo '<div class="video">
            <iframe width="100%" height="315" src="../../public/videos/' . htmlspecialchars($user_tweet['img']) . '" frameborder="0" allowfullscreen style="margin:0px;border-radius:20px;"></iframe>
        </div>';
    } else {
        
        echo '<div class="photo">
            <img src="../../public/images/users/' . htmlspecialchars($user_tweet['img']) . '" alt="Photo description" style="width:100%;height:500px;margin:0px;border-radius:20px;">
        </div>';
    }
    ?>
</div>

        <div class="dateTimeContainer" style="display:flex;">
         <p style="margin-left:30px;"><?php echo $time  ?></p>. .
         <p><?php echo $date ?></p>. .
         <p>2102 views</p> 
        </div>

<!--COMMENT START  -->
       
<div class="commentContainer" style="display:flex;justify-content:space-between;">
          <div class="comment" style="display:flex;">
          <a  onclick="commentPost(<?php echo $user_tweet['id'];?>)" id="user-comment-<?php echo $user_tweet['id']; ?>" data-bs-toggle="modal" data-bs-target="#comment" > <img src="../../public/images/message.svg" alt="" style="width: 30px; height:30px; border-radius: 50%;margin-left:5px; margin-right: 5px;"></a> 
    
          <p style="margin-top:5px;">1</p>
          </div>
  <!-- commentEnd -->



  <!-- comment script -->
  <script>
                  function  commentPost(postId) {
                    $.post('../View/modals/store_post_id.php', { posts_id: postId }, function(response) {
                console.log('Session post_id stored:', response);
            });
               var myModal = new bootstrap.Modal(document.getElementById('comment'));
                myModal.show();
               }
  </script>
           <!-- comment script end -->



         
<!-- COMMENT END -->

         <!-- RETWEET START -->


 <!--no of retweets  -->
 <?php 
        $post_id=$user_tweet['id'];
        $userRetweets= tweet::getRetweets($post_id);
        $totalRetweets=$userRetweets['retweetCount'];

        ?>


        <!-- no of retweets end -->
        

      <!-- retweet script -->
         <script>
           function  retweetPost(postId,totalRetweets) {
           // Send AJAX request
        $.post("../Ajax/retweet.php", { action: "retweet", post_id: postId },function(){
          totalRetweets = totalRetweets+1;
          $("#retweet-"+ postId).text(totalRetweets);
          })
            .done(function(response) {
                console.log("Server Response:", response);
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error:", textStatus, errorThrown); // Log any errors
            });
        }
         </script>
    <!-- retweet script end -->







        <!-- retweet -->
          <div class="retweet" style="display:flex;margin-right:15px;">
          <a   onclick="retweetPost(<?php echo $user_tweet['id'];?>,<?php echo $totalRetweets; ?>)"> <img id="twee-<?php echo $user_tweet['id']; ?>"  src="../../public/images/retweet.png" alt="" style="width: 30px; height:30px; border-radius: 50%;margin-left:5px; margin-right: 5px;"></a> 
          <p style="margin-top:5px;" id=retweet-<?php echo $user_tweet['id'];?>><?php echo $totalRetweets?></p>
          </div>
        <!-- retweetEnd -->


         

<!-- RETWEET END -->


  <!-- LIKE START -->

        
        <!--no of likes  -->
        <?php 
        $post_id=$user_tweet['id'];
        $userLikes= tweet::getUserLikes($post_id);
        $likes=$userLikes['likeCount'];

        ?>


        <!-- no of likes end -->


        <!-- like script -->
         <script>
           function  likePost(postId,likes) {
           // Send AJAX request
        $.post("../Ajax/like.php", { action: "like", post_id: postId },function(){
          likes= likes+1;
          $("#user-" + postId).attr("src", "../../public/images/likeSuccess.png");
          $("#like-" + postId).text(likes);
          })
            .done(function(response) {
                console.log("Server Response:", response);
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error:", textStatus, errorThrown); // Log any errors
            });
        }
         </script>
        <!-- like script end -->


        
        <!-- like -->
        
          <div class="like" style="display:flex;margin-right:15px;">
          <a   onclick="likePost(<?php echo $user_tweet['id'];?>,<?php echo $likes; ?>)"> <img id="user-<?php echo $user_tweet['id']; ?>"  src="../../public/images/like.png" alt="" style="width: 35px; height:35px; border-radius: 50%;margin-left:5px; margin-right: 5px;"></a> 
          <p style="margin-top:5px;" id=like-<?php echo $user_tweet['id']; ?>><?php echo $likes?></p>
          </div>



<!--LIKE END -->



          <div class="comment" style="display:flex;margin-right:15px;">
          <img src="../../public/images/threedots.svg" alt="" style="width: 25px; height:25px; border-radius: 50%;margin-left:5px; margin-right: 5px;">
          
          </div>

          
        </div>
      </div>
      <hr>
      <?php  }?>

      <!--  -->
      <!--  -->



      

<div class="container">
      <a class="nav-link active" href="#home">Back to top</a>
      </div>
      <!--  -->
      <div class="card-footer text-body-secondary" style="background-color: white;border:none;">
      <img src="../../public/images/twitterbird.jpg" alt="" style="width: 40px; height:40px; border-radius: 50%;margin-left:5px; margin-right: 10px;">
      </div>
      <!--  -->
    </div>
  </div>






<!-- Follow user -->
<script>
        function followUser(userId) {
            $.post("../Ajax/follow.php", {action: "follow", followed_id: userId}, function() {
                $("#follow-btn-" + userId).text("Following").attr("disabled", true);
            });
        }

        function loadNextUsers(offset) {
            $.post("../Ajax/next_user.php", {offset: offset}, function(data) {
                $("#who-to-follow").html(data);
            });
        }

        $(document).ready(function() {
            let offset = 0;

            $("#next-btn").click(function() {
                offset += 5;
                loadNextUsers(offset);
            });
        });
    </script>
    
  <div class="follow" style="flex: 1 1 300px; max-width: 25vw;">
    <div class="card" style="min-width:300px; position: -webkit-sticky;position: sticky;top:20px;">
      <div class="card-header" Style="display:flex;justify-content:center;">
        <h6> Who to follow</h6>
      </div>


      <?php 
    
      if(isset($users)){ ?>
    
        <?php foreach ($users as $user): ?>
          
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
        <div class="container" style="display:flex;justify-content:center;">
        <button type="button" class="btn btn-secondary"  id="next-btn" style="margin-bottom:10px;min-width:100px; width:150px;margin-left:5px;">Next</button>
        </div>
      </div>
    </div>
  

  <?php    }?>
  <!--  follow end-->



</div>

 
    



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>