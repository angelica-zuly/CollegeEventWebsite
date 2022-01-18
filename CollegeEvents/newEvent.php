<?php

	//this is needed for pages that validate if a user is logged-in
	session_start();
		//in cluding files we need
		include("connection.php"); //establishes the connection to the db
		include("functions.php"); //holds all the helper functions used

		$user_data = check_login($con);
		$user = $user_data['user_id'];
		$userUni = $user_data['university'];

		//checking if user clicked on the post ("Create Event") button
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			
			
			$timestamp = date('Y-m-d H:m:s', strtotime($_POST['timestamp']));
			$email = $user_data['email'];
			$university = $user_data['university'];

			//something was posted. thus, collecting what was posted
			$name = $_POST['name'];
			$category = $_POST['category'];
			$description = $_POST['description'];				
			$location = $_POST['location'];
			$phone = $_POST['phone'];
			$status = $_POST['status'];	
			
			//making sure that fields are !empty
			if(!empty($name) && isset($_POST['category']) && !empty($description) && !empty($timestamp) 
							 && !empty($location) && isset($_POST['status']) && $userUni!='None'){

				if(isset($_POST['rsoEvent'])){
					$rsoEvent = $_POST['rsoEvent'];
				}else{
					//No RSO event was selected - set value to "No"
					$rsoEvent = "No";
				}

				if($status == 'Members'){
					$rsoEvent = $_POST['rsoEvent'];
				}
				
				$query = "SELECT * FROM events WHERE eventDateTime='$timestamp' AND location='$location'";
				//$query = "SELECT * FROM events WHERE name='$name'";
				
				$records = mysqli_query($con,$query);
				
				if ($records) {
				  if (mysqli_num_rows($records) > 0) {
				  	//Event time and location already exists in database
				  	$row = mysqli_fetch_array($records);
				    echo "<script type='text/javascript'> alert('Sorry. The event [".$row['name']."] has already created on ".$row['eventDateTime']." at ".$row['location']."'); location.href='newEvent.php';</script>";

				  } else {
						//not found	
						//events created by students need to be approved
					  	if($user_data['acc_type'] == 'Student'){					  		
					  		$approved = "No";
					  	}else{ $approved = "Yes";}

					  	//saving infromation to database
					  	$query1 = "INSERT into events (name, category, description, eventDateTime, location, 
					  									phone_num, email, university, status, approved, rso_event) 
						VALUES ('$name','$category','$description','$timestamp','$location','$phone','$email','$university','$status','$approved','$rsoEvent')";	
						mysqli_query($con,$query1); //saving...
						//created successfuly 					
						echo "<script type='text/javascript'> alert('Event has been created.'); location.href='newEvent.php';</script>";
				  }

				} else {
				  echo 'Error: '.mysql_error();
				}

			}else{
				//nothing was entered
				echo "<script type='text/javascript'> if (confirm('please enter vaild inforation')) {location.href='newEvent.php';}</script>";
			}
		}
?>

<!DOCTYPE html>
<html>
<head>
	<title>New Event Page</title>
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
	  <a href="newRSO.php">Request New RSO</a>
	  <a href="joinRSO.php">Join an RSO</a>
	  <a href="newEvent.php" class="active">Create an Event</a>
	  <a href="eventComments.php">Event Comments</a>
	  <a href="uniProfile.php">University Profiles</a>
	  <a href="account.php"> <?php echo $user_data['name']; ?>'s Account</a>	
	  <a href="logout.php" class="right">Logout</a>
	</div><br>

	<!-- code for main box-->
	<div id="box">
		<!-- indicates that box will take input from user-->
		<form method="post">
		
			<div style="font-size:23px; margin:10px;">Create an Event:</div>
			
			<label for="name">Name of new event: </label><br> 
			<input id="text" type="text" name="name"> <br><br> 

			<label for="category">Select event category: </label>
				<select name="category">
					<option selected disabled hidden>Choose here</option>
				    <option value="Social">Social</option>
				    <option value="Fundraising">Fundraising</option>
				    <option value="Festival">Festival</option>
				    <option value="Virtual">Virtual</option>
				    <option value="Corporate">Corporate</option>
				    <option value="Workshop">Workshop</option>
				    <option value="Educational">Educational</option>
				</select><br><br>

			<label for="description">Description: </label><br> 
			<input id="text" type="text" name="description"> <br><br> 

			<label for="event_date">Date/Time: </label><br> 
			<input id="text" type="datetime-local" name="timestamp"> <br><br> 

			<label for="location">Location: </label><br> 
			<input id="text" type="text" name="location"> <br><br> 

			<label for="phone">Phone Contact (optional): </label><br> 
			<input id="text" type="text" name="phone" value="none"> <br><br> 


			<?php
				//only super admins can make RSO events 	
				if($user_data['acc_type'] != 'Student'){

					echo "<label>Creating an RSO event? Select which one:</label>
					<select name='rsoEvent'>
						<option selected disabled hidden>No</option>";
						
							$records = mysqli_query($con,"SELECT rso_name FROM organizations WHERE user_id='$user'");
							while($rows = mysqli_fetch_array($records)){
								$rsoEvent = $rows['rso_name'];
								echo "<option value = '$rsoEvent'> $rsoEvent </option>";
							}
						
					echo "</select><br><br>";
				}
			?>


			<label for="status">Event Status: </label>
				<select name="status">
					<option selected disabled hidden>Choose here</option>
				    <option value="Public">Public</option>
				    <option value="Private">Private to University</option>
				    <option value="Members">Members Only</option>
				</select><br><br>

			<input id="button" type="submit" value="Create Event")"> <br><br><br>
			
		</form>


		<?php
			if($user_data['acc_type'] == 'Student'){
			  		echo "<i><mark>NOTE: Events created by students will need to be approved by University administration before being listed.</mark></i>";
			  	}			
 		?>

	</div>

</body>
</html>