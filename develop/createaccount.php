<?php
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {


      $myusername = $_SESSION['temp_user'];
      $mypassword = $_SESSION['temp_pass'];
      $firstName = mysqli_real_escape_string($db,$_POST['firstName']);
      $lastName = mysqli_real_escape_string($db,$_POST['lastName']);
      $favoriteColor = mysqli_real_escape_string($db,$_POST['favoriteColor']);

      $sql = "SELECT id FROM admin WHERE username = '$myusername'";

      if (!$myusername || !$mypassword || !$firstName || !$lastName || !$favoriteColor) {
         $error = "Please complete all fields or kindly fuck off!";
      }
      else if (mysqli_num_rows(mysqli_query($db,$sql)) != 0){
        $error = "An account with this email address already exists. If you forgot your password, that sucks!";
      }
      else {
        $sqlPut = "INSERT INTO admin (username, passcode, firstName, lastName, favoriteColor) VALUES ('$myusername', '$mypassword', '$firstName', '$lastName', '$favoriteColor')";
        if(!mysqli_query($db,$sqlPut)) {
            $error = "SQL Internal Server Error";
         }
         else {
            $success = "Successfully created account with username $myusername";
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
    <div class="container">
        <a href="login.php" class="navbar-brand">Dom's Social Network</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="nav navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
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
          <div class="card-header">Create New Account</div>
          <div class="card-body">
            <div align = "center">
              Already have an account?
              <a href="login.php">
                 <input class="btn btn-secondary" type = "submit" name = "returnToLogin" value = " Return to Login Page "/><br /><br />
              </a>
            </div>
            <form action = "" method = "post">
               <label>Email  :</label><input type = "text" name = "email" class = "form-control" placeholder="<?php echo $_SESSION['temp_user']; ?>" disabled=""/><br /><br />
               <label>Password  :</label><input type = "password" name = "password" class="form-control" placeholder="<?php echo $_SESSION['temp_pass']; ?>" disabled="" /><br/><br />
               <label>First Name  :</label><input type = "text" name = "firstName" class = "form-control"/><br /><br />
               <label>Last Name  :</label><input type = "text" name = "lastName" class = "form-control"/><br /><br />
               <label>Favorite Color  :</label><input type = "text" name = "favoriteColor" class = "form-control"/><br /><br />
               <div style="text-align: center;">
                  <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div> 
                  <input class="btn btn-secondary" type = "submit" name = "newaccount" value = " Create New Account "/><br />
                  <div style = "font-size:11px; color:#27FF00; margin-top:10px"><?php echo $success; ?></div> 
               </div>
            </form>
          </div>
        </div>
     </div>
  </body>
  </html>