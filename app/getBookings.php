<?php

require_once(dirname(__FILE__)."/../lib/bookings.php");
require_once(dirname(__FILE__)."/../config/initConfig.php");

//check if exists token and host for request validate
if(!isset($_POST['token']) || $_POST['token'] != hash('sha512', "companycanteen") || !isset($_POST['host']) || $_POST['host'] != $wwwroot){
	http_response_code(401);
	echo "Authentication error";
	exit();
}

$day = "";

if(isset($_POST['day'])){
	$day = $_POST['day'];
}

$Bookings = new Bookings("", array(), $day);

//get list bookings
$bookingsRecords = $Bookings->GetBookings();

if(count($bookingsRecords)){
	echo json_encode($bookingsRecords);
	http_response_code(200);
}else{
	echo "Not bookings found";
	http_response_code(400);
}

exit();

?>