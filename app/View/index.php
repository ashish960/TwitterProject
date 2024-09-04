<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../../public/Css/index.css" rel="stylesheet">

    
  </head>
  <body>
    <?php
     session_start();
    //  if(isset($_SESSION)){
    //   var_dump($_SESSION['signup_errors']);
    //   }
     
    ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>


<!-- script for signup error popup -->
    <?php  if (isset($_SESSION['signup_errors'])) { ?>
        <script>  
  
             $(document).ready(function(){
        
        $("#signup").modal('show');
       });
      </script>
          
          <?php } ?>  

<!--end of script for signup error popup -->

<!-- script for login error popup -->
<?php  if (isset($_SESSION['login_errors'])) { ?>
        <script>  
  
             $(document).ready(function(){
        
        $("#exampleModal").modal('show');
       });
      </script>
          
          <?php } ?>  

<!--end of script for login error popup -->



    <div class="container1">
        <div class="twitterImgContainer">

                   <div class="features">
                      <div class="insideFeature">
                          <img class="twt-icon" src='https://image.ibb.co/bzvrkp/search_icon.png'>
                          <p>Follow your interests.</p></div>
                          <div class="insideFeature">
                          <img class="twt-icon" src="https://image.ibb.co/mZPTWU/heart_icon.png">
                          <p>Hear what people are talking about.</p></div>
                          <div class="insideFeature">
                          <img class="twt-icon" src="https://image.ibb.co/kw2Ad9/conv_icon.png">
                          <p>Join the conversation.</p></div>
                 </div>
        </div>

        <div class="twitterDataContainer">
          <img src="../../public/images/twitterbird.jpg"  style="height:80px;width:100px;"alt="bird">
          <div class="heading">
          <span> <h1>See what's happening in the world right now</h1></span>
          <br>
          <br>
          <h2>Join Twitter today.</h2>
          </div>
          <button type="button" style="display:block ;margin:20px; border-radius:40px;width:70%"class="btn btn-primary" data-bs-toggle="modal"  data-bs-target="#signup">Sign Up</button>
          <button type="button" style="display:block ;margin:20px; border-radius:40px;width:70%;color:black;background-color:#B7B9B1;" data-bs-toggle="modal"  data-bs-target="#exampleModal" class="btn btn-light">Log in</button>
        </div>
    
      </div>
            <!-- login -->
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                  <img src="../../public/images/twitterbird.jpg"  style="height:80px;width:100px;"alt="bird">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Log in to Twitter</h1>
                    
                  </div>
                  <div class="modal-body">
                       
            <!--login_error display -->
              <div class="modal-body">
                    <?php if (isset($_SESSION['login_errors']) && !empty($_SESSION['login_errors'])): ?>
                     <script>console.log("hello");</script> 
                        <ul>
                            <?php foreach ($_SESSION['login_errors'] as $error): ?>
                              <p style="font-size: 15px; color:red" class="text-center" > <?php echo $error ; ?> 
                            <?php endforeach; ?>
                        </ul>

                        <?php
                         unset($_SESSION['login_errors']); ?>
                    <?php endif; ?>
                </div>
                
            <!-- end login_error display -->

                    
                  <form action="../Controller/UserController.php" method="post">
                        <input type="hidden" name="login" value="1">

                     <div class="mb-3">
                       <label for="exampleInputEmail1" class="form-label">Email address</label>
                       <input type="email" class="form-control" id="userEmail" name="userEmail" aria-describedby="emailHelp">
                     </div>
                     <div class="mb-3">
                       <label for="exampleInputPassword1" class="form-label">Password</label>
                       <input type="password" class="form-control" name="userPassword" id="userPassword">
                     </div>                
                        <div class="mb-3 form-check"  style="display:inline-block;">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1" style="display:block;">Remember Me</label>
                      </div>
                          <a href="" style="margin-left:2px;">Forgot Password?</a>
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius:40px; margin-left:50px;">Close</button>
                          <button type="submit" class="btn btn-primary" style="border-radius:20px; min-width:80px;">Log  In</button>
                          <footer style="margin:0px;padding:0px;">
                      <p style="margin:0px;padding:0px;" >New To Twitter?<a href="">Sign up now >></a></p>
                      </footer>
                      </form>
                      
                   
                  </div>
                  </div>
                </div>
              </div>
            </div>
 
            
            <!-- login end -->



          <!-- Signup -->
           <!-- Modal -->
           <div class="modal fade" id="signup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                  <img src="../../public/images/twitterbird.jpg"  style="height:80px;width:100px;"alt="bird">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="margin-left:50px;">Create Your Account</h1>
                    
                  </div>
                  <div class="modal-body">

               <!--signup_error display -->
                  <div class="modal-body">
                    <?php if (isset($_SESSION['signup_errors']) && !empty($_SESSION['signup_errors'])): ?>
                     <script>console.log("hello");</script> 
                        <ul>
                            <?php foreach ($_SESSION['signup_errors'] as $error): ?>
                              <p style="font-size: 15px; color:red" class="text-center" > <?php echo $error ; ?> 
                               
                            <?php endforeach; ?>
                        </ul>

                        <?php
                         unset($_SESSION['signup_errors']); ?>
                    <?php endif; ?>
                </div>
                
                <!-- end signup_error display -->
            
                    
                  <form action="../Controller/UserController.php" method="post">
                     <input type="hidden" name="signup" value="1">
                     <div class="mb-3">
                       <label for="name" class="form-label">Name</label>
                       <input type="text" class="form-control" id="names" name= "names" aria-describedby="names">
                       
                     </div>
                     <div class="mb-3">
                       <label for="exampleInputPassword1" class="form-label">Phone No</label>
                       <input type="number" class="form-control" id="phoneno" name="phoneno">
                     </div> 
                     <div class="mb-3">
                       <label for="exampleInputPassword1" class="form-label">email</label>
                       <input type="email" class="form-control" id="email" name="email">
                     </div> 
                     <div class="mb-3">
                       <label for="exampleInputPassword1" class="form-label">Password</label>
                       <input type="password" class="form-control" id="passwords" name="passwords">
                     </div>        
                     <div class="mb-3">
                       <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                       <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                     </div>              
                        <div class="buttonContainer" style="display:flex; justify-content:end;">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius:40px; margin-left:50px;min-width:150px;">Close</button>
                          <button type="submit" class="btn btn-primary" style="border-radius:20px; min-width:150px; margin-left:10px;">Sign Up</button>
                          </div>
                      </form>
                      
                   
                  </div>
                  </div>
                </div>
              </div>
            </div>
 
            
            <!-- Signup end -->




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    

  </body>
</html>