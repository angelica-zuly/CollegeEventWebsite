<?php

	//session_start is needed for pages that validate if a user is logged-in
	session_start();
		//in cluding files we need
		include("connection.php"); //establishes the connection to the db
		include("functions.php"); //holds all the helper functions used

		//checking if user clicked on the post button ("Login")
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			//something was posted. thus, collecting what was posted
			$userID = $_POST['userID'];
			$userPass = $_POST['userPW'];

			//making sure that fields are !empty
			if(!empty($userID) && !empty($userPass)){	
				
				//read from database
				$query = "SELECT * FROM users WHERE user_id = '$userID' limit 1";		
				//saving result...
				$result = mysqli_query($con, $query);

				//confirm result was successful
				if($result){

					//now checking if the result is positive and table is !empty
					if($result && mysqli_num_rows($result) > 0){
						
						//saving the result into "$userdata"
						$user_data = mysqli_fetch_assoc($result);

						//confirm password is correct
						if($user_data['password'] === $userPass){
							echo "hello";
							//given pw matches the userID's pw in the database
							//assigning session id with our user's id
							$_SESSION['userID'] = $user_data['user_id'];

							//redirecting user to index page 
							header("Location: index.php");
							die;

						}
					}

				}
				echo "<script type='text/javascript'> alert('Incorrect UserID or Password'); location.href='login.php';</script>";

			}else{
				echo "<script type='text/javascript'> alert('Please enter vaild inforation'); location.href='login.php';</script>";
			}
		}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
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
			width: 300px;
			padding: 20px;
		}

	</style>

	<!-- code for main box-->
	<div id="box">
		<!-- indicates that box will take input from user-->
		<form method="post">
			<!-- this div acts as a login header-->
			<div style="font-size:30px; margin:10px;">Login Page</div><br>

			<!-- these are the components seen on the main box-->
			<!-- using the "id" of the sytles above-->
			<!-- the "br" will add newline spacing-->
			<label for="userPW">User ID:</label>
			<input id="text" type="text" name="userID"> <br><br> 
			<label for="userPW">Password:</label>
			<input id="text" type="password" name="userPW"> <br><br> 
			<input id="button" type="submit" value="Login"> <br><br> 

			<!-- link to the regigration page-->
			<a href="registration.php">Register Here!</a> <br><br> 

		</form>


	</div>

</body>
</html>