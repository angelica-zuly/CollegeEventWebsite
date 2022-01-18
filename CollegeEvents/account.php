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
		$string = $user_data['followingRSOs'];
		$id = $user_data['user_id'];

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Account Page</title>

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
	  <a href="uniProfile.php">University Profiles</a>
	  <a href="account.php" class="active"> <?php echo $user_data['name']; ?>'s Account</a>	
	  <a href="logout.php" class="right">Logout</a>
	</div>

 	<h3><u>Account Information:</u></h3>

 	<p>
 	<strong>Name:</strong> <?php echo $user_data['name']; ?><br><br>
 	<strong>Account Type:</strong> <?php echo $user_data['acc_type']; ?><br><br>
 	<strong>University:</strong> <?php echo $user_data['university']; ?><br><br>
 	<strong>User ID:</strong> <?php echo $user_data['user_id']; ?><br><br>
 	<strong>Password:</strong> <?php echo $user_data['password']; ?><br><br>
 	<strong>Email:</strong> <?php echo $user_data['email']; ?><br><br>

 	<strong>Followed RSOs:</strong> 
 	 <?php
 		//select instances of RSOs that user owns
		$query = "SELECT followingRSOs FROM users WHERE user_id='$id'";
		$result = mysqli_query($con,$query); //reading from the db

		if(mysqli_num_rows($result) > 0){
			while($data = mysqli_fetch_assoc($result)){
				//printing the RSO names
				echo $data['followingRSOs'];
			}
		}
 	?>
 	<br><br>


 	<strong>Owned RSOs: </strong>  	
 	<?php
 		//select instances of RSOs that user owns
		$query = "SELECT * FROM organizations WHERE user_id='$id'";
		$result = mysqli_query($con,$query); //reading from the db

		if(mysqli_num_rows($result) > 0){
			while($data = mysqli_fetch_assoc($result)){
				//printing the RSO names
				echo "[" . $data['rso_name'] . "] ";
			}
		}
 	?>
 	</p><br><br>

	<strong>Want to leave an RSO? </strong> 

		<?php echo "<form method='POST' action='".leaveRSO($con,$id,$string)."'>" ?>
		
	 		<select name='currentRSO'>
				<option selected disabled hidden>Select RSO</option>

					<?php 						
						$records = mysqli_query($con,"SELECT rso_name FROM organizations WHERE user_id!='$id'");
						while($rows = mysqli_fetch_array($records)){
							$currentRSO = $rows['rso_name'];
							if(str_contains($string, $currentRSO)){
								echo "<option value = '$currentRSO'> $currentRSO </option>";
							}					
						}
					?>	

			</select> 

	 		<button id="button" type='submit' name='leave'>Leave</button><br>

		</form>




	<?php 
	
		//only super admins can create a university profile
		if($user_data['acc_type'] == 'Super Admin' &&  $user_data['university'] == 'None'){			
			echo '<br><a href="createUni.php"><mark>Click here to create a University Profile!</mark></a> <br><br>';
		}

		//only super admins can approve events 	
		if($user_data['acc_type'] == 'Super Admin'){

			echo "<form method='post'>";			
				echo "<label for='unapproved'>Any unapproved events requested by students will be listed here: </label><br>"; 
				echo "<select name='unapproved'>";
					echo "<option selected disabled hidden>Select</option>";
					$uni = $user_data['university'];

					$records = mysqli_query($con,"SELECT name FROM events WHERE approved='No' AND university='$uni'");
					while($rows = mysqli_fetch_array($records)){
						$unapproved = $rows['name'];
						echo "<option value = '$unapproved'> $unapproved </option>";
					}				 
				echo "</select>";
				echo "<input id='button' type='submit' value='Approve')''><br> ";
			echo "</form>";
		

			//checking if user clicked on the "Approve" button
			if($_SERVER['REQUEST_METHOD'] == "POST"){
				if(isset($_POST['unapproved'])){
					//something was selected from dropdown
					$approve = $_POST['unapproved'];
					$sql = "UPDATE events SET approved='Yes' WHERE name='$approve'";			
					$result = mysqli_query($con, $sql); //saving...	
					echo "<script type='text/javascript'> alert('Organization has been approved!'); location.href='account.php';</script>";
				}
				
			}

		}

	?>

 </body>
 </html>