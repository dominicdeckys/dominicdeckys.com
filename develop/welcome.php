<?php
   include('session.php');
   include('header.php');
   $error = "";
   $success = "";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
   		$postText = mysqli_real_escape_string($db,$_POST['text']);
   		$sqlPut = "INSERT INTO posts (postText, `time`, userID) VALUES('$postText', '".date('Y-m-d H:i:s')."', $id);";

   		if (isset($_POST['delID'])) {
   			$sqlDel = "DELETE FROM posts WHERE postID=".$_POST['delID'].";";
   			if(mysqli_query($db,$sqlDel)) {
   				$success = "Post deleted successfully";
   			}
   			else {
   				$error = "SQL Internal Server Error";
   			}
   		}
   		else if (!$postText) {
   			$error = "You need to write something before you can post it dumbass!";
   		}
   		else if(mysqli_query($db,$sqlPut)) {
   			$success = "Post successful!";
   		}
   		else {
   			$error = "SQL Internal Server Error";
   		}
   }
?>
<html">
   
   <head>
      <title>Dom's Social Network</title>
   </head>

   <body>
   		<div>
    <p>
      <br /><br /><br />
    </p>
    </div>
    <div class="container">
    <div class="row">
          <div class="col-lg-12">
            <div align="center" class="page-header">
              <!--<h1 id="containers">Yay</h1> -->
            </div>
            <div class="bs-component">
              <div class="jumbotron">
                <h2 align="center" class="display-3">Welcome, <?php echo $firstName; ?>!</h1>
                <p class="lead">Welcome to the homepage, add a post for your friends to see! More functionality coming soon!</p>
                <hr class="my-4">
                <form action = "" method = "post">
	                <div align = "center" class="form-group">
	                    <textarea class="form-control" id="exampleTextarea" name="text" placeholder="Say something :)" rows="3"></textarea><br />
	                    <input class="btn btn-primary btnjumbotron-lg" type = "submit" name = "createPost" value = " Create Post "/><br />
	                    <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div> 
		                  <div style = "font-size:11px; color:#27FF00; margin-top:10px"><?php echo $success; ?></div> 
	                </div>
            	</form>

            	<!--
                <p>TODO: add posts here :).</p>
                <p class="lead">
                  <a class="btn btn-primary btnjumbotron-lg" href="#" role="button">This button does nothing</a>
                </p>
            	-->
              </div>
            </div>
		        <?php 
			        //$sql = "SELECT postID, postText, `time`, userID FROM posts;";
		        	$sql = "SELECT posts.postID,admin.id, posts.postText, posts.`time`, admin.firstName, admin.lastName FROM posts INNER JOIN admin ON admin.id = posts.userID ORDER BY posts.postID DESC";
	         		$result = mysqli_query($db,$sql);
	         		while($row = mysqli_fetch_assoc($result)) {
	         			echo "<div align = \"left\" class=\"card border-secondary mb-3\" >";
	         			echo '<div class="card-header">' . $row["firstName"] . " " . $row["lastName"] . '<span style="float:right;">' . $row["time"];
	         			if ($row['id'] == $id) {
	         				echo '   <form style="display:inline" action = "" method = "post"><input type="hidden" name="delID" value='.$row['postID'].'></input><input type="submit" class="btn btn-danger" value="Delete"></input></form>';
	         			}
				        echo "</span></div><div class=\"card-body\">";
				        echo $row["postText"];
				        echo "</div></div>";
				    }
		        ?>
          </div>
        </div>
    </div>
   </body>
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>
