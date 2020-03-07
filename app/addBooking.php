<?php

require_once(dirname(__FILE__)."/../lib/bookings.php");
require_once(dirname(__FILE__)."/../lib/initConfig.php");

$user = "";
$foods = array();
$day = "";

if(!isset($_POST['token']) || $_POST['token'] != hash('sha512', "companycanteen") || !isset($_POST['host']) || $_POST['host'] != $config['wwwroot']){
	http_response_code(401);
	echo "Authentication error";
	exit();
}

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