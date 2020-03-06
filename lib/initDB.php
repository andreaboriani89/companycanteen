<?php
require_once(dirname(__FILE__)."/db.php");

$configDB = parse_ini_file(dirname(__FILE__)."/../config/db.ini");

$DB = new db($configDB['host'], $configDB['user'], $configDB['pass'], $configDB['name']);