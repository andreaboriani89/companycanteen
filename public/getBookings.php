<?php
require_once(dirname(__FILE__)."/../lib/initConfig.php");

// set post fields
$post = [
    'day'   => $_REQUEST['day'],
	'token' => hash('sha512', "companycanteen"),
	'host' => $config['wwwroot']
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $config['wwwroot'].'/api/list');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

// execute!
$response = curl_exec($ch);

// close the connection, release resources used
curl_close($ch);

// do anything you want with your response
echo json_encode($response);

exit();
?>