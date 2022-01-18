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
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>University Profiles</title>

 	<style type="text/css">
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

 </head>
 <body>
 	
	<div class="navbar">
	  <a href="index.php">College Events</a>
	  <a href="newRSO.php">Request New RSO</a>
	  <a href="joinRSO.php">Join an RSO</a>
	  <a href="newEvent.php">Create an Event</a>
	  <a href="eventComments.php">Event Comments</a>
	  <a href="uniProfile.php" class="active">University Profiles</a>
	  <a href="account.php"> <?php echo $user_data['name']; ?>'s Account</a>	
	  <a href="logout.php" class="right">Logout</a>
	</div>

 	<h3><u>Listed Universities:</u></h3>	


 	<?php
 		//selecting all universities		
		$query = "SELECT * FROM universities";
		$result = mysqli_query($con,$query); //reading from the db

		if(mysqli_num_rows($result) > 0){
			while($data = mysqli_fetch_assoc($result)){
				//printing information of all universities	
				echo "<strong>Name: </strong>" . $data['name'] . "<br>";
				echo "<strong>Location: </strong>" . $data['location'] . "<br>";
				echo "<strong>Description: </strong>" . $data['description'] . "<br>";
				echo "<strong>Number of Students: </strong>" . $data['students'] . "<br><br>";
			}
		}

		//TODO: add photos
 	?>


 </body>
 </html>