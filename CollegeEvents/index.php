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
		$user = $user_data['user_id'];
		$string = $user_data['followingRSOs'];
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>College Events Page</title>

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
		  width: 45%;
		  padding: 10px;

		}
		.column2 {
		  float: left;
		  width: 25%;
		  padding: 10px;

		}
 	</style>
 	
 </head>

 <body>
 	
	<div class="navbar">
	  <a href="index.php" class="active">College Events</a>
	  <a href="newRSO.php">Request New RSO</a>
	  <a href="joinRSO.php">Join an RSO</a>
	  <a href="newEvent.php">Create an Event</a>
	  <a href="eventComments.php">Event Comments</a>
	  <a href="uniProfile.php">University Profiles</a>
	  <a href="account.php"> <?php echo $user_data['name']; ?>'s Account</a>
	  <a href="logout.php" class="right">Logout</a>
	</div>

	<br>
	<div class="column1" style="background-color:#D3D1CD;">
	    <h1>Published Events</h1>

		    <?php

		    	$query = "SELECT * FROM events WHERE approved='Yes'"; 

			    //checking if user clicked on the "refresh" button
				if($_SERVER['REQUEST_METHOD'] == "POST" ){

					if($_POST['rsoFilter']=='Yes'){
						//user wants to filter by RSOs they are following
						$result = mysqli_query($con,$query);
						while($rows = mysqli_fetch_assoc($result)){
							$currentRSO = $rows['rso_event'];
							if(str_contains($string, $currentRSO)){
								print "<br><strong><u>" . $rows['name'] . "</u></strong><br>";
								echo "<em>Category: </em>" . $rows['category'] . "<br>";
								echo "<em>Description: </em>" . $rows['description'] . "<br>";
								echo "<em>Location: </em>" . $rows['location'] . "<br>";
								echo "<em>Date/Time: </em>" . $rows['eventDateTime'] . "<br>";
								echo "<em>Phone Contact: </em>" . $rows['phone_num'] . "<br>";
								echo "<em>Email Contact: </em>" . $rows['email'] . "<br>";
								echo "<em>Status: </em>" . $rows['status'] . "<br>";

								if($rows['rso_event'] != 'No'){
									echo "<em>RSO: </em>" . $rows['rso_event'] . "<br>";
								}

							}					
						}
					}else{
						//User did not filter by RSO							
						if(isset($_POST['uniFilter'])){
							//user selected a university, thus filtering events from selected university
							$uniFilter = $_POST['uniFilter'];
							$query = "SELECT * FROM events WHERE approved='Yes' AND university='$uniFilter'"; 
						}

						$result = mysqli_query($con,$query); //reading from the db			
						if(mysqli_num_rows($result) > 0){ 
							//going through all event instances in database							
							while($data = mysqli_fetch_assoc($result)){								
								print "<br><strong><u>" . $data['name'] . "</u></strong><br>";
								echo "<em>Category: </em>" . $data['category'] . "<br>";
								echo "<em>Description: </em>" . $data['description'] . "<br>";
								echo "<em>Location: </em>" . $data['location'] . "<br>";
								echo "<em>Date/Time: </em>" . $data['eventDateTime'] . "<br>";
								echo "<em>Phone Contact: </em>" . $data['phone_num'] . "<br>";
								echo "<em>Email Contact: </em>" . $data['email'] . "<br>";
								echo "<em>Status: </em>" . $data['status'] . "<br>";
							}
						}
					}
				}else{
					//default options - displaying all approved events					
					$result = mysqli_query($con,$query); //reading from the db			
					if(mysqli_num_rows($result) > 0){ 
						//instance found
						while($data = mysqli_fetch_assoc($result)){
							//going through all event instances in database
							print "<br><strong><u>" . $data['name'] . "</u></strong><br>";
							echo "<em>Category: </em>" . $data['category'] . "<br>";
							echo "<em>Description: </em>" . $data['description'] . "<br>";
							echo "<em>Location: </em>" . $data['location'] . "<br>";
							echo "<em>Date/Time: </em>" . $data['eventDateTime'] . "<br>";
							echo "<em>Phone Contact: </em>" . $data['phone_num'] . "<br>";
							echo "<em>Email Contact: </em>" . $data['email'] . "<br>";
							echo "<em>Status: </em>" . $data['status'] . "<br>";							
						}
					}					
				}
	   		?>   
 	</div>


 	 <form method="post" class="column2" style="background-color:#bbb;">
	    <h1>Event Filters</h1>

		<label>View by Univsersity: </label>
			<select name="uniFilter">
				<option selected disabled hidden>Choose here</option>
				<?php 
					$records = mysqli_query($con,"SELECT name FROM universities");
					while($rows = mysqli_fetch_array($records)){
						$uniFilter = $rows['name'];
						echo "<option value = '$uniFilter'> $uniFilter </option>";
					}
				 ?>
			</select><br><br>
	

		<label>View events from your RSOs? </label>
			<input type="radio" name="rsoFilter" value="Yes">
			<label>Yes</label>
			<input type="radio" name="rsoFilter" value="No" checked> 
			<label>No</label><br><br>

		<input id="button" type="submit" value="Refresh Page")"> <br><br><br>

  	</form>		




 </body>
 </html>