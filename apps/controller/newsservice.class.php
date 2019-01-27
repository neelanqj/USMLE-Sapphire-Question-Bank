<?php

class NewsService
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
	 
	 public function search($category, $searchterm, $pagenum, $perpage) {
		$stmt = $this->_db->prepare("CALL NS_ARTICLE_SEARCH (?,?,?,'SEARCH','',?,?,?,?)");
	
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(4, $category, PDO::PARAM_INT);
		$stmt->bindValue(5, $searchterm, PDO::PARAM_INT);
		$stmt->bindValue(6, $pagenum, PDO::PARAM_STR);	
		$stmt->bindValue(7, $perpage, PDO::PARAM_STR);	
		
		$stmt->execute();

		echo json_encode($stmt->fetchAll());
	 } 
	 
	 public function searchCount($category, $searchterm, $pagenum, $perpage) {
		$stmt = $this->_db->prepare("CALL NS_ARTICLE_SEARCH (?,?,?,'COUNT','',?,?,?,?)");
	
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(4, $category, PDO::PARAM_INT);
		$stmt->bindValue(5, $searchterm, PDO::PARAM_INT);
		$stmt->bindValue(6, $pagenum, PDO::PARAM_STR);	
		$stmt->bindValue(7, $perpage, PDO::PARAM_STR);	
		
		$stmt->execute();

		echo json_encode($stmt->fetchAll());
	 }	 
	 
	 public function submitArticle($category, $title, $article) {
		$stmt = $this->_db->prepare("CALL NS_ARTICLE (?,?,?,?,'SUBMITARTICLE',?,?,'',?,'')");
	
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR); 
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(5, $title, PDO::PARAM_STR);
		$stmt->bindValue(6, $category, PDO::PARAM_INT);
		$stmt->bindValue(7, $article, PDO::PARAM_STR);	
		
		$stmt->execute();

		echo json_encode($stmt->fetchAll());
	 }
	 
	 public function submitLink($category, $title, $link) {
		$stmt = $this->_db->prepare("CALL NS_ARTICLE (?,?,?,?,'SUBMITLINK',?,?,?,'','')");
	
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR); 
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(5, $title, PDO::PARAM_STR);
		$stmt->bindValue(6, $category, PDO::PARAM_INT);
		$stmt->bindValue(7, $link, PDO::PARAM_STR);	
		
		$stmt->execute();

		echo json_encode($stmt->fetchAll());
	 }	 
	 
	 public function directPublishArticle($category, $title, $article) {
		$stmt = $this->_db->prepare("CALL NS_ARTICLE (?,?,?,?,'DIRECTPUBLISHARTICLE',?,?,'',?,'')");
	
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR); 
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(5, $title, PDO::PARAM_STR);
		$stmt->bindValue(6, $category, PDO::PARAM_INT);
		$stmt->bindValue(7, $article, PDO::PARAM_STR);	
		
		$stmt->execute();

		echo json_encode($stmt->fetchAll());
	 }
	 
	 public function directPublishLink($category, $title, $link) {
		$stmt = $this->_db->prepare("CALL NS_ARTICLE (?,?,?,?,'DIRECTPUBLISHLINK',?,?,?,'','')");
	
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR); 
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(5, $title, PDO::PARAM_STR);
		$stmt->bindValue(6, $category, PDO::PARAM_INT);
		$stmt->bindValue(7, $link, PDO::PARAM_STR);	
		
		$stmt->execute();

		echo json_encode($stmt->fetchAll());
	 }
	 
	 public function getArticleTitle($linkid) {
		$stmt = $this->_db->prepare("CALL NS_ARTICLE (0,0,0,0,'DISPLAYARTICLETITLE','','','','',?)");
		
		$stmt->bindValue(1, $linkid, PDO::PARAM_INT);
		
		$stmt->execute();
		echo json_encode($stmt->fetchAll());
	 }	 
	 
	 public function getArticle($linkid) {
		$stmt = $this->_db->prepare("CALL NS_ARTICLE (0,0,0,0,'DISPLAYARTICLE','','','','',?)");
		
		$stmt->bindValue(1, $linkid, PDO::PARAM_INT);
		
		$stmt->execute();
		
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			return $row;
		}
	 }	 
	 
	 public function addComment($comment, $articleid, $pcommentid) {
		$stmt = $this->_db->prepare("CALL NS_COMMENT (?,?,?,?,'ADDCOMMENT',?,?,?, 1, 50)");
	
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_STR);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR); 
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(5, $comment, PDO::PARAM_INT);
		$stmt->bindValue(6, $articleid, PDO::PARAM_INT);
		$stmt->bindValue(7, $pcommentid, PDO::PARAM_STR);	
		
		$stmt->execute();

		echo json_encode($stmt->fetchAll());
	 }
	 
	 public function editComment($comment, $commentid) {
		$stmt = $this->_db->prepare("CALL NS_COMMENT (?,?,?,?,'EDITCOMMENT',?,'',?, 1, 50)");
	
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_STR);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR); 
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(5, $comment, PDO::PARAM_INT);
		$stmt->bindValue(6, $pcommentid, PDO::PARAM_STR);	
		
		$stmt->execute();

		echo json_encode($stmt->fetchAll());
	 }
	 
	 public function listComments($articleid) {
		$stmt = $this->_db->prepare("CALL NS_COMMENT (?,?,?,?,'LISTCOMMENTS','',?,'', 1, 50)");
	
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_STR);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR); 
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(5, $articleid, PDO::PARAM_INT);	
		
		$stmt->execute();

		echo json_encode($stmt->fetchAll());
	 }
	 
	 public function listCommentsCount($articleid) {
		$stmt = $this->_db->prepare("CALL NS_COMMENT (?,?,?,?,'LISTCOMMENTSCOUNT','',?,'', 1, 50)");
	
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_STR);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR); 
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(5, $articleid, PDO::PARAM_INT);	
		
		$stmt->execute();

		echo json_encode($stmt->fetchAll());
	 }
	 
	 public function goToArticleAddress($linkid) {
		$stmt = $this->_db->prepare("CALL NS_ARTICLE (0,0,0,0,'GETARTICLEREDIRECT','','','','',?)");
		$stmt->bindValue(1, $linkid, PDO::PARAM_INT);
		
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($row['linktype'] == 2) {
			header('Location: article.view.php?id='.$row['articleid']);
		} elseif($row['linktype'] == 1) {
			header('Location:'. $row['link']);
		}
	 }
	 
	 public function unreviewedArticleList() {
		$stmt = $this->_db->prepare("CALL NS_ARTICLE (?,?,?,?,'UNREVIEWEDLIST','','','','','')");
		
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_STR);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR); 
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll());
	 }
	 
	 public function deleteUnreviewed($linkid) {
		$stmt = $this->_db->prepare("CALL NS_ARTICLE (?,?,?,?,'DELETEUNREVIEWED','','','','',?)");
	
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_STR);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR); 
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(5, $linkid, PDO::PARAM_STR);
		
		$stmt->execute();

		echo json_encode($stmt->fetchAll());
	 }
	 
	 public function publishUnreviewed($linkid) {
		$stmt = $this->_db->prepare("CALL NS_ARTICLE (?,?,?,?,'PUBLISHUNREVIEWED','','','','',?)");
	
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_STR);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR); 
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(5, $linkid, PDO::PARAM_STR);
		
		$stmt->execute();

		echo json_encode($stmt->fetchAll());
	 }	 
	 
	 public function newestannouncement() {
		$stmt = $this->_db->prepare("CALL NS_ARTICLE (0,'','','','NEWESTANNOUNCEMENT','','','','',0)");
	
		$stmt->execute();

		echo json_encode($stmt->fetchAll());
	 } 	 
	 
	 public function updateArticle($linkid, $title, $body) {
		$stmt = $this->_db->prepare("CALL NS_ARTICLE (?,?,?,?,'UPDATEARTICLE',?,'','',?,?)");
	
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_STR);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR); 
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);		
		$stmt->bindValue(5, $title, PDO::PARAM_STR);
		$stmt->bindValue(6, $body, PDO::PARAM_STR);
		$stmt->bindValue(7, $linkid, PDO::PARAM_STR);
		
		$stmt->execute();

		echo json_encode($stmt->fetchAll());
	 }	 	 
	 
	 
	 public function deleteArticle($linkid) {
		$stmt = $this->_db->prepare("CALL NS_ARTICLE (?,?,?,?,'DELETEARTICLE','','','','',?)");
	
		$stmt->bindValue(1, $this->_userID, PDO::PARAM_STR);
		$stmt->bindValue(2, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_sessionid, PDO::PARAM_STR); 
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);
		$stmt->bindValue(5, $linkid, PDO::PARAM_STR);
		
		$stmt->execute();

		echo json_encode($stmt->fetchAll());
	 }	 
	 	 
}
?>