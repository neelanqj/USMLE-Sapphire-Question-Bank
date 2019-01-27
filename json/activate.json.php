<?php
require('../apps/controller/database.class.php');
require('../apps/controller/userservice.class.php');

$pdo = Database::getConnection('write');

if ($_POST['ACTION'] == "activate") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$userservice = new UserService($pdo,$json->email,'','','','');
	$userservice->activateAccount($json->vcode);
	
}
?>