<?php

require_once("../../lib/bookings.php");
require_once("../../lib/initDB.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$day = "";

if(isset($_POST['day'])){
	$day = $_POST['day'];
}

$typeData = "";

if(isset($_POST['typeData'])){
	$typeData = $_POST['typeData'];
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