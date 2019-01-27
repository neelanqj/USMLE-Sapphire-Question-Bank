<?php
session_start();
include_once '../controller/database.class.php';
include_once '../controller/userservice.class.php';

$pdo = Database::getConnection('read');

// Generate a temp passcode
$_SESSION['passcode'] = substr(md5(rand()), 0, 100);
$userService = new UserService($pdo, $_POST['email'], $_POST['password'], session_id(), $_SERVER['REMOTE_ADDR'], $_SESSION['passcode']);
if ($userService->login()) {
	//echo 'Accessing Server<br/>';
	if($userService->checkCredentials()) {
		//echo 'Logged In<br/>';
		header('Location: mainall.view.php');
	}
	// do stuff
} 
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>USMLE Sapphire</title>

    <link rel="icon" type="image/ico" href="../../logo.ico"></link> 
    <link rel="shortcut icon" href="../../logo.ico"></link>
    
    <!-- CSS File Library Includes -->
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap-responsive.css"/>    
    <link rel="stylesheet" type="text/css" href="../../src/custom/css/page.css"/>    
    <link rel="stylesheet" type="text/css" href="../../src/custom/css/mainall.css"/>
    
    <!-- JavaScript Library Includes -->
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery/jquery-1.9.1.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/modernizr/modernizr-2.5.3.min.js'></script>   
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery-cookie/jquery.cookie.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/bootstrap/js/bootstrap.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/knockoutjs/knockout-2.2.1.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/knockout.bindings.js'></script>  
    
    <!-- Custom Script --> 
	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/viewmodels/mainall.viewmodel.js' defer></script>
	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/page/mainall.page.js' defer></script>
	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/page.js'></script>
    
    <link rel="stylesheet" type="text/css" href="../../src/library/slider/src/css/slider.css"/>
    <script language="JavaScript" type="text/javascript" src='../../src/library/slider/src/js/custom/slider.js'></script>
    <style>
		#content {
			background-image:url("../../src/custom/img/MSF.jpg");
			background-size:100% 100%;
		}
		#message {
			background-color: red;
			width:30%;
			height:61%;
			margin: auto auto;
			text-align: center;
		}
	</style>
</head>

<body>
    <?php include('headernav.inc.php'); ?>
    <div id="content" class="row-fluid">	
	
		<div id="message">
		<br/><br/>
		<b>Invalid Login</b><br/><br/> or Your Account Has Not Been Activated<br/><br/> <a href="http://usmlesapphire.com/apps/view/signup.view.php">Click HERE To Sign Up For FREE</a><br/> or<br/> 
		<a href="activate.view.php">Click HERE To Activate Your Account</a>
		</div>
	</div>
    <div id="footer"></div>


</body>
</html>