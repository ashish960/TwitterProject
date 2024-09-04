<?php
 session_start();
 include_once 'modals/editProfile.php';
 include_once 'modals/tweet.php';
 include_once '../Controller/ProfileController.php';
 include_once '../Controller/tweetController.php';
 include_once '../Controller/followController.php';
 include_once '../Controller/likeController.php';
 include_once '../View/modals/comment.php';
 include_once '../View/modals/store_post_id.php';
 

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
  
  $controller = new follow;
 $users= $controller->whoToFollow();
?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../../public/Css/media.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
  </head>
  <body style="background-color:#EBEBEB;">
    


    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary"Style="margin:0px;padding:0px;">
  <div class="container-fluid">
   
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class ="nav-item">
        <img src="../../public/images/tweethome.png" alt="" height="23px" width="23px" style="margin-left:3px"/>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php" id="home">Home</a>
        </li>

        <li class ="nav-item">
        <img src="../../public/images/moments.png" alt="" height="26px" width="26px" style="margin-left:3px" />
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Moments</a>
        </li>

        <li class ="nav-item">
        <img src="../../public/images/tweetnotif.png" alt="" height="23px" width="23px"style="margin-left:5px" />
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Notifications</a>
        </li>

        <li class ="nav-item">
        <img src="../../public/images/message.png" alt="" height="23px" width="23px"style="margin-left:5px" />
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Messages</a>
        </li>
      </ul>
      <img src="../../public/images/users/<?php echo  $user['img']; ?>"  alt="" style="width: 40px; height: 40px; border-radius: 50%;margin-left:5px; margin-top:0px;margin-right: 10px;">
      <form class="d-flex" role="search" >
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"style="margin-top:15px;">
        <button class="btn btn-outline-success" type="submit" style="margin-top:15px;">Search</button>
      </form>
    </div>
     <!-- logoutbutton -->
     <form  action="../Controller/logoutController.php" method="POST" >
            <input type="submit" name="logout" value="Logout"  class="btn btn-outline-Danger" style="margin-left:15px;margin-top:15px;">
          </form>
      
   <!-- LOGOUTBUTTON -->

  </div>
</nav>
    <!-- navbar end -->
     <div class="profilecontainer" style="margin:0px;padding:0px;height:220px;background-color:cornflowerblue;">
     <img src="../../public/images/users/<?php echo  $user['imgCover']; ?>" alt="" style="margin:0px;padding:0px;height:220px;width:100%">
     </div>
<!-- navbar2 -->
     
 <nav class="navbar navbar-expand-lg bg-body-tertiary" style="height: 60px;">
    <div class="container-fluid"class="abc"  id="abc"; style="min-width:500px;padding:0px;">
        <a class="navbar-brand" href="#">
        <img src="../../public/images/users/<?php echo  $user['img']; ?>" alt="" style="width:160px;height:160px;border-radius:50%;position:relative;bottom:40px;left:30px;">
        </a>
        <div id="tweetLists" class="tweetLists" style=display:flex;min-width:200px;>
            <ul class="abc2" style="display:flex;list-style-type: none;padding-left:0px;">
                <li class="nav-item">
                    <a class="nav-link active" href="" data-bs-toggle="modal"  data-bs-target="#tweet" >Tweet</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#" style="margin-left: 20px;">Lists</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#" style="margin-left: 20px;">Moments</a>
                </li>
            </ul>
        </div>
        <div class=navButton class="d-flex justify-content-end"style="min-width:80px;">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editProfile" style="min-width:50px;margin-right:20px;" >Edit Profile</button>
        </div>
    </div>
</nav>


<!-- navbar2 end -->

<div class="contentContainer" style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; padding: 20px;">

  <div class="profile" style="flex: 1 1 300px; max-width: 200px;">
    <div class="card" style="width: 100%; border: none; border-radius: 0px; background-color: #EBEBEB;">
      <div class="card-body">
        <h5 class="card-title" style="margin-left: 1rem;"><?php echo $user['name']?></h5>
        <h6 class="card-subtitle mb-2 text-body-secondary"style="margin-left: 1rem;"><?php echo $user['username'] == null ? "@username" : "@" . $user['username'];?></h6>

      </div>
    </div>
  </div>

  <div class="tweet" style="flex: 1 1 400px; max-width: 55vw;min-width:400px;">
    <div class="card text-center" style="border: none; border-radius: 8px; margin-top: 4px;">
      <div class="card-header" style=" display:flex;background-color: white;">
        <Strong >Tweets</Strong>
        <Strong style="color:#0F92C7;margin-left:30px;">Tweets & replies</Strong>
      </div>
      <!--  -->
      <!--  -->



      <?php foreach($user_tweets as $user_tweet){ 
        //for date and time format
        $createdAt = new DateTime($user_tweet['created_at']);
        $time= $createdAt->format('h:i A');
        $date = $createdAt->format('M j, Y');
      
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
          <textarea name="" id=""style="margin:0px;padding:5px;width:100%;max-height:200px;border:none;outline:none;" readonly><?php echo $user_tweet['status'] ?></textarea>
        </div>
        <div class="container">
    <?php

    $fileExtension = pathinfo($user_tweet['img'], PATHINFO_EXTENSION);
    $videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv'];
    if(!empty($user_tweet['img'])){
    if (in_array(strtolower($fileExtension), $videoExtensions)) {
        echo '<div class="video">
            <iframe width="100%" height="315" src="../../public/videos/' . htmlspecialchars($user_tweet['img']) . '" frameborder="0" allowfullscreen style="margin:0px;border-radius:20px;"></iframe>
        </div>';
    } else {
        
        echo '<div class="photo">
            <img src="../../public/images/users/' . htmlspecialchars($user_tweet['img']) . '" alt="Photo description" style="width:100%;height:500px;margin:0px;border-radius:20px;">
        </div>';
    }
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
          <a  onclick="commentPost(<?php echo $user_tweet['id'];?>)" id="user-comment-<?php echo $user_tweet['id']; ?>"  > <img src="../../public/images/message.svg" alt="" style="width: 30px; height:30px; border-radius: 50%;margin-left:5px; margin-right: 5px;"></a> 
    
          <p style="margin-top:5px;">1</p>
          </div>
  <!-- commentEnd -->



  <!-- commentscript -->
  <script>
                  function  commentPost(postId) {
                    $.post('../View/modals/comment.php', { posts_id: postId }, function(response) {
                console.log('Session post_id stored:', response);
            }).done(function(response){
              console.log("Server Response:", response);
              var myModal = new bootstrap.Modal(document.getElementById('comment'));
              myModal.show();
             
            })
              
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
                 <a   onclick="retweetPost(<?php echo $user_tweet['id'];?>,<?php echo $totalRetweets; ?>)"> <img id="retwee-<?php echo $user_tweet['id']; ?>"  src="../../public/images/retweet.png" alt="" style="width: 30px; height:30px; border-radius: 50%;margin-left:5px; margin-right: 5px;"></a> 
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
      <?php 
     }?>

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
                                  let offset = 5;
                      
                                  $("#next-btn").click(function() {
                                      offset += 5;
                                      loadNextUsers(offset);
                                  });
                              });
                          </script>
                          
                        <div class="follow" id="follows" style="flex: 1 1 300px; max-width: 25vw;">
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
                                <strong><?php echo $user['name']; ?></strong>
                                <p>@<?php echo $user['username']; ?></p>
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