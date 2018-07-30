<?php
   include('session.php');
   include('header.php');
   $error = "";
   $success = "";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
   		$postText = mysqli_real_escape_string($db,$_POST['text']);
   		$sqlPut = "INSERT INTO posts (postText, `time`, userID) VALUES('$postText', '".date('Y-m-d H:i:s')."', $id);";
      $sqlPut = "INSERT INTO privateMessages (fromID, toID, messageText, messageTime) VALUES($id, ".$_POST['toID'].", '$postText', '".date('Y-m-d H:i:s')."');";

   		if (!$postText) {
   			$error = "You need to write something before you can post it dumbass!";
   		}
      else if (!$_POST['toID']) {
        $error = "Select a user to send your message to.";
      }
   		else if(mysqli_query($db,$sqlPut)) {
   			$success = "Message sent successfully!";
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
                <h2 align="center" class="display-3">Private Messages</h1>
                <p class="lead">Welcome to the private message page, here you can tell people individually what you think of them.</p>
                <hr class="my-4">
                <form action = "" method = "post">
	                <div align = "center" class="form-group">
	                    <textarea class="form-control" id="exampleTextarea" name="text" placeholder="Say something :)" rows="3"></textarea><br />
                      <div class="form-group" name="toID">
                        <select name="toID" class="custom-select">
                          <option selected>Select a user</option>
                          <?php 
                          //$sql = "SELECT postID, postText, `time`, userID FROM posts;";
                          $sql = "SELECT id, firstName, lastName FROM admin;";
                          $result = mysqli_query($db,$sql);
                          while($row = mysqli_fetch_assoc($result)) {
                            if ($row['id'] != $id) {
                              echo '<option value="'.$row['id'].'">'.$row['firstName']. " " . $row['lastName'].'</option>';
                            }
                          }
                          ?>
                        </select>
                      </div>
	                    <input class="btn btn-primary btnjumbotron-lg" type = "submit" name = "sendMessage" value = " Send Message "/><br />
	                    <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div> 
		                  <div style = "font-size:11px; color:#27FF00; margin-top:10px"><?php echo $success; ?></div> 
	                </div>
            	</form>
              <p class="lead">Below is your private message stream:</p>
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
		        	$sql = "SELECT firstName, lastName, fromID, messageText, messageTime FROM privateMessages INNER JOIN admin ON (toID = id OR fromID = id) AND id <> $id WHERE fromID = $id OR toID = $id ORDER BY privateMessages.messageID DESC;";
	         		$result = mysqli_query($db,$sql);
	         		while($row = mysqli_fetch_assoc($result)) {
	         			echo "<div align = \"left\" class=\"card border-secondary mb-3\" >";

                echo '<div class="card-header">';
                if ($row['fromID'] == $id) {
                  echo "From: $firstName $lastName To: ".$row['firstName'] .' ' .$row['lastName'];
                }
                else {
                  echo "From: ".$row['firstName'] .' ' .$row['lastName']." To: $firstName $lastName ";
                }
	         			echo '<span style="float:right;">' . $row["messageTime"]. '</span></div>';
				        echo "<div class=\"card-body\">";
				        echo $row["messageText"];
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
