<!-- this is the main website page-->
<!-- Usually hidden, so it will redirect to the login page-->

<?php 	
	//this allows you to access session on any page
	session_start();	
		//in cluding files we need
		include("connection.php"); //establishes the connection to the db
		include("functions.php"); //holds all the helper functions used
		
		//this will check if user is logged in (created in "function.php")
		//then it will collect user's data into "$user_data". 
		//it takes in a connection to the database ($con)
		$user_data = check_login($con);
		$userName = $user_data['name'];
		date_default_timezone_set('America/New_York');
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Comments Page</title>

 	<style type="text/css">
 		
 		.color{
 			background-color: #ddd;
 			width: 600px;
 			padding: .5px;
 		}


 		.navbar {
		  overflow: hidden;
		  background-color: #333;
		  position: sticky;
		  position: -webkit-sticky;
		}	

		/* Style the navigation bar links */
		.navbar a {
		  float: left;
		  display: block;
		  color: white;
		  text-align: center;
		  padding: 15px 25px;
		  text-decoration: none;
		}
		
		/* Change color on hover */
		.navbar a:hover {
		  background-color: #ddd;
		  color: black;
		}

		/* Active/current link */
		.navbar a.active {
		  background-color: #666;
		  color: white;
		}

		/* Right-aligned link */
		.navbar a.right {
		  float: right;
		}

		.comment-box{
			width: 550px;
			padding: 8px;
			margin-bottom: 4px;
			background-color: lightgrey;
			border-radius: 4px;
			position: relative;
		}

		.comment-box p{
			font-family: arial;
			font-size: 14px;
			line-height: 16px;
			color: #282828;
			font-weight: 100;
		}

		/* Style for editing comment forms */
		.edit-form{
			position: absolute;
			top: 0px;
			right: 0px;
		}

		.edit-form button{
			width: 40px;
			height: 20px;
			color: #282828;
			background-color: transparent;
			border-style: none;
			opacity: 0.7;
		}

		/* Change opacity on hover */
		.edit-form button:hover{
			opacity: 1;
		}


		/* Style for deleting comment forms */
		.delete-form{
			position: absolute;
			top: 0px;
			right: 60px;
		}

		.delete-form button{
			width: 40px;
			height: 20px;
			color: #282828;
			background-color: transparent;
			border-style: none;
			opacity: 0.7;
		}

		.delete-form button:hover{
			opacity: 1;
		}

 	</style>

 </head>
 <body>
 	
	<div class="navbar">
	  <a href="index.php">College Events</a>
	  <a href="newRSO.php">Request New RSO</a>
	  <a href="joinRSO.php">Join an RSO</a>
	  <a href="newEvent.php">Create an Event</a>
	  <a href="eventComments.php" class="active">Event Comments</a>
	  <a href="uniProfile.php">University Profiles</a>
	  <a href="account.php"> <?php echo $user_data['name']; ?>'s Account</a>	
	  <a href="logout.php" class="right">Logout</a>

	</div><br>	
 	

 	<?php
	echo "
	<div class='color'>
 		<h2>Select An Event To Leave A Comment:</h2>
 	</div>	

		<form method='POST' action='".setComments($con)."'>
				<input type='hidden' name='user_id' value='".$user_data['name']."'>
		 		<input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'><br>
		 		
		 		<select name='event'>
					<option selected disabled hidden>Select Event</option>";			
					  	$records = mysqli_query($con,"SELECT name FROM events WHERE approved='Yes'");
						while($rows = mysqli_fetch_array($records)){
							$event = $rows['name'];
							echo "<option value='$event'> $event </option>";
						}		
		echo   "</select> <br><br>
				<textarea name='message'></textarea>
		 		<button type='submit' name='commentSubmit'>Comment</button>
	 		</form>";

 		echo "<br>

 		
 		<h2>Event Comments:</h2>";

 		$query = "SELECT * FROM events WHERE approved='Yes'"; 
		$result = mysqli_query($con,$query); //reading from the db			
		if(mysqli_num_rows($result) > 0){ 
			//instance found
			while($data = mysqli_fetch_assoc($result)){
				//going through all event names in database
				echo "<div class='color'>";
					print "<h3><u>" . $data['name'] . "</u></h3>";	
					getComments($con,$data['name'],$userName);					
				echo "</div>";
				echo "<br>";		
			}
		}
 	?>


 </body>
 </html>