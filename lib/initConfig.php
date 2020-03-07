<?php
require_once(dirname(__FILE__)."/db.php");

$config = parse_ini_file(dirname(__FILE__)."/../config/config.ini");

$DB = new db($config['host'], $config['user'], $config['pass'], $config['name']);
