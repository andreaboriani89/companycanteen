<?php

require_once(dirname(__FILE__)."/../lib/bookings.php");
require_once(dirname(__FILE__)."/../config/initConfig.php");

//check if exists token and host for request validate
if(!isset($_POST['token']) || $_POST['token'] != hash('sha512', "companycanteen") || !isset($_POST['host']) || $_POST['host'] != $wwwroot){
	http_response_code(401);
	echo "Authentication error";
	exit();
}

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

//add new booking
$response = $Bookings->AddBooking();

http_response_code($response[0]);

echo $response[1];

exit();

?>