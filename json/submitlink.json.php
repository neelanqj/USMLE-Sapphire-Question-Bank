<?php 
require('../apps/controller/database.class.php');
require('../apps/controller/newsservice.class.php');

$pdo = Database::getConnection('write');

if ($_POST['ACTION'] == "submitlink") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$newsservice = new NewsService($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$newsservice->submitLink($json->category, $json->title, $json->httplink);
}
?>