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

		//checking if user clicked on the post button
		if($_SERVER['REQUEST_METHOD'] == "POST"){

			$id = $user_data['user_id'];
			$userRSO = $_POST['userRSO'];			

			$query = "SELECT followingRSOs FROM users WHERE user_id='$id'";
			$result = mysqli_query($con,$query); //reading from the db			
			
			if (mysqli_num_rows($result) > 0) {
				$temp = mysqli_fetch_assoc($result);
				$string = $temp['followingRSOs'];
			}			
	
			if (str_contains($string, $userRSO)) {
			    //echo "Already in database\n";
			    echo "<script type='text/javascript'> alert('You are already a member!'); location.href='joinRSO.php';</script>";
			}else{
				//not found - appending
				$updated = $string . " " . $userRSO;
				$sql = "UPDATE users SET followingRSOs='$updated' WHERE user_id='$id'";			
				mysqli_query($con, $sql); //saving...					
				updateMembers($userRSO,$con,1); //increments members by 1
				echo "<script type='text/javascript'> alert('Joined orgaization successfully!'); location.href='joinRSO.php';</script>";
				//echo "added\n";
			}	
			
		}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Join RSO Page</title>

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

		/* Create two columns that floats next to each other */
		.column1 {
		  float: left;
		  width: 40%;
		  padding: 10px;

		}
		.column2 {
		  float: left;
		  width: 40%;
		  padding: 10px;

		}
 	</style>
 	
 </head>

 <body>
 	
	<div class="navbar">
	  <a href="index.php">College Events</a>
	  <a href="newRSO.php">Request New RSO</a>
	  <a href="joinRSO.php" class="active">Join an RSO</a>
	  <a href="newEvent.php">Create an Event</a>
	  <a href="eventComments.php">Event Comments</a>
	  <a href="uniProfile.php">University Profiles</a>
	  <a href="account.php"> <?php echo $user_data['name']; ?>'s Account</a>
	  <a href="logout.php" class="right">Logout</a>
	</div><br>


	<form method="post" class="column1" style="background-color:#D3D1CD;">
	    <h2>Listed Organizations</h2>
	    <p>Check out some popular orgaizations!</p>
		<label for="userRSO">Join an RSO here: </label>
		<select name="userRSO">
			<option selected disabled hidden>Choose here</option>
			<?php 
				$records = mysqli_query($con,"SELECT rso_name FROM organizations WHERE members>=5");
				while($rows = mysqli_fetch_array($records)){
					$userRSO = $rows['rso_name'];
					echo "<option value = '$userRSO'> $userRSO </option>";
				}
			 ?>
		</select>  
		<input id="button" type="submit" value="Click to join!")"><br> 

	 	<?php
			$query2 = "SELECT * FROM organizations"; //selecting all RSOs 
			$result2 = mysqli_query($con,$query2); //reading from the db			
			if(mysqli_num_rows($result2) > 0){ 
				//instance found
				while($data = mysqli_fetch_assoc($result2)){
					//going through all RSO instances in database
					if($data['members'] >= 5){


						// RSOs with 5 people or more will be "Listed Organizations"
						//displaying information of universities	
						print "<br><strong><u>" . $data['rso_name'] . "</u></strong><br>";
						echo "<em>Description: </em>" . $data['description'] . "<br>";
						echo "<em>Admin: </em>" . $data['user_name'] . "<br>";
						echo "<em>Number of Members: </em>" . $data['members'] . "<br>";

						$data_id = $data['user_id'];
						$sql = "UPDATE users SET acc_type='Admin' WHERE user_id='$data_id'";			
						mysqli_query($con, $sql); //saving...					
					}	
				}
			}
			//TODO: add photos	
	 	?>
 	 </form>



 	 <form method="post" class="column2" style="background-color:#bbb;">
	    <h2>New Organizations</h2>
	    <p>These orgaizations are trying to gain more members.</p>
	    <label for="userRSO">Help Start an Organization: </label>
		<select name="userRSO">
			<option selected disabled hidden>Choose here</option>
			<?php 
				$records = mysqli_query($con,"SELECT rso_name FROM organizations WHERE members<5");
				while($rows = mysqli_fetch_array($records)){
					$userRSO = $rows['rso_name'];
					echo "<option value = '$userRSO'> $userRSO </option>";
				}
			 ?>
		</select>  
		<input id="button" type="submit" value="Click to join!")"> <br>

		<?php
			$query2 = "SELECT * FROM organizations"; //selecting all RSOs 
			$result2 = mysqli_query($con,$query2); //reading from the db			
			if(mysqli_num_rows($result2) > 0){ 
				//instance found
				while($data = mysqli_fetch_assoc($result2)){
					//going through all RSO instances in database
					if($data['members'] < 5){
						// RSOs with less than 5 people are considered "new RSOs"
						//displaying information of universities	
						print "<br><strong><u>" . $data['rso_name'] . "</u></strong><br>";
						echo "<em>Description: </em>" . $data['description'] . "<br>";
						echo "<em>Admin: </em>" . $data['user_name'] . "<br>";
						echo "<em>Number of Members: </em>" . $data['members'] . "<br>";
					}	
				}
			}
			//TODO: add photos	
	 	?>
  	</form>		




 </body>
 </html>