<?php
require('../apps/controller/database.class.php');
require('../apps/controller/qbank.class.php');

$pdo = Database::getConnection('write');

if ($_POST['ACTION'] == "getquestion") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	$qbank->testreview_getquestion($json->testhistoryid, $json->questionnumber);
	
} elseif ($_POST['ACTION'] == "getquestionanswers") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	$qbank->testreview_getquestionanswers($json->testhistoryid, $json->questionnumber);
	
} elseif ($_POST['ACTION'] == "getquestionanswerimages") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	$qbank->testreview_getquestionanswerimages($json->testhistoryid, $json->questionnumber);
	
} elseif ($_POST['ACTION'] == "gettotalquestions") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	$qbank->testreview_gettotalquestions($json->testhistoryid);
		
}

?>