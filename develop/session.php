<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select id,username,firstName,lastName,favoriteColor from admin where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

   $firstName = $row['firstName'];
   $lastName = $row['lastName'];
   $favoriteColor = $row['favoriteColor'];
   
   $username = $row['username'];
   $id = $row['id'];

   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
?>
