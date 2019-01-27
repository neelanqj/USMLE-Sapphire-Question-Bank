<?php 
require('../apps/controller/database.class.php');
require('../apps/controller/newsservice.class.php');

$pdo = Database::getConnection('read');

if ($_POST['ACTION'] == "unreviewedlist") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$newsservice = new NewsService($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	$newsservice->unreviewedArticleList();
	
} elseif ($_POST['ACTION'] == "deleteunreviewed") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$newsservice = new NewsService($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	$newsservice->deleteUnreviewed($json->linkid);
	
}  elseif ($_POST['ACTION'] == "publishunreviewed") {
		$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$newsservice = new NewsService($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	$newsservice->publishUnreviewed($json->linkid);
	
}
?>