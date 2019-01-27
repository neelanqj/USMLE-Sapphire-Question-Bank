<?php 
	session_start();
	if(!isset($_COOKIE["passcode"])) {
		echo '<meta http-equiv="expired cookie" content="logout.view.php?msg=expired">';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Change Password</title>
    <link rel="icon" type="image/ico" href="../../logo.ico"></link> 
    <link rel="shortcut icon" href="../../logo.ico"></link>
    
    <!-- CSS File Library Includes -->
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap-responsive.css"/>
    
    <!-- JavaScript Library Includes -->
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery/jquery-1.9.1.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery-cookie/jquery.cookie.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/bootstrap/js/bootstrap.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/knockoutjs/knockout-2.2.1.js'></script>  
    
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../../src/custom/css/page.css">      
    
    <!-- JavaScript Script -->
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/page.js'></script>   
	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/viewmodels/changepassword.viewmodel.js' defer></script>  
   	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/page/changepassword.page.js' defer></script>
</head>

<body>
	<?php require_once 'headernav.inc.php'; 
	 if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) { ?>
        <div id="main">
            <div id="hades">                    
                <!-- Logo -->
                <div class="row-fluid">
                  <div class="span12 text-center">    
                        <div id="bigLogo" class="row-fluid">                    	
                        </div>
                        <div class="row-fluid">
                            Change Password.<br/><br/><br/><br/><br/>
                        </div>
                  </div>
                </div>
                
                <!-- email and password -->
                <div class="row-fluid">
                    <div class="span8 offset4 text-center">
                        <div class="span6">
                            <div class="row-fluid">
                                Enter Old Password
                            </div>
                            <div class="row-fluid text-center">
                                <input id="oldpassword" name="oldpassword" type="password" class="span6" data-bind="value: oldpassword" />
                                <br/><br/>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- email and password -->
                <div class="row-fluid">
                    <div class="span8 offset4 text-center">
                        <div class="span6">
                            <div class="row-fluid">
                                Enter New Password
                            </div>
                            <div class="row-fluid">
                                <input id="password" name="password" type="password" class="span12" data-bind="value: password" />
                            </div>        
                        </div>
                    </div>
                </div>


                <div class="row-fluid">
                    <div class="span8 offset4 text-center">
                        <div class="span6">
                            <div class="row-fluid">
                                Re-Enter New Password
                            </div>
                            <div class="row-fluid">
                                <input id="password2" name="password2" type="password" class="span12" data-bind="value: password2" />
                            </div>       
                        </div>
                    </div>
                </div>
                                
                
                
                <div class="row-fluid">
                    <div class="span12 text-center"><br/><br/>
                        <a class="btn btn-inverse" value="Update" data-bind="click: changePassword">Change Password</a>
                    </div>
                </div> 
       		</div>
       </div>     
            
	<?php 
     } ?>
             
	<div id="footer"></div>
         
</body>
</html>