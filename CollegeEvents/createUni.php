<?php

	//this is needed for pages that validate if a user is logged-in
	session_start();
		//in cluding files we need
		include("connection.php"); //establishes the connection to the db
		include("functions.php"); //holds all the helper functions used

		$user_data = check_login($con);

		//checking if user clicked on the post ("Create") button
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			//something was posted. thus, collecting what was posted
			$uniName = $_POST['uniName'];
			$uniLocation = $_POST['uniLocation'];
			$uniDescription = $_POST['uniDescription'];
			$numStudents = $_POST['numStudents'];


			//making sure that fields are !empty
			if(!empty($uniName) && !empty($uniLocation) && !empty($uniDescription) && !empty($numStudents)){

				$query = "SELECT * FROM universities WHERE name='$uniName'";
				$result = mysqli_query($con,$query);
				//check if it already exists in database
				if ($result) {
				  if (mysqli_num_rows($result) > 0) {
				  	//found in database
				    echo "<script type='text/javascript'> alert('Sorry. There is already a profile for that university.'); location.href='createUni.php';</script>";

				  } else {
				  	//not found in database
				  	//save information to database by values and columns
					$query1 = "INSERT into universities (name,location,description,students) 
					VALUES ('$uniName','$uniLocation','$uniDescription','$numStudents')";					
					mysqli_query($con,$query1); //saving...

					//adding the university to the admin account
					$id = $_SESSION['userID'];
					$sql = "UPDATE users SET university='$uniName' WHERE user_id='$id' limit 1";
					mysqli_query($con, $sql);

					//inserted 
					echo "<script type='text/javascript'> alert('Profile has been created. Redirecting to Account Page.'); location.href='account.php';</script>";
				  }

				} else {
				  echo 'Error: '.mysql_error();
				}

			}else{
				//nothing was entered
				echo "<script type='text/javascript'> if (confirm('please enter vaild inforation')) {location.href='createUni.php';}</script>";

			}

		}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Create University Page</title>
</head>
<body>
	<style type="text/css">
		
		/*styling for text boxes*/
		#text{
			height: 25px;
			border-radius: 5px;
			padding: 4px;
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

	</style>

	<!-- code for main box-->
	<div id="box">
		<!-- indicates that box will take input from user-->
		<form method="post">
			<!-- this div acts as a login header-->
			<div style="font-size:23px; margin:10px;">Create A University Profile:</div>
			
			<label for="uniName">Name:</label><br> 
			<input id="text" type="text" name="uniName"> <br><br> 

			<label for="uniLocation">Location:</label><br> 
			<input id="text" type="text" name="uniLocation"> <br><br>

			<label for="uniDescription">Description:</label><br> 
			<input id="text" type="text" name="uniDescription"> <br><br> 

			<label for="numStudents">Number of Students:</label><br> 
			<input id="text" type="text" name="numStudents"> <br><br> 

			<input id="button" type="submit" value="Create")"> <br><br> 
			
			<!-- link to the login page-->
			<a href="account.php">Back to Account</a> <br><br> 
		</form>


	</div>

</body>
</html>