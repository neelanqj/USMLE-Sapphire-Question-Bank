<?php
require('../apps/controller/database.class.php');
require('../apps/controller/userservice.class.php');

$pdo = Database::getConnection('write');

if ($_POST['ACTION'] == "userdetails") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$userservice = new UserService($pdo,$json->email,'',$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$userservice->userDetailsAdvanced($json->userID);
	
} elseif ($_POST['ACTION'] == "updatedetails") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$userservice = new UserService($pdo,$json->email,'',$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$userservice->updateUser(
							   $json->email
							   , $json->password
							   , $json->password2
							   , $json->phone
							   , $json->firstName
							   , $json->lastName
							   , $json->region
							   , $json->city
							   , $json->country
							   , $json->postalCode
							   , $json->careerLvl
							   , $json->education
							   , $json->userID
							   );
	
}
?>