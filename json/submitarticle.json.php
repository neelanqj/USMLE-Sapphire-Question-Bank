<?php
require('../apps/core.php');
require('../apps/controller/database.class.php');
require('../apps/controller/newsservice.class.php');

$pdo = Database::getConnection('write');

if ($_POST['ACTION'] == "submitarticle") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode($unformatted_json);
	
	$newsservice = new NewsService($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$newsservice->submitArticle($json->category, normalize_str($json->title), normalize_str($json->article));
}
?>