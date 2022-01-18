<?php

session_start();

//uset the session given the user id
if(isset($_SESSION['userID'])){
	unset($_SESSION['userID']);
}

//redirect to login once session id has been unset
header("Location: login.php");
die;