

<?php 	
	//this allows you to access session on any page
	session_start();	
		//in cluding files we need
		include("connection.php"); //establishes the connection to the db
		include("functions.php"); //holds all the helper functions used

		$user_data = check_login($con);
		$user = $user_data['user_id'];
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Edit Comment</title> 
 	
 </head>

 <body>

 	<?php

 		$id = $_POST['id'];
 		$user_id = $_POST['user_id'];
		$date = $_POST['date'];
		$message = $_POST['message'];
		$event = $_POST['event'];


 		echo "<form method='POST' action='".editComments($con)."'>
			<input type='hidden' name='id' value='$id'>
			<input type='hidden' name='user_id' value='$user_id'>
	 		<input type='hidden' name='date' value='$date'>
	 		<textarea name='message'>".$message."</textarea>		
	 		<button type='submit' name='commentEdit'>Edit</button>
 		</form>";

 	?>

 </body>
 </html>