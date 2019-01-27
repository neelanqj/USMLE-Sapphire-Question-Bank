<?php
require('../apps/controller/database.class.php');
require('../apps/controller/newsservice.class.php');

$pdo = Database::getConnection('write');

if ($_POST['ACTION'] == "listcomments") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$newsservice = new NewsService($pdo,'','','','');
	$newsservice->listComments($json->linkid);
	
} elseif ($_POST['ACTION'] == "listcommentscount") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$newsservice = new NewsService($pdo,'','','','');
	$newsservice->listCommentsCount($json->linkid);
	
}  elseif ($_POST['ACTION'] == "getTitle") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$newsservice = new NewsService($pdo,'','','','');
	$newsservice->getArticleTitle($json->linkid);
	
} elseif ($_POST['ACTION'] == "addcomment") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$newsservice = new NewsService($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	$newsservice->addComment($json->comment, $json->linkid,'');
	
}
?>