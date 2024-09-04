
<!-- Modal -->
<style>
        .preview-image {
            cursor: pointer;
            width: 100%;
            margin: 0;
            padding: 0;
            height: 200px;
            border-radius: 4px;
            background-color: cornflowerblue;
        }
        .preview-video {
            margin: 0;
            border-radius: 20px;
        }
        .hidden {
            display: none;
        }
    </style>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- script for tweet_error-->
    <?php  if (isset($_SESSION['tweet_errors'])) { ?>
        <script>  
  
             $(document).ready(function(){
        
        $("#tweet").modal('show');
       });
      </script>
          
          <?php } ?>  

<!--end of script for tweet_error -->
<div class="modal fade" id="tweet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <img src="../../public/images/twitterbird.jpg"  style="height:40px;width:60px;"alt="bird">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tweet</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!--tweet_errors -->
      <div class="modal-body">
                    <?php if (isset($_SESSION['tweet_errors']) && !empty($_SESSION['tweet_errors'])): ?>
                        <ul>
                            <?php foreach ($_SESSION['tweet_errors'] as $error): ?>
                        
                              <p style="font-size: 15px; color:red" class="text-center" > <?php echo $error ; ?> 
                               
                            <?php endforeach; ?>
                        </ul>

                        <?php
                         unset($_SESSION['tweet_errors']); ?>
                    <?php endif; ?>
              
                
            <!--tweet_errors-->
            <form action="../Controller/tweetController.php" method ="post"  enctype="multipart/form-data">
            <input type="hidden" name="tweet" id="tweet" value="1">

          <div class="container2">
            <textarea name="status" id="status" style="width:100%;height:160px;border:none;"placeholder="Add Text" value=""></textarea>
          

           <!-- / -->
           <div onclick="document.getElementById('tweetPost').click();">
           <img id="tweets" class="preview-image " alt="" style="object-fit: cover;">
           <iframe id="videoPreview" class="preview-video hidden" width="100%" height="315" frameborder="0" allowfullscreen></iframe>
            </div>
            <input type="file" id="tweetPost" name="tweetPost" accept="image/*,video/*" onchange="previewMedia(event)"style="display:none">
            </div>
            



          <!--  -->

          <div class="container3" style="display:flex;justify-content:center;margin-top:10px;">
            
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="margin-right:10px;">Close</button>
               <button type="Submit" class="btn btn-primary" style="width:140px;">Post</button>
              
          </div>
          </form>
      </div>

    </div>
  </div>
</div>



<script>
        function previewMedia(event) {
            const file = event.target.files[0];
            const imgElement = document.getElementById('tweets');
            const videoElement = document.getElementById('videoPreview');

            if (file) {
                const fileType = file.type;

                if (fileType.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imgElement.src = e.target.result;
                        imgElement.classList.remove('hidden');
                        videoElement.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                } else if (fileType.startsWith('video/')) {
                    const url = URL.createObjectURL(file);
                    videoElement.src = url;
                    videoElement.classList.remove('hidden');
                    imgElement.classList.add('hidden');
                }
            }
        }
    </script>
