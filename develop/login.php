<?php
   include("config.php");
   session_start();
   $passwordClass = "form-control";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 


      
      $myusername = mysqli_real_escape_string($db,$_POST['email']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 


      if (!$myusername || !$mypassword) {
         $error = "Please complete all fields!";
      }
      else if (isset($_POST['newaccount'])) {
         $_SESSION['temp_user'] = $myusername;
         $_SESSION['temp_pass'] = $mypassword;
         header('Location: createaccount.php'); 
         exit();
      }
      else {
      
         $sql = "SELECT id FROM admin WHERE username = '$myusername' and passcode = '$mypassword'";
         $result = mysqli_query($db,$sql);
         $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
         $active = $row['active'];
         
         $count = mysqli_num_rows($result);
         $success = "";
         // If result matched $myusername and $mypassword, table row must be 1 row
   		if(isset($_POST['login'])) {
            if($count == 1) {
               // session_register("myusername");
               $_SESSION['login_user'] = $myusername;
               
               header("location: welcome.php");
            }else {
               $error = "Your Login Name or Password is invalid. If you forgot your password, that sucks!";
               $passwordClass = "form-control is-invalid";
            }
         }
      }  
   }
?>
<html>
   
   <head>
      <title>Login Page</title>
      
      <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="css/bootstrap.min.css">
      
   </head>
   
   <body bgcolor = "#FFFFFF">

    <div class="container">
         <div class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
            <div class="container">
                 <a href="" class="navbar-brand">Dom's Social Network</a>
                 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                   <span class="navbar-toggler-icon"></span>
                 </button>
                 <div class="collapse navbar-collapse" id="navbarResponsive">

                      <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item">
                          <a class="nav-link" href="">Login</a>
                        </li>
                      </ul>

                 </div>
           </div>
         </div>
       <div>
          <p>
            <br /><br /><br />
          </p>
       </div>

       <div align = "center">
          <div align = "left" class="card border-secondary mb-3" style="max-width: 20rem;">
             <div class="card-header">Login</div>
             <div class="card-body">
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "email" class = "form-control"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class="<?php echo $passwordClass; ?>" /><br/><br />
                  <div style="text-align: center;">
                     <input class="btn btn-secondary" type = "submit" name = "login" value = " Login "/><br />
                     <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div> 
                     <input class="btn btn-secondary" type = "submit" name = "newaccount" value = " Create New Account "/><br />
                     <div style = "font-size:11px; color:#27FF00; margin-top:10px"><?php echo $success; ?></div> 
                  </div>
               </form>
             </div>
           </div>
        </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   </body>
</html>
