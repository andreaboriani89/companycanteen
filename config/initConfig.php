<?php
require_once(dirname(__FILE__)."/../lib/db.php");
require_once(dirname(__FILE__)."/config.php");

$DB = new db($dbhost, $dbuser, $dbpass, $dbname);
