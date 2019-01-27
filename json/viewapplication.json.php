<?php
require('../apps/controller/database.class.php');
require('../apps/controller/newsservice.class.php');

$pdo = Database::getConnection('write');

if ($_POST['ACTION'] == "load") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));

	$jobservice = new JobService($pdo,$json->email, '',$_POST['SESSION'], $json->ipaddress, $json->passcode);
	$jobservice->jobApplicationInfo($json->appID);
}

?>