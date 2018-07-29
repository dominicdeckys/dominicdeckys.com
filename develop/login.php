<?php
   include("config.php");
   session_start();
   $passwordClass = "form-control";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id FROM admin WHERE username = '$myusername' and passcode = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      $success = "";
      
      if (!$myusername || !$mypassword) {
         $error = "Please complete all fields!";
      }
      // If result matched $myusername and $mypassword, table row must be 1 row
		else if(isset($_POST['login'])) {
         if($count == 1) {
         // session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: welcome.php");
         }else {
            $error = "Your Login Name or Password is invalid";
            $passwordClass = "form-control is-invalid";
         }
      }
      else {
         if($count != 0) {
            $error = "An account with that username already exists, choose another!";
         }
         else {
            $sqlPut = "INSERT INTO admin (username, passcode) VALUES ('$myusername', '$mypassword')";
            if(!mysqli_query($db,$sqlPut)) {
               $error = "SQL Internal Server Error";
            }
            else {
               $success = "Successfully created account with username $myusername";
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

   <div class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
      <div class="container"><div class="valid-feedback">Success! You've done it.</div>
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
               <label>UserName  :</label><input type = "text" name = "username" class = "form-control"/><br /><br />
               <label>Password  :</label><input type = "password" name = "password" class="<?php echo $passwordClass; ?>" /><br/><br />
               <div style="text-align: center;">
                  <input class="btn btn-secondary" type = "submit" name = "login" value = " Login "/><br />
                  <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div> 
                  <input class="btn btn-secondary" type = "submit" name = "newaccount" value = " Create New Account "/><br />
                  <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $success; ?></div> 
               </div>
            </form>
          </div>
        </div>
     </div>

   </body>
</html>
