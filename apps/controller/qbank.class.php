<?php

class QBank
{
	protected $_userID;    // using protected so they can be accessed
	protected $_ipaddress;
	protected $_passcode;
	protected $_sessionid;
	
    protected $_db;       // stores the database handler

	// Login Credentials
    public function __construct(PDO $db, $userID, $sessionid, $ipaddress, $passcode) 
    {
		$this->_db = $db;
		
		$this->_userID = $userID;
		$this->_sessionid = $sessionid;
		$this->_ipaddress = $ipaddress;
		$this->_passcode = $passcode;
    }
	 
	public function getsubjects() {
		$stmt = $this->_db->prepare("CALL QB_TESTSETUP (?,?,?,?,'GETSUBJECTS','','',0,0,'','',0,0)");
	
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		
		$stmt->execute();

		echo json_encode($stmt->fetchAll());
	 }
	 
	public function getcategories() {
		$stmt = $this->_db->prepare("CALL QB_TESTSETUP (?,?,?,?,'GETCATEGORIES','','',0,0,'','',0,0)");
	
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll());
	}
	 
	public function gettestmode() {
		$stmt = $this->_db->prepare("CALL QB_TESTSETUP (?,?,?,?,'GETTESTMODE','','',0,0,'','',0,0)");
	
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll());
	}
		
	public function createtest($subjects, $categories, $questiontype, $testmode, $questioncount) {
		
		$stmt = $this->_db->prepare("CALL QB_TESTSETUP (?,?,?,?,'CREATETEST',?,?,0,0,?,?,?,?)");
		
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(5, $categories, PDO::PARAM_STR);
		$stmt->bindValue(6, $subjects, PDO::PARAM_STR);
		$stmt->bindValue(7, $questiontype, PDO::PARAM_STR);
		$stmt->bindValue(8, $testmode, PDO::PARAM_STR);
		$stmt->bindValue(9, $questioncount, PDO::PARAM_STR);
		$stmt->bindValue(10, $questioncount, PDO::PARAM_STR);
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll());
	 }
	 
	 public function getquestion($questionbookmark) {
		$stmt = $this->_db->prepare("CALL QB_TEST (?,?,?,?,'GETQUESTION',?,0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);	
		$stmt->bindValue(5, $questionbookmark, PDO::PARAM_STR);	 
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll());		 
	 }
	 
	 public function nextquestion() {
		$stmt = $this->_db->prepare("CALL QB_TEST (?,?,?,?,'NEXTQUESTION',0,0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);	 
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll());		 
	 }	 
	 
	 public function prevquestion() {
		$stmt = $this->_db->prepare("CALL QB_TEST (?,?,?,?,'PREVQUESTION',0,0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);	
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll());		 
	 }	
	 
	 public function getquestionbookmark() {
		$stmt = $this->_db->prepare("CALL QB_TEST (?,?,?,?,'GETQUESTIONBOOKMARK',0,0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR); 
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll());
		 
	 }	
	 
	 public function gettotalquestions() {
		$stmt = $this->_db->prepare("CALL QB_TEST (?,?,?,?,'GETTOTALQUESTIONS',0,0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR); 
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll()); 
	 }
	 
	 public function getquestionanswers() {
		$stmt = $this->_db->prepare("CALL QB_TEST (?,?,?,?,'GETQUESTIONANSWERS',0,0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR); 
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll());		 		 
	 }	 
	 
	 public function getquestionanswerimages() {
		$stmt = $this->_db->prepare("CALL QB_TEST (?,?,?,?,'GETQUESTIONANSWERIMAGES',0,0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR); 
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll());		 		 
	 }
	 
	 public function clearanswers($questionbookmark) {
		$stmt = $this->_db->prepare("CALL QB_TEST (?,?,?,?,'CLEARANSWERS',?,0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR); 
		$stmt->bindValue(5, $questionbookmark, PDO::PARAM_STR); 
		
		$stmt->execute();		 
	 }
	 
	 public function addanswer($questionbookmark, $questionanswerid) {
		$stmt = $this->_db->prepare("CALL QB_TEST (?,?,?,?,'ADDANSWER',?,?)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR); 
		$stmt->bindValue(5, $questionbookmark, PDO::PARAM_STR); 
		$stmt->bindValue(6, $questionanswerid, PDO::PARAM_STR); 
		
		$stmt->execute();		 
	 }
	 
	 public function answerhistory($questionbookmark) {
		$stmt = $this->_db->prepare("CALL QB_TEST (?,?,?,?,'ANSWERHISTORY',?,0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR); 
		$stmt->bindValue(5, $questionbookmark, PDO::PARAM_STR); 
		
		$stmt->execute();
		 
		echo json_encode($stmt->fetchAll());
	 }

	 public function endblock() {
		$stmt = $this->_db->prepare("CALL QB_TEST (?,?,?,?,'ENDBLOCK',0,0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll());
	 }
	 
	 public function getremainingtime() {
		$stmt = $this->_db->prepare("CALL QB_TEST (?,?,?,?,'GETREMAININGTIME',0,0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR); 
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll()); 
	 }

	 public function statistics_gettestlist() {
		$stmt = $this->_db->prepare("CALL QB_TEST (?,?,?,?,'STATISTICS_GETTESTLIST',0,0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR); 
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll()); 
	 }	 
	 
	 public function statistics_getsubjectstatlist() {
		$stmt = $this->_db->prepare("CALL QB_TEST (?,?,?,?,'STATISTIC_GETSUBJECTSTATLIST',0,0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR); 
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll()); 
	 }	 
	 
	 public function statistics_getcategorystatlist() {
		$stmt = $this->_db->prepare("CALL QB_TEST (?,?,?,?,'STATISTIC_GETCATEGORYSTATLIST',0,0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR); 
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll()); 
	 }	 	 	 
	 
	 public function statistics_getsubjectstatrecentlist() {
		$stmt = $this->_db->prepare("CALL QB_TEST (?,?,?,?,'STATISTIC_GETSUBJECTSTATRECENTLIST',0,0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR); 
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll()); 
	 }	 
	 
	 public function statistics_getcategorystatrecentlist() {
		$stmt = $this->_db->prepare("CALL QB_TEST (?,?,?,?,'STATISTIC_GETCATEGORYSTATRECENTLIST',0,0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR); 
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll()); 
	 }	 
	 
 /* **********************************************************************************************************
  *		Below this point are questions dedicated to qbank administration.
  * ********************************************************************************************************* */ 
  	 public function createquestion_addanswerimage($questionid, $image, $imageexplaination) {
		$stmt = $this->_db->prepare("CALL QB_ADMINTEST (?,?,?,?,'ADDANSWERIMAGE','','','',?,'',?,?,'',0)");
		
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(5, $image, PDO::PARAM_STR);
		$stmt->bindValue(6, $questionid, PDO::PARAM_STR);
		$stmt->bindValue(7, $imageexplaination, PDO::PARAM_STR);
		
		$stmt->execute(); 
	 }
  
	 public function createquestion_addanswer($questionid, $answer, $answerexplaination, $correct) {
		$stmt = $this->_db->prepare("CALL QB_ADMINTEST (?,?,?,?,'ADDANSWER','','','','',?,?,?,?,0)");
		
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(5, $answer, PDO::PARAM_STR);
		$stmt->bindValue(6, $questionid, PDO::PARAM_STR);
		$stmt->bindValue(7, $answerexplaination, PDO::PARAM_STR);
		$stmt->bindValue(8, $correct, PDO::PARAM_STR);
		
		$stmt->execute(); 
	 }
	 
	 // Old create question function	 
	 public function createquestion($category, $subject, $question) {
		$stmt = $this->_db->prepare("CALL QB_ADMINTEST (?,?,?,?,'CREATEQUESTION',?,?,?,?,?,'','','',0)");
		
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(5, $category, PDO::PARAM_STR);
		$stmt->bindValue(6, $subject, PDO::PARAM_STR);
		$stmt->bindValue(7, $question, PDO::PARAM_STR);
		$stmt->bindValue(8, '', PDO::PARAM_STR);
		$stmt->bindValue(9, '', PDO::PARAM_STR);
		
		$stmt->execute();
		
		$questionid = $stmt->fetch(PDO::FETCH_OBJ);
		return $questionid->questionid;
	 }
	 
	 public function admin_gettotalquestions() {
		$stmt = $this->_db->prepare("CALL QB_ADMINTEST (?,?,?,?,'GETTOTALQUESTIONS',0,0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR); 
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll()); 
	 }
	 
 /* **********************************************************************************************************
  *		Below this point are questions dedicated to qbank administration.
  * ********************************************************************************************************* */
  
  	public function editquestion_getquestionlist($question, $category, $subject) {
		$stmt = $this->_db->prepare("CALL QB_ADMINTEST (?,?,?,?,'LISTQUESTIONS',?,?,?,'','','','','',0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR); 
		$stmt->bindValue(5, $category, PDO::PARAM_STR); 
		$stmt->bindValue(6, $subject, PDO::PARAM_STR); 
		$stmt->bindValue(7, $question, PDO::PARAM_STR); 
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll()); 		
	}
		  
  	public function editquestion_getquestiondetails($questionid) {
		$stmt = $this->_db->prepare("CALL QB_ADMINTEST (?,?,?,?,'GETQUESTIONDETAILS','','','','','',?,'','',0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR); 
		$stmt->bindValue(5, $questionid, PDO::PARAM_STR);
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll()); 		
	}
		  
  	public function editquestion_getquestionimages($questionid) {
		$stmt = $this->_db->prepare("CALL QB_ADMINTEST (?,?,?,?,'GETIMAGES','','','','','',?,'','',0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR); 
		$stmt->bindValue(5, $questionid, PDO::PARAM_STR);
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll()); 		
	}
	
		  
  	public function editquestion_getquestionanswers($questionid) {
		$stmt = $this->_db->prepare("CALL QB_ADMINTEST (?,?,?,?,'GETQUESTIONANSWERDETAILS','','','','','',?,'','',0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR); 
		$stmt->bindValue(5, $questionid, PDO::PARAM_STR);
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll());
	}
	
	public function editquestion_updatequestion($questionid, $subject, $category, $question){
		$stmt = $this->_db->prepare("CALL QB_ADMINTEST (?,?,?,?,'UPDATEQUESTION',?,?,?,'','',?,'','',0)");
		
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);		
		$stmt->bindValue(5, $category, PDO::PARAM_STR);
		$stmt->bindValue(6, $subject, PDO::PARAM_STR);
		$stmt->bindValue(7, $question, PDO::PARAM_STR);
		$stmt->bindValue(8, $questionid, PDO::PARAM_STR);
		
		$stmt->execute();		
	}
	
	public function editquestion_clearquestionimages($questionid) {
		$stmt = $this->_db->prepare("CALL QB_ADMINTEST (?,?,?,?,'CLEARQUESTIONIMAGES','','','','','',?,'','',0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(5, $questionid, PDO::PARAM_STR);
		
		$stmt->execute();
	}
	
	public function editquestion_clearquestionanswers($questionid) {
		$stmt = $this->_db->prepare("CALL QB_ADMINTEST (?,?,?,?,'CLEARQUESTIONANSWERS','','','','','',?,'','',0)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(5, $questionid, PDO::PARAM_STR);
		
		$stmt->execute();
	}	

  	 public function editquestion_readdanswerimage($questionid, $image, $imageexplaination) {
		$stmt = $this->_db->prepare("CALL QB_ADMINTEST (?,?,?,?,'READDANSWERIMAGE','','','',?,'',?,?,'',0)");
		
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(5, $image, PDO::PARAM_STR);
		$stmt->bindValue(6, $questionid, PDO::PARAM_STR);
		$stmt->bindValue(7, $imageexplaination, PDO::PARAM_STR);
		
		$stmt->execute(); 
	 }
	 
  	 public function editquestion_deletequestion($questionid) {
		$stmt = $this->_db->prepare("CALL QB_ADMINTEST (?,?,?,?,'DELETEQUESTION','','','','','',?,'','',0)");
		
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(5, $questionid, PDO::PARAM_STR);
		
		$stmt->execute(); 
	 }
	 

 /* **********************************************************************************************************
  *		Below this point are questions dedicated to test history review.
  * ********************************************************************************************************* */ 	 
  	 public function testreview_gettotalquestions($testhistoryid) {
		$stmt = $this->_db->prepare("CALL QB_TESTREVIEW (?,?,?,?,'GETTOTALQUESTIONS',?,'')");
		
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(5, $testhistoryid, PDO::PARAM_STR);
		
		$stmt->execute(); 
		echo json_encode($stmt->fetchAll());
	 }
	
	 public function testreview_getquestion($testhistoryid, $questionnumber) {
		$stmt = $this->_db->prepare("CALL QB_TESTREVIEW (?,?,?,?,'GETQUESTION',?,?)");
		
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(5, $testhistoryid, PDO::PARAM_STR);
		$stmt->bindValue(6, $questionnumber, PDO::PARAM_STR);
		
		$stmt->execute(); 
		echo json_encode($stmt->fetchAll());
	 } 
	
	 public function testreview_getquestionanswers($testhistoryid, $questionnumber) {
		$stmt = $this->_db->prepare("CALL QB_TESTREVIEW (?,?,?,?,'GETQUESTIONANSWERS',?,?)");
		
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(5, $testhistoryid, PDO::PARAM_STR);
		$stmt->bindValue(6, $questionnumber, PDO::PARAM_STR);
		
		$stmt->execute(); 
		echo json_encode($stmt->fetchAll());
	 } 
	 
	 		  
  	public function testreview_getquestionanswerimages($testhistoryid, $questionnumber) {
		$stmt = $this->_db->prepare("CALL QB_TESTREVIEW (?,?,?,?,'GETQUESTIONANSWERIMAGES',?,?)");
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR); 
		$stmt->bindValue(5, $testhistoryid, PDO::PARAM_STR);
		$stmt->bindValue(6, $questionnumber, PDO::PARAM_STR);
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll()); 		
	}	 
}
?>