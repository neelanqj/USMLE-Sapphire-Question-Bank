<?php
require('../apps/controller/database.class.php');
require('../apps/controller/qbank.class.php');

$pdo = Database::getConnection('write');

if ($_POST['ACTION'] == "getquestion") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$qbank->getquestion($json->questionbookmark);
	
} elseif ($_POST['ACTION'] == "getquestionanswers") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	$qbank->getquestionanswers();
	
} elseif ($_POST['ACTION'] == "getquestionanswerimages") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	$qbank->getquestionanswerimages();
	
} elseif ($_POST['ACTION'] == "answerhistory") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$qbank->answerhistory($json->questionbookmark);
	
} elseif ($_POST['ACTION'] == "nextquestion") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$qbank->nextquestion();
	
} elseif ($_POST['ACTION'] == "prevquestion") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$qbank->prevquestion();
	
} elseif ($_POST['ACTION'] == "getquestionbookmark") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$qbank->getquestionbookmark();
	
} elseif ($_POST['ACTION'] == "gettotalquestions") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$qbank->gettotalquestions();
	
} elseif ($_POST['ACTION'] == "setanswer") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$qbank->clearanswers($json->questionbookmark);
	
	foreach($json->questionanswers as $item) {
		$qbank->addanswer($json->questionbookmark, $item);
	}
		
} elseif ($_POST['ACTION'] == "getremainingtime") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$qbank->getremainingtime();
		
}  elseif ($_POST['ACTION'] == "endblock") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$qbank->endblock();
		
}  elseif ($_POST['ACTION'] == "gettestmode") {
	$unformatted_json = $_POST['JSON'];
	$json = json_decode(stripslashes($unformatted_json));
	
	$qbank = new QBank($pdo,$json->userid,$_POST['SESSION'],$json->ipaddress,$json->passcode);
	
	$qbank->gettestmode();
		
}  

?>