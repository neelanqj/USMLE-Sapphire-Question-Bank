<?php
// Initialize the session.
// If you are using session_name("something"), don't forget it now!
session_start();

include_once '../controller/database.class.php';
include_once '../controller/userservice.class.php';

$pdo = Database::getConnection('write');

$email = isset($_SESSION['email'])?$_SESSION['email']:'';
$password = isset($_SESSION['password'])?$_SESSION['password']:'';
$passcode = isset($_SESSION['passcode'])?$_SESSION['passcode']:'';

$userService = new UserService($pdo, $email, $password, session_id(), $_SERVER['REMOTE_ADDR'], $passcode);
$userService->logout();

// Finally, destroy the session.
session_destroy();
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Job Search</title>
    <link rel="icon" type="image/ico" href="../../favicon.ico"></link> 
    <link rel="shortcut icon" href="../../favicon.ico"></link>
    
    <!-- CSS File Library Includes -->
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap-responsive.css"/>
    
    <!-- JavaScript Library Includes -->
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery/jquery-1.9.1.js'></script>    
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery-cookie/jquery.cookie.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/bootstrap/js/bootstrap.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery-getUrlParam/jquery.getUrlParam.js'></script>
        
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../../src/custom/css/page.css">
    
</head>
<body>
<?php include("../view/headernav.inc.php"); ?>
        
        <div id="main" class="row-fluid">
            <div class="span8 offset4 text-center">
                	<div class="span6"><br/><br/><br/>
						<b>You Have Been Logged Out.</b><br/><br/>
                        <b>Why?</b><br/> There are three possible reasons:<br/><br/>
                        1) You chose to logout by clicking the logout button,<br/><br/>
                        2) someone logged into your account from a different location,<br/><br/>
                        3) your session expired (sessions expire after 30 minutes).<br/><br/>
                        
						Why does the logout screen look like this and lack customized logout screens?<br/>
						I got lazy ...
                    </div>            
            </div>
         </div>
     </div>

	<script language="JavaScript" type="text/javascript">
        $("#message").text($(document).getUrlParam("message").replace(/%20/g," "));
    </script>

</body>
</html>
