<?php
require('../apps/controller/database.class.php');
require('../apps/controller/newsservice.class.php');

$pdo = Database::getConnection('read');

if ($_POST['ACTION'] == "search") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$newsservice = new NewsService($pdo,'','','','');
	
	$newsservice->search($json->category, $json->searchterm, $json->pagenum, $json->perpage);
	
} elseif ($_POST['ACTION'] == "count") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$newsservice = new NewsService($pdo,'','','','');
	
	$newsservice->searchCount($json->category, $json->searchterm, $json->pagenum, $json->perpage);
} elseif ($_POST['ACTION'] == "newestannouncement") {
	
	$newsservice = new NewsService($pdo,'','','','');
	
	$newsservice->newestannouncement();
}
?>