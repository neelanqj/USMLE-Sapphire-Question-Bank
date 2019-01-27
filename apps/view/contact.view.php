<?php session_start(); 
include_once '../controller/database.class.php';
include_once '../controller/userservice.class.php';

$pdo = Database::getConnection('write');

$userService = new UserService($pdo, '', '', '', '', '');

if (isset($_POST['submit'])){
	// this is what will happen if the forum has been submitted.
	$from = $_POST['email'];
	
	// Location of administrator's email.
	$to = "info@usmlesapphire.com";
	$subject = "USMLE Sapphire Contact Us Message From ".$_POST['name'];
	$comment = $_POST['comments'];
	
	if($userService->sendEmail($to, $from, $subject, $comment)) {
		header('Location: message.view.php?message=Your comment has been successfully submitted.&mood=positive');	
	}
} 

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Contact Us</title>
    <link rel="icon" type="image/ico" href="../../logo.ico"></link> 
    <link rel="shortcut icon" href="../../logo.ico"></link>    
    
    <!-- CSS File Library Includes -->
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap-responsive.css"/>
    
    <!-- JavaScript Library Includes -->
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery/jquery-1.9.1.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/bootstrap/js/bootstrap.js'></script>
    
    <!-- Custom JavaScript Library Includes -->
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/page.js'></script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../../src/custom/css/page.css">
    <link rel="stylesheet" type="text/css" href="../../src/custom/css/contact.css">
    
</head>
<body>
	<?php include("../view/headernav.inc.php"); ?>
     <div id="main">
    	<div id="hades">            
            <div class="row-fluid">
                  <div class="span12 text-center">    
                        <div class="row-fluid">
                        <br/><br/><br/><br/><br/>
                        	<img src="../../src/custom/img/contact.png">                 	
                        </div>
                        <div class="row-fluid">
                            <h5>Contact Us</h5>
                        </div>
                  </div>
            </div>
            <div class="row-fluid">
                <div class="span8 offset4 text-center">
                        <div class="span6"><br/><br/><br/>
                            You can contact us either via the forum below or by phone.
                        </div>            
                </div>
            </div>
         
         <!-- Beginning of the form -->
                <?php					
				if (!isset($_POST['submit'])) {
                ?>
                    <form action="contact.view.php" method="post">
                    <div class="row-fluid">
                        <div class="span8 offset4 text-center">
                            <div class="row-fluid"><div class="span6 text-center"><br/><br/>Name:</div></div>
                            <div class="row-fluid">
                                <div class="span6"><input type="text" name="name" class="input-medium" required/></div>
                            </div>
                            <div class="row-fluid"><div class="span6">Email:</div></div>
                            <div class="row-fluid">
                                <div class="span6"><input type="email" name="email" class="input-medium" required/></div>
                            </div>
                            <div class="row-fluid"><div class="span6">Message:</div></div>
                            <div class="row-fluid">                
                                <div class="span6">
                                <textarea name="comments" rows="10"  class="input-medium" required></textarea>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span6">
                                <input class="btn btn-inverse" type="submit" name="submit" value="Submit" />
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                    <?php
                    }
                    ?>	
		</div>
    </div>
    
    <div id="footer"></div>
</body>
</html>