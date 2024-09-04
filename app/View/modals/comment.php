<!-- Modal -->
<?php 
include_once '../Controller/tweetController.php';
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- script for comment_error-->
    <?php  if (isset($_SESSION['comment_errors'])) { ?>
        <script>  
  
             $(document).ready(function(){
        
        $("#comment").modal('show');
       });
      </script>
    
          
          <?php } ?>  

<!--end of script for comment error -->

<div class="modal fade" id="comment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel" style="margin-left:40%;">Add Comment</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"style="padding:0px;">

       <!--comment_errors -->
       <div class="modal-body">
                    <?php if (isset($_SESSION['comment_errors']) && !empty($_SESSION['comment_errors'])): ?>
                        <ul>
                            <?php foreach ($_SESSION['comment_errors'] as $error): ?>
                        
                              <p style="font-size: 15px; color:red" class="text-center" > <?php echo $error ; ?> 
                               
                            <?php endforeach; ?>
                        </ul>

                        <?php
                         unset($_SESSION['comment_errors']); ?>
                    <?php endif; ?>
                </div>
                
            <!-- comment_errors-->


   <?php
     

      $post_id=$_SESSION['posts_id'];
      $post_data=tweet::getPostData($post_id);

      $user_id=$post_data['user_id'];
      $user_data=tweet::getUserData($user_id);
   
   ?>







        <div class="grid-share" style="display: flex; padding-top: 5px;" id="who-to-follow">
        <img src="../../public/images/users/<?php echo  $user_data['img']; ?>"alt="" style="width: 50px; height: 50px; border-radius: 50%;margin-left:5px; margin-right: 10px;">
                              <div>
                                <strong><?php echo $user_data['name']; ?></strong>
                                <p> <?php $user_data['username'] ?></p>
                              </div>
    
                              </div>

                              <textarea name="status" id="status" style="width:100%;height:80px;border:none;"value=""><?php echo $post_data['status'] ?></textarea>

                              <textarea name="status" id="status" style="width:100%;height:160px;border:none;"placeholder="Add Comment" value=""></textarea>
      

       </div>
       <div class="container" style="display:flex;justify-content:center;margin-bottom:20px;">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="width:150px;max-width:150px;margin-right:10px;">Close</button>
       <button type="submit" class="btn btn-primary" style="width:150px;max-width:150px">Submit</button>
      
       </div>
      </div>
    </div>
  </div>





