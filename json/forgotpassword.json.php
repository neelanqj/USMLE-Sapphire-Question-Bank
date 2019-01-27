<?php
require('../apps/controller/database.class.php');
require('../apps/controller/userservice.class.php');
require('../src/library/global-functions.php');

$pdo = Database::getConnection('write');
$unformatted_json = $_POST['JSON'];
$json = json_decode($unformatted_json);

if ($_POST['ACTION'] == "getauthenticationcode" && validEmail($json->email) == true) {
	$userservice = new UserService($pdo,$json->email,'',$_POST['SESSION'],'','');	
	$userservice->getEmailAuthentication();
	
} elseif ($_POST['ACTION'] == "resetpassword" && validEmail($json->email) == true) {
	$userservice = new UserService($pdo,$json->email,'',$_POST['SESSION'],'','');	
	$userservice->changeForgottenPassword($json->newpassword, $json->reenternewpassword, $json->authenticationcode);
	
}
?>