<?php
require_once(dirname(__FILE__)."/../config/initConfig.php");

// set post fields
$post = [
    'day'   => $_REQUEST['day'],
	'token' => hash('sha512', "companycanteen"),
	'host' => $wwwroot
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $wwwroot.'/api/list');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

// execute!
$response = curl_exec($ch);

// close the connection, release resources used
curl_close($ch);

$data = array(
	"headers" => array(0 => array("text" => "Utente")),
	"body" => array()
);

//menu
$menuFoods = $DB->query('SELECT * FROM cc_menu')->fetchAll();

if(count($menuFoods)){
	foreach($menuFoods as $menuFood){
		$data["headers"][] = array("text" => $menuFood['food']);
	}
}

if(count(json_decode($response))){
	foreach(json_decode($response) as $element){
		
		if(!isset($data['body'][$element->user])){
			
			$data['body'][$element->user] = array("columns" => array(0 => array("text" => $element->user)));
			
		}
		
		$data['body'][$element->user]["columns"][$element->foodid] = array("text" => "Sì");
		
	}
}

// do anything you want with your response
echo json_encode($data);

exit();
?>