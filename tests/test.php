<?php
require_once("../lib/db.php");
require_once("../lib/bookings.php");

$configDB = parse_ini_file("../config/db.ini");

$DB = new db($configDB['host'], $configDB['user'], $configDB['pass'], $configDB['name']);

$Bookings = new Bookings("test test", array(1, 3, 6), "2020-03-04");

echo $Bookings->AddBooking();

print_r($Bookings->GetBookingsJson());

$DB->close();

?>