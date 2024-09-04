<!-- Modal -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- script for profile_update_error-->
    <?php  if (isset($_SESSION['profile_update_errors'])) { ?>
        <script>  
  
             $(document).ready(function(){
        
        $("#editProfile").modal('show');
       });
      </script>
          
          <?php } ?>  

<!--end of script for profile update error -->

<div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel" style="margin-left:40%;">Edit Profile</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"style="padding:0px;">

       <!--profile_update_errors -->
       <div class="modal-body">
                    <?php if (isset($_SESSION['profile_update_errors']) && !empty($_SESSION['profile_update_errors'])): ?>
                        <ul>
                            <?php foreach ($_SESSION['profile_update_errors'] as $error): ?>
                        
                              <p style="font-size: 15px; color:red" class="text-center" > <?php echo $error ; ?> 
                               
                            <?php endforeach; ?>
                        </ul>

                        <?php
                         unset($_SESSION['profile_update_errors']); ?>
                    <?php endif; ?>
                </div>
                
            <!-- profile_update_errors-->










        <form action="../Controller/ProfileController.php" method ="post"  enctype="multipart/form-data">
    
       <div class="container"style="padding:0px">
       <input type="hidden" name="editProfile" value="1">
       
  <!-- / -->
            <div onclick="document.getElementById('previewImageInput').click();">
                <img id="profilePreview" class="preview-image" alt="" src=""style="cursor:pointer; width:100%;margin:0px;padding:0px;height:200px;border-radius:4px;background-color:cornflowerblue;">
            </div>
            <input type="file" id="previewImageInput" name="profilePreview" accept="image/*" onchange="previewImage(event, 'profilePreview')"style="display:none">
        
  <!--  -->
        <!-- / -->
        <div onclick="document.getElementById('profileImageInput').click();">
             <img  id="profileImage" class="profile-image" src="../../public/images/twitterbird.jpg" alt="" style="cursor:pointer;width:160px;height:160px;border-radius:50%;position:relative;bottom:40px;left:30px;">
              
            </div>
            <input type="file" id="profileImageInput" name="profileImage" accept="image/*" onchange="previewImage(event, 'profileImage')"style="display:none">
        </div>
  <!--  -->
        <div class="nameContainer"style="margin:10px;">
          <p>Enter Name</p>
          <input type="text" id="profileName" name="profileName" style="width:100%">
        </div>
        <div class="bioContainer"style="margin:10px;" >
          <p>Bio</p>
        <input type="text"id="bio" name="bio" style="width:100%">
        </div>
       
        <div class="websiteContainer"style="margin:10px;">
          <p>Website</p>
        <input type="text" id="website" name="website" style="width:100%">
        </div>
        
        <div class="locationContainer"style="margin:10px;">
          <p>Location</p>
          <input type="text" id="location" name="location"  style="width:100%">
        </div>
       </div>
       <div class="container" style="display:flex;justify-content:center;margin-bottom:20px;">
       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="width:150px;max-width:150px;margin-right:10px;">Close</button>
       <button type="submit" class="btn btn-primary" style="width:150px;max-width:150px">Save changes</button>
      
       </div>
      </div>
    </div>
  </div>
  </form>





<script>
        function previewImage(event, previewId) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById(previewId);
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }      
        }
</script>