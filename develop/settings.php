<?php
   include('session.php');
?>
<html">
   
   <head>
      <title>Dom's Social Network</title>
      <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="css/bootstrap.min.css">
   </head>
   
   <div class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
      <div class="container">
        <a href="welcome.php" class="navbar-brand">Dom's Social Network</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">

          <ul class="nav navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="settings.php">Settings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          </ul>

        </div>
      </div>
    </div>

   <body>
   		<div>
    <p>
      <br /><br /><br />
    </p>
    </div>


    <div class="container">
    <div class="row">
          <div class="col-lg-12">
            <div class="bs-component">
              <div align="center" class="jumbotron">
                <h2 align="center" class="display-3">Setting</h1>
                <p align="center" class="lead">Modify your settings here.</p>
                <hr class="my-4">
                <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                <p class="lead">
                  <a class="btn btn-primary btnjumbotron-lg" href="#" role="button">Learn more</a>
                </p>
              </div>
            </div>
          </div>
        </div>
    </div>
   </body>
   
</html>
