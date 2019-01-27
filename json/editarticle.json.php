<?php
require('../apps/core.php');
require('../apps/controller/database.class.php');
require('../apps/controller/newsservice.class.php');

$pdo = Database::getConnection('read');

if ($_POST['ACTION'] == "getarticlelist") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$newsservice = new NewsService($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$newsservice->search('', $json->article, 0, 100);	
} elseif ($_POST['ACTION'] == "getarticle") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));	
	
	$newsservice = new NewsService($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	echo json_encode($newsservice->getArticle($json->articleid));
} elseif ($_POST['ACTION'] == "updatearticle") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));	
	
	$newsservice = new NewsService($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);

	$newsservice->updateArticle($json->linkid, $json->title, $json->body);
	
}elseif ($_POST['ACTION'] == "deletearticle") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$newsservice = new NewsService($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$newsservice->deleteArticle($json->linkid);
}
?>