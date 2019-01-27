<?php

class UserService
{
    protected $_email;    // using protected so they can be accessed
    protected $_password; // and overidden if necessary
	protected $_ipaddress;
	protected $_passcode;
	protected $_sessionid;

    protected $_db;       // stores the database handler
    protected $_user;     // stores the user data

	// Login Credentials
    public function __construct(PDO $db, $email, $password, $sessionid, $ipaddress, $passcode) 
    {
		//echo "Class Userservice.<br/>";
		$this->_db = $db;
		$this->_email = $email;
		$this->_password = $password;
		$this->_sessionid = $sessionid;
		$this->_ipaddress = $ipaddress;
		$this->_passcode = $passcode;		
    }

    public function login()
    {
		//echo "Class Userservice ... login()<br/>";
		
		// if cookies are not enabled, you will not be able to log in
		if (!isset($_COOKIE["PHPSESSID"])) {
			header('Location: logout.view.php?message=You must enable cookies in order to use this website..');
		}
		
		$stmt = $this->_db->prepare("CALL NS_USERCREDENTIALS (?, 'LOGIN', ?, ?, ?, ?)");
		
		$stmt->bindParam(1, $this->_email, PDO::PARAM_STR, 200);
		$stmt->bindParam(2, $this->_sessionid, PDO::PARAM_STR, 200);
		$stmt->bindParam(3, $this->_password, PDO::PARAM_STR, 200);
		$stmt->bindParam(4, $this->_ipaddress, PDO::PARAM_STR, 200);
		$stmt->bindParam(5, $this->_passcode, PDO::PARAM_STR, 200);
		
		$stmt->execute();
		
		if( $stmt->fetch(PDO::FETCH_ASSOC)) {
			return true;
		}
        return false;
    }

    public function checkCredentials()
    {
		$stmt = $this->_db->prepare("CALL NS_USERCREDENTIALS (?, 'VERIFY', ?, ?, ?, ?)");
		
		$stmt->bindParam(1, $this->_email, PDO::PARAM_STR, 200);
		$stmt->bindParam(2, $this->_sessionid, PDO::PARAM_STR, 200);
		$stmt->bindParam(3, $this->_password, PDO::PARAM_STR, 200);
		$stmt->bindParam(4, $this->_ipaddress, PDO::PARAM_STR, 200);
		$stmt->bindParam(5, $this->_passcode, PDO::PARAM_STR, 200);
		
		$stmt->execute();

		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		
        if ($stmt->rowCount() > 0 && $user['status'] != 0) {			
				$this->_user = $user; // store it so it can be accessed later
				//echo "USER ID >> ".$user['uid']."<br/>";
				$_SESSION['user_id'] = $user['uid'];
				$_SESSION['email'] = $this->_email;
				$_SESSION['password'] = $this->_password;
				$_SESSION['name'] = $user['name'];
				
				setcookie('accounttype', $user['accounttype'], time() + 41000, '/');
				setcookie('email', $this->_email, time() + 41000, '/');
				setcookie('passcode', $this->_passcode, time() + 41000, '/');
				setcookie('ipaddress', $this->_ipaddress, time() + 41000, '/');
				setcookie('user_id', $user['uid'], time() + 41000, '/');
				setcookie('name', $user['name'], time() + 41000, '/');
				
            if ($this->_email == $user['email']) {
                return $user;
            }
        }
        return false;
    }

    public function getUser()
    {
        return $this->_user;
    }
	
	// User Signup
	public function signupUser(
							   $email
							   , $password1
							   , $password2
							   , $phone
							   , $firstname
							   , $lastname
							   , $region
							   , $city
							   , $country
							   , $postalcode
							   ) 
	 {	
		if ($password1 == $password2 
			&& !empty($password1)
			&& !empty($phone) 
			&& !empty($firstname) 
			&& !empty($lastname) 
			&& !empty($country)
			&& !empty($postalcode)) {

				$stmt = $this->_db->prepare("CALL NS_USER (?,?,'SIGNUPUSER',?,?,?,'','',?,?,?,?,'','','',?,'','','','','','')");

				$stmt->bindParam(1, $email, PDO::PARAM_STR, 200);
				$stmt->bindParam(2, $password1, PDO::PARAM_STR, 200);
				$stmt->bindParam(3, $sessionid, PDO::PARAM_STR, 200);
				$stmt->bindParam(4, $firstname, PDO::PARAM_STR, 200);
				$stmt->bindParam(5, $lastname, PDO::PARAM_STR, 200);
				$stmt->bindParam(6, $postalcode, PDO::PARAM_STR, 200);
				$stmt->bindParam(7, $country, PDO::PARAM_STR, 200);
				$stmt->bindParam(8, $region, PDO::PARAM_STR, 200);
				$stmt->bindParam(9, $city, PDO::PARAM_STR, 200);
				$stmt->bindParam(10, $phone, PDO::PARAM_STR, 200);
				$stmt->execute();
				
				$this->_email = $email;
				
				return 1;			
		} else {
			echo '[{"success": "0"}]';
		}
		return 0;
	}
	
	public function sendEmail($to, $from, $subject, $comment) {
		// this is what will happen if the forum has been submitted.
		$header = "From: $from";
		$message = "$comment";
		
		if($subject){
			 if($from){
				 if($comment){

					 mail($to, $subject, $message, $header);
					 return true;
				 }else{
					 echo "<div class='text-center'><br/><br/><br/>Please enter a comment.</div>";
				 }
			 }else{
				 echo "<div class='text-center'><br/><br/><br/>Please enter an email.</div>";
			 }
		 } else {
			 echo "<div class='text-center'><br/><br/><br/>Please enter a name.</div>";
		 }
		 return 0;
	}
	
	public function getEmailAuthentication() {
			$authenticationcode = substr(md5(rand()), 0, 10);

			$stmt = $this->_db->prepare("CALL NS_USER (?,'','STOREFORGOTPASSWORDVCODE',?,'','','','','','','','','','','','','',?,?,'','','')");

			$stmt->bindParam(1, $this->_email, PDO::PARAM_STR, 200);
			$stmt->bindParam(2, $this->_sessionid, PDO::PARAM_STR, 200);
			$stmt->bindParam(3, $authenticationcode, PDO::PARAM_STR, 200);
			$stmt->bindParam(4, $this->_ipaddress, PDO::PARAM_STR, 200);
			$stmt->execute();
			
			// this is what will happen if the forum has been submitted.
			$from = "noreply@usmlesapphire.com";
			
			// Location of administrator's email.
			$to = $this->_email;
			$subject = "USMLE Sapphire Email Authentication Code";
			$comments = "(check your spam folder) This is your email authentication code: ".$authenticationcode."
Enter your code at the following link in order to gain the ability to reset your password. 
http://usmlesapphire.com/apps/view/forgotpassword.view.php";
			
			$this->sendEmail($to, $from, $subject, $comments);
			
			echo json_encode($stmt->fetchAll());
			return 1;
		}
		
	public function changeForgottenPassword($newpassword, $newpassword2, $authenticationcode)
	{
		if ($newpassword == $newpassword2 && strlen($newpassword) > 5 && strlen($authenticationcode) > 3) {
				$stmt = $this->_db->prepare("CALL NS_USER (?,'','CHANGEFORGOTTENPASSWORD','','<fname>','<lname>','<education>','<careerlvl>','<postalcode>','<country>','<region>','<city>',null,null,null,'<phone>','<userid>',?,'',?,'','')");

				$stmt->bindParam(1, $this->_email, PDO::PARAM_STR, 200);
				$stmt->bindParam(2, $authenticationcode, PDO::PARAM_STR, 200);
				$stmt->bindParam(3, $newpassword, PDO::PARAM_STR, 200);
				
				$stmt->execute();
				
				echo json_encode($stmt->fetchAll());
				return 1;
		}
		
		echo '[{"success":"0"}]';
		return 0;
	}
	
	public function generateActivationCode() {
			$vcode = substr(md5(rand()), 0, 10);
			$email = $this->_email;
			$comments = '(Check your spam folder) This is your verification code: '.$vcode.'
Below is a link to activate your account:        
http://usmlesapphire.com/apps/view/activate.view.php?email='.$email.'&code='.$vcode.'&activate=1';
			
			$to = $email;
			
			$subject = "USMLE Sapphire Login Activation";

			$header = "From: verify@usmlesapphire.com\r\nReply-To: verify@usmlesapphire.com\r\n";
			$message = "$comments";
			
			$stmt = $this->_db->prepare("CALL NS_USERCREDENTIALS (?, 'STOREVCODE', ?, ?, ?, ?)");
		
			$stmt->bindParam(1, $this->_email, PDO::PARAM_STR, 200);
			$stmt->bindParam(2, $this->_sessionid, PDO::PARAM_STR, 200);
			$stmt->bindParam(3, $this->_password, PDO::PARAM_STR, 200);
			$stmt->bindParam(4, $this->_ipaddress, PDO::PARAM_STR, 200);
			$stmt->bindParam(5, $vcode, PDO::PARAM_STR, 200);
			
			$stmt->execute();
		
			mail($to, $subject, $message, $header);
			echo '[{"success":"1"}]';
			
			return 1;
	}
	
	public function activateAccount($vcode) {		
			$stmt = $this->_db->prepare("CALL NS_USERCREDENTIALS (?, 'ACTIVATEEMPLOYEE', ?, ?, ?, ?)");
		
			$stmt->bindParam(1, $this->_email, PDO::PARAM_STR, 200);
			$stmt->bindParam(2, $this->_sessionid, PDO::PARAM_STR, 200);
			$stmt->bindParam(3, $this->_password, PDO::PARAM_STR, 200);
			$stmt->bindParam(4, $this->_ipaddress, PDO::PARAM_STR, 200);
			$stmt->bindParam(5, $vcode, PDO::PARAM_STR, 200);
			
			$stmt->execute();
			echo json_encode($stmt->fetchAll());
			return 1;
	}
	
	public function updateUser(
							   $email
							   , $password1
							   , $password2
							   , $phone
							   , $firstname
							   , $lastname
							   , $region
							   , $city
							   , $country
							   , $postalcode
							   , $careerlvl
							   , $education
							   , $uid
							   ) 
	 {
		if ($password1 == $password2 
			&& !empty($password1)
			&& !empty($firstname) 
			&& !empty($lastname) 
			&& !empty($country)
			&& !empty($postalcode)) {
				$stmt = $this->_db->prepare("CALL NS_USER (?,?,'UPDATEUSER',?,?,?,?,?,?,?,?,?,null,null,null,?,?,?,?,'','','')");

				$stmt->bindParam(1, $email, PDO::PARAM_STR, 200);
				$stmt->bindParam(2, $this->_password, PDO::PARAM_STR, 200);
				$stmt->bindParam(3, $this->_sessionid, PDO::PARAM_STR, 200);
				$stmt->bindParam(4, $firstname, PDO::PARAM_STR, 200);
				$stmt->bindParam(5, $lastname, PDO::PARAM_STR, 200);
				$stmt->bindParam(6, '', PDO::PARAM_STR, 200);
				$stmt->bindParam(7, '', PDO::PARAM_STR, 200);
				$stmt->bindParam(8, $postalcode, PDO::PARAM_STR, 200);
				$stmt->bindParam(9, $country, PDO::PARAM_STR, 200);
				$stmt->bindParam(10, $region, PDO::PARAM_STR, 200);
				$stmt->bindParam(11, $city, PDO::PARAM_STR, 200);
				$stmt->bindParam(12, $phone, PDO::PARAM_STR, 200);
				$stmt->bindParam(13, $uid, PDO::PARAM_STR, 200);
				$stmt->bindParam(14, $this->_passcode, PDO::PARAM_STR, 200);
				$stmt->bindParam(15, $this->_ipaddress, PDO::PARAM_STR, 200);
				$stmt->execute();
				
				echo json_encode($stmt->fetchAll());
				return 1;
		}
		echo "FAILED USER UPDATE<br/>";
		return 0;
	}
	
	public function changePassword($newpassword, $newpassword2)
	{
		if ($newpassword == $newpassword2 && strlen($newpassword) > 5) {
				$stmt = $this->_db->prepare("CALL NS_USER (?,?,'CHANGEPASSWORD',?,'<fname>','<lname>','<education>','<careerlvl>','<postalcode>','<country>','<region>','<city>',null,null,null,'<phone>','<userid>',?,?,?,?,'')");

				$stmt->bindParam(1, $this->_email, PDO::PARAM_STR, 200);
				$stmt->bindParam(2, $this->_password, PDO::PARAM_STR, 200);
				$stmt->bindParam(3, $this->_sessionid, PDO::PARAM_STR, 200);
				$stmt->bindParam(4, $this->_passcode, PDO::PARAM_STR, 200);
				$stmt->bindParam(5, $this->_ipaddress, PDO::PARAM_STR, 200);
				$stmt->bindParam(6, $newpassword, PDO::PARAM_STR, 200);
				$stmt->bindParam(7, $newpassword2, PDO::PARAM_STR, 200);
				$stmt->execute();
				
				echo json_encode($stmt->fetchAll());
				return 1;
		}
		
		echo '[{"success":"0"}]';
		return 0;
	}
	
	public function userDetails($uid) 
	{
		$stmt = $this->_db->prepare("CALL NS_USER_DETAIL ('DETAILS',?,?)");
		
		$stmt->bindParam(1, $uid, PDO::PARAM_STR, 200);
		$stmt->bindParam(2, $this->_sessionid, PDO::PARAM_STR, 200);
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll());
	}
	
	public function userDetailsAdvanced( $userid ) 
    {
		$stmt = $this->_db->prepare("CALL NS_USER (?,'','USERDETAILS',?,'<fname>','<lname>', '<education>','<career>','<zip>','<country>','<region>','<city>',null,null,null,null,?,?,?,'','','')");

		$stmt->bindParam(1, $this->_email, PDO::PARAM_STR, 200);
		$stmt->bindParam(2, $this->_sessionid, PDO::PARAM_STR, 200);
		$stmt->bindParam(3, $userid, PDO::PARAM_STR, 200);
		$stmt->bindParam(4, $this->_passcode, PDO::PARAM_STR, 200);
		$stmt->bindParam(5, $this->_ipaddress, PDO::PARAM_STR, 200);
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll());
	 }
	 
	// User Signup
	public function addSkill(
							   $name
							   , $experience
							   , $lastused
							   )
	 {
		$stmt = $this->_db->prepare("CALL NS_USER_SKILL (?,'ADDSKILL',?,?,?,?,?,?)");
		$stmt->bindValue(1, $this->_email, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);		
		$stmt->bindValue(5, $name, PDO::PARAM_STR);
		$stmt->bindValue(6, $experience, PDO::PARAM_INT);
		$stmt->bindValue(7, $lastused, PDO::PARAM_BOOL);
		$stmt->execute();
	 }
	 	
	public function removeSkill($name)
	 {
		$stmt = $this->_db->prepare("CALL NS_USER_SKILL (?,'ADDSKILL',?,?,?,?,'','')");
		$stmt->bindValue(1, $this->_email, PDO::PARAM_INT);
		$stmt->bindValue(2, $this->_sessionid, PDO::PARAM_STR);
		$stmt->bindValue(3, $this->_passcode, PDO::PARAM_STR);
		$stmt->bindValue(4, $this->_ipaddress, PDO::PARAM_STR);		
		$stmt->bindValue(5, $name, PDO::PARAM_STR);
		$stmt->execute();
	 }
	 
	public function userSkills($uid) 
	 {
		$stmt = $this->_db->prepare("CALL NS_USER_DETAIL ('SKILLS', ?)");
		
		$stmt->bindParam(1, $uid, PDO::PARAM_STR, 200);
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll());
	 }	 
	 
	 public function search($careerlvl, $education, $skills, $location, $filter, $pagenum, $perpage)
	 {
		$stmt = $this->_db->prepare("CALL NS_USER_SEARCH ('SEARCH',?,?,?,?,?,?,?)");
		$stmt->bindValue(1, $filter, PDO::PARAM_STR);
		$stmt->bindValue(2, $education, PDO::PARAM_STR);
		$stmt->bindValue(3, $careerlvl, PDO::PARAM_STR);
		$stmt->bindValue(4, $skills, PDO::PARAM_INT);
		$stmt->bindValue(5, $location, PDO::PARAM_INT);
		$stmt->bindValue(6, $pagenum, PDO::PARAM_INT);
		$stmt->bindValue(7, $perpage, PDO::PARAM_INT);
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll());
	 }	 	
	 
	 	 
	 public function searchCount($careerlvl, $education, $skills, $location, $filter, $pagenum, $perpage)
	 {
		$stmt = $this->_db->prepare("CALL NS_USER_SEARCH ('COUNT',?,?,?,?,?,?,?)");
		$stmt->bindValue(1, $filter, PDO::PARAM_STR);
		$stmt->bindValue(2, $education, PDO::PARAM_STR);
		$stmt->bindValue(3, $careerlvl, PDO::PARAM_STR);
		$stmt->bindValue(4, $skills, PDO::PARAM_INT);
		$stmt->bindValue(5, $location, PDO::PARAM_INT);
		$stmt->bindValue(6, $pagenum, PDO::PARAM_INT);
		$stmt->bindValue(7, $perpage, PDO::PARAM_INT);
		$stmt->execute();
		
		echo json_encode($stmt->fetchAll());
	 }	 	 
	 
	public function logout()
    {	
		$stmt = $this->_db->prepare("CALL NS_USERCREDENTIALS (?, 'LOGOUT', ?, ?, ?, ?)");
		$stmt->bindParam(1, $this->_email, PDO::PARAM_STR, 200);
		$stmt->bindParam(2, $this->_sessionid, PDO::PARAM_STR, 200);
		$stmt->bindParam(3, $this->_password, PDO::PARAM_STR, 200);
		$stmt->bindParam(4, $this->_ipaddress, PDO::PARAM_STR, 200);
		$stmt->bindParam(5, $this->_passcode, PDO::PARAM_STR, 200);
		
		$stmt->execute();
		
		// clear memory variables
		
		$_SESSION['user_id'] = NULL;
		$_SESSION['email'] = NULL;
		$_SESSION['password'] = NULL;
		setcookie('accounttype', '', -4100, '/');
		setcookie('email', '', -4100, '/');
		setcookie('passcode', '', -4100, '/');
		setcookie('ipaddress', '', -4100, '/');
		setcookie('user_id', '', -4100, '/');
		
		echo "<script>setTimeout(function(){ location.href='mainall.view.php'; },7000)</script>";
		return true;
    }
	
}
?>