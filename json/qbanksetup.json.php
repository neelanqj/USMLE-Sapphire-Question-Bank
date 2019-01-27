<?php
require('../src/custom/php/jsonToXML.php');
require('../apps/controller/database.class.php');
require('../apps/controller/qbank.class.php');

$pdo = Database::getConnection('write');

if ($_POST['ACTION'] == "getsubjects") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$qbank = new QBank($pdo,$json->userid, $_POST['SESSION'], $json->ipaddress, $json->passcode);
	
	$qbank->getsubjects();
	
} elseif ($_POST['ACTION'] == "getcategories") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$qbank = new QBank($pdo,$json->userid, $_POST['SESSION'], $json->ipaddress, $json->passcode);
	
	$qbank->getcategories();
	
} elseif ($_POST['ACTION'] == "createtest") {
	// Note that systems are renamed categories in the system internally.
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$qbank = new QBank($pdo,$json->userid, $_POST['SESSION'], $json->ipaddress, $json->passcode);
	
	$qbank->createtest(
						jsonToXML(json_encode($json->subjects))
						, jsonToXML(json_encode($json->categories))
						, $json->questiontype
						, $json->testmode
						, $json->questioncount
					   );
					   
}
?>