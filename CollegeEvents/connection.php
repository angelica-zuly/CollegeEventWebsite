
<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "college_events_db";

//this variable "$con" is used to connect to the db
//the if statement will check for any connection errors
if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)){
	die("failed to connect");
}

