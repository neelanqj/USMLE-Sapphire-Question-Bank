<?php
require('../src/library/json2XML/jsonToXML.php');
require('../apps/controller/database.class.php');
require('../apps/controller/qbank.class.php');

$pdo = Database::getConnection('write');

if ($_POST['ACTION'] == "createquestion") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	//echo jsonToXML(json_encode($json->images));
	
	$questionid = $qbank->createquestion(
						$json->category->name, $json->subject->name, $json->question
					);
	
	foreach ($json->answers as $answer) {
		$qbank->createquestion_addanswer($questionid, $answer->answer, $answer->explaination, $answer->correct);
   	}
	
	foreach($json->images as $images) {
		$qbank->createquestion_addanswerimage($questionid, $images->fileValue, $images->description);		
	}	
	
	echo '[{ "success" : "true" }]';
	
} elseif ($_POST['ACTION'] == "getsubjects") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$qbank = new QBank($pdo,$json->userid, $_POST['SESSION'], $json->ipaddress, $json->passcode);
	
	$qbank->getsubjects();
	
} elseif ($_POST['ACTION'] == "getcategories") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$qbank = new QBank($pdo,$json->userid, $_POST['SESSION'], $json->ipaddress, $json->passcode);
	
	$qbank->getcategories();
	
} 
?>