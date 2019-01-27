<?php
require('../apps/controller/database.class.php');
require('../apps/controller/userservice.class.php');

$pdo = Database::getConnection('write');
$userService = new UserService($pdo, '', '', $_POST['SESSION'], '', '');

if ($_POST['ACTION'] == "details") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$userService->userDetails($json->userID);
	
} elseif ($action = "skills") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$userService->userSkills($json->userID);
}
?>