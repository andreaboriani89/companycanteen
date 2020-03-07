<?php

require_once(dirname(__FILE__)."/../lib/bookings.php");
require_once(dirname(__FILE__)."/../lib/initConfig.php");

if(!isset($_GET['token']) || $_GET['token'] != hash('sha512', "companycanteen") || !isset($_GET['host']) || $_GET['host'] != $config['wwwroot']){
	http_response_code(401);
	echo "Authentication error";
	exit();
}

$day = "";

if(isset($_GET['day'])){
	$day = $_GET['day'];
}

$Bookings = new Bookings("", array(), $day);

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