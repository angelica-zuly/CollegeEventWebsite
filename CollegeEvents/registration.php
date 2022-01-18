<?php

	//this is needed for pages that validate if a user is logged-in
	session_start();
		//in cluding files we need
		include("connection.php"); //establishes the connection to the db
		include("functions.php"); //holds all the helper functions used

		//will not check if user is logged in on the registration page

		//checking if user clicked on the post button
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			//something was posted. thus, collecting what was posted
			$userName = $_POST['userName'];
			$userEmail = $_POST['userEmail'];
			$userUni = $_POST['userUni'];
			$code = $_POST['code'];

			//making sure that fields are !empty & name cannot be a number (must have entered a university OR code)
			if(!empty($userName) && !is_numeric($userName) && !empty($userEmail) && (!empty($userUni)||(!empty($code)))){				
				
				//creating random user ID (max of 5 digits)
				$userID = random_num(5);
				//creating random user PW (max of 8 digits)
				$userPass = random_num(8);

				//setting user's account type
				if($code == 123){
					//setting user's account type to "super student"
					$userAcc = "Super Admin";
				} else if($code == 321){
					//setting user's account type to "admin"
					$userAcc = "Admin";
				} else{
					//setting user's account type to "student"
					$userAcc = "Student";
				}




				$query = "SELECT * FROM users WHERE email='$userEmail'";
				$result = mysqli_query($con,$query);
				//check if user already exists in database
				if ($result) {
				  if (mysqli_num_rows($result) > 0) {
				  	//found in database
				    echo "<script type='text/javascript'> alert('Sorry. That email already exists.'); location.href='registration.php';</script>";
				  } else {
				  	//not found in database
 					//save information to database by values and columns
					$query1 = "INSERT into users (user_id,name,password,email,acc_type,university) 
					VALUES ('$userID','$userName','$userPass','$userEmail','$userAcc','$userUni')";

					//saving...
					mysqli_query($con,$query1);
					
					//displaying popup for user - redirects to login page
					alert($userID,$userPass);

				  }
				}
				
			}else{
				//nothing was entered
				echo "<script type='text/javascript'> if (confirm('please enter vaild inforation')) {location.href='registration.php';}</script>";
			}


		}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration Page</title>
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
			<div style="font-size:30px; margin:10px;">Registration</div>
			<h4 style="margin:10px;">Enter your information, and click "Obtain" to receive your user ID and password.</h1>	
			
			<label for="userName">*Name:</label><br> 
			<input id="text" type="text" name="userName"> <br><br> 
			<label for="userEmail">*Email:</label><br> 
			<input id="text" type="text" name="userEmail"> <br><br> 

			<label for="userUni">*University:</label><br> 
			<select name="userUni">
				<option selected>None</option>
				<?php 
					$records = mysqli_query($con,"SELECT name FROM universities");
					while($rows = mysqli_fetch_array($records)){
						$userUni = $rows['name'];
						echo "<option value = '$userUni'> $userUni </option>";
					}
				 ?>
			</select>
			<br><br>

			
		

			<label for="code">Code (Administration Only):</label><br> 
			<input id="text" type="text" name="code"> <br><br> 
			<input id="button" type="submit" value="Obtain")"> <br><br> 
			<!-- link to the login page-->
			<a href="login.php">Back to login page</a> <br><br> 
		</form>



	</div>

</body>
</html>