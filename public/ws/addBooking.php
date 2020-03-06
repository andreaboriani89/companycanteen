<?php

require_once("../../lib/bookings.php");
require_once("../../lib/initDB.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$user = "";
$foods = array();
$day = "";

if(isset($_POST['user'])){
	$user = $_POST['user'];
}

if(isset($_POST['foods'])){
	$foods = $_POST['foods'];
}

if(isset($_POST['day'])){
	$day = $_POST['day'];
}

$Bookings = new Bookings($user, $foods, $day);

$response = $Bookings->AddBooking();

http_response_code($response[0]);

echo $response[1];

exit();

?>