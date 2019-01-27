<?php
require('../apps/controller/database.class.php');
require('../apps/controller/userservice.class.php');

$pdo = Database::getConnection('write');

if ($_POST['ACTION'] == "changepassword") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode($unformatted_json);

	$userservice = new UserService($pdo,$json->email,$json->oldpassword,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$userservice->changePassword($json->password, $json->password2);
}
?>