<?php

	//this is needed for pages that validate if a user is logged-in
	session_start();
		//in cluding files we need
		include("connection.php"); //establishes the connection to the db
		include("functions.php"); //holds all the helper functions used

		$user_data = check_login($con);

		//checking if user clicked on the post ("Request") button
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			
			//something was posted. thus, collecting what was posted
			$rso_name = $_POST['rso_name'];
			$description = $_POST['description'];
			$user_name = $user_data['name'];
			$user_id = $user_data['user_id'];

			//making sure that fields are !empty
			if(!empty($rso_name) && !empty($description)){

				$query = "SELECT * FROM organizations WHERE rso_name='$rso_name'";
				$result = mysqli_query($con,$query);
				//check if organization name already exists in database
				if ($result) {
				  if (mysqli_num_rows($result) > 0) {
				  	//found in database
				    echo "<script type='text/javascript'> alert('Sorry. That organization already exists.'); location.href='newRSO.php';</script>";
				  } else {
				  	//not found in database
				  	//save information to database by values and columns - set number of members = 1.
					$query1 = "INSERT into organizations (rso_name,description,user_name,user_id,members) 
					VALUES ('$rso_name','$description','$user_name','$user_id','1')";					
					mysqli_query($con,$query1); //saving...


					//updating the user's rso list 
					$query2 = "SELECT followingRSOs FROM users WHERE user_id='$user_id'";
					$result2 = mysqli_query($con,$query2); //reading from the db						
					if (mysqli_num_rows($result2) > 0) {
						$temp = mysqli_fetch_assoc($result2);
						$string = $temp['followingRSOs'];
						$updated = $string . " " . $rso_name; //appending
					}	
					else{
						echo "empty";
						//no RSOs - add first
						$updated = $rso_name; //appending
					}		
					
					$sql = "UPDATE users SET followingRSOs='$updated' WHERE user_id='$user_id'";			
					mysqli_query($con, $sql); //saving...	
					//created successfuly 					
					echo "<script type='text/javascript'> alert('Organization has been created.'); location.href='newRSO.php';</script>";
				  }

				} else {
				  echo 'Error: '.mysql_error();
				}

			}else{
				//nothing was entered
				echo "<script type='text/javascript'> if (confirm('please enter vaild inforation')) {location.href='newRSO.php';}</script>";
			}
		}
?>

<!DOCTYPE html>
<html>
<head>
	<title>New RSO Page</title>
</head>
<body>
	<style type="text/css">		
		/*styling for text boxes*/
		#text{
			height: 25px;
			border-radius: 5px;
			padding: 5px;
			border: solid thin #aaa;
			width: 80%;
		}
		/*styling for login button*/
		#button{
			padding: 10px;
			width: 100px;
			color: white;
			background-color: grey;
			border: none;
		}
		/*styling for main box*/
		#box{
			background-color: lightgrey;
			margin: auto;
			width: 350px;
			padding: 20px;
		}

		/*styling for top navigation bar*/
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

	</style>

	<!-- code for navigation bar-->
	<div class="navbar">
	  <a href="index.php">College Events</a>
	  <a href="newRSO.php" class="active">Request New RSO</a>
	  <a href="joinRSO.php">Join an RSO</a>
	  <a href="newEvent.php">Create an Event</a>
	  <a href="eventComments.php">Event Comments</a>
	  <a href="uniProfile.php">University Profiles</a>
	  <a href="account.php"> <?php echo $user_data['name']; ?>'s Account</a>	
	  <a href="logout.php" class="right">Logout</a>
	</div><br>

	<!-- code for main box-->
	<div id="box">
		<!-- indicates that box will take input from user-->
		<form method="post">

			<div style="font-size:23px; margin:10px;">Request A New RSO:</div>
			
			<label for="rso_name">Name for your new organization:</label><br> 
			<input id="text" type="text" name="rso_name"> <br><br> 

			<label for="description">Description about your new organization:</label><br> 
			<input id="text" type="text" name="description"> <br><br>

			<input id="button" type="submit" value="Request")"> <br><br> 
			
		</form>


	</div>

</body>
</html>