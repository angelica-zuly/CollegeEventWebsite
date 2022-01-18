<?php
	
//this function checks if a user is logged in
function check_login($con){

	//if the user id exists, then the session value will be set
	if(isset($_SESSION['userID'])){

		//checking if the user id is in the db by creating a query
		$id = $_SESSION['userID'];
		$query = "SELECT * FROM users where user_id = '$id' limit 1";

		//read from the db
		$result = mysqli_query($con, $query);

		//now checking if the result is positive and table is !empty
		if($result && mysqli_num_rows($result) > 0){
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
		
	}
	//redirect to login if session value does DNE
	header("Location: login.php");
	die;	
}

function random_num($length){
	$text = "";

	//make sure that the length is never < 4
	if($length < 4){
		$length = 4;
	}

	//creating a length between 4 and length
	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		//creating random number with digits 0-9 of random len
		$text .= rand(0,9);
	}

	return $text;
}

function alert($msg1,$msg2) {
    echo "<script type='text/javascript'>alert('ID: $msg1 and PW: $msg2'); location.href='login.php';</script>";
}


function updateMembers($name,$con,$value){

	$query = "SELECT members FROM organizations WHERE rso_name='$name'";
	$result = mysqli_query($con,$query); //reading from the db			
	
	if (mysqli_num_rows($result) > 0) {
		$temp = mysqli_fetch_assoc($result);
		$mem = $temp['members'];
	}

	$mem = $mem + $value;
	$sql = "UPDATE organizations SET members=$mem WHERE rso_name='$name'";			
	mysqli_query($con, $sql); //saving...	

}

function setComments($con){
	if(isset($_POST['commentSubmit']) && !empty('message') && isset($_POST['event']) ){
		$user_id = $_POST['user_id'];
		$date = $_POST['date'];
		$message = $_POST['message'];
		$event = $_POST['event'];

		$sql = "INSERT into comments (user_id,date,message,event) VALUES ('$user_id','$date','$message','$event')";				
		mysqli_query($con,$sql); //saving...
	}
}

function getComments($con,$event,$userName){

	$sql = "SELECT * FROM comments WHERE event='$event'";				
	$result = mysqli_query($con,$sql); 

	while($row = mysqli_fetch_assoc($result)){
		echo "<div class='comment-box'><p>";
			echo "<strong>".$row['user_id']."</strong>";	
			echo "<i><sub>&nbsp&nbsp&nbsp".$row['date']."</sub></i><br>";
			echo nl2br($row['message']);
			echo "</p>";


			if($row['user_id']==$userName){
				echo "<form class='delete-form' method='POST' action='".deleteComment($con)."'> 
						<input type='hidden' name='id' value='".$row['id']."'>
						<button type='submit' name='commentDelete'>Delete</button>
					</form>

					<form class='edit-form' method='POST' action='editComment.php'> 
						<input type='hidden' name='id' value='".$row['id']."'>
						<input type='hidden' name='user_id' value='".$row['user_id']."'>
						<input type='hidden' name='date' value='".$row['date']."'>
						<input type='hidden' name='message' value='".$row['message']."'>
						<input type='hidden' name='event' value='".$row['event']."'>
						<button>Edit</button>
					</form>";

			}


		
		echo "</div>";
	}	
}


function editComments($con){
	if(isset($_POST['commentEdit']) && !empty('message')){
		$user_id = $_POST['user_id'];
		$id = $_POST['id'];
		$date = $_POST['date'];
		$message = $_POST['message'];
		$event = $_POST['event'];

		$sql = "UPDATE comments SET message='$message' WHERE id='$id'";				
		mysqli_query($con,$sql); //saving...
		header("Location: eventComments.php");
	}
}

function deleteComment($con){
	if(isset($_POST['commentDelete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM comments WHERE id='$id'";				
		mysqli_query($con,$sql); //saving...
		header("Location: eventComments.php");
	}
}


function leaveRSO($con,$id,$string){	
	if(isset($_POST['leave']) && isset($_POST['currentRSO']) ){

		$currentRSO = $_POST['currentRSO'];

		//remove selected RSO from user's followed RSO string
		$string = str_ireplace($currentRSO,"",$string);
		//decrement members by 1
		updateMembers($currentRSO,$con,-1); 
		//update database string for user's followed RSOs
		$sql = "UPDATE users SET followingRSOs='$string' WHERE user_id='$id'";			
		$result = mysqli_query($con, $sql); //saving...	
		
		//refresh - return to account
		header("Location: account.php");
	}
	
}