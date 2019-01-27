<?php
require('../apps/controller/database.class.php');
require('../apps/controller/qbank.class.php');

$pdo = Database::getConnection('read');

if ($_POST['ACTION'] == "getquestionlist") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$qbank->editquestion_getquestionlist($json->question, $json->category, $json->subject);	
} elseif ($_POST['ACTION'] == "getquestion") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));	
	
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$qbank->editquestion_getquestiondetails($json->questionid);
} elseif ($_POST['ACTION'] == "getquestionimages") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));	
	
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$qbank->editquestion_getquestionimages($json->questionid);
}elseif ($_POST['ACTION'] == "getquestionanswers") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));	
	
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$qbank->editquestion_getquestionanswers($json->questionid);
}elseif ($_POST['ACTION'] == "updatequestion") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));	
	
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$qbank->editquestion_updatequestion($json->questionid, $json->subject, $json->category, $json->question);
	
	$qbank->editquestion_clearquestionanswers($json->questionid);
	
	foreach ($json->answers as $answer) {
		$qbank->createquestion_addanswer($json->questionid, $answer->answer, $answer->explaination, $answer->correct);
   	}
	
	$qbank->editquestion_clearquestionimages($json->questionid);
	
	foreach($json->images as $images) {
		if(isset($images->questionimagesid)) {
			// This will read old files for a question images that already exist.
			$qbank->editquestion_readdanswerimage($json->questionid, $images->fileName, $images->description);
		} elseif(isset($images->fileValue)) {
			// this will add new files for question images that do not exist yet.
			$qbank->createquestion_addanswerimage($json->questionid, $images->fileValue, $images->description);
		}	
	}	
	
	echo '[{ "success" : "true" }]';
	
}elseif ($_POST['ACTION'] == "deletequestion") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$qbank->editquestion_deletequestion($json->questionid);
	echo '[{ "success" : "true" }]';
}
?>