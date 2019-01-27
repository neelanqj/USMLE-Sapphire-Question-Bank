<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Forgot Password</title>
    <link rel="icon" type="image/ico" href="../../favicon.ico"></link> 
    <link rel="shortcut icon" href="../../favicon.ico"></link>
    
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
    
    <script src="../../src/library/knockoutjs/knockout.validation.min.js"></script> 
    <!-- JavaScript Script -->
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/page.js'></script>  
	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/viewmodels/forgotpassword.viewmodel.js'></script>  
   	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/page/forgotpassword.page.js' defer></script>
</head>

<body>
	<?php require_once 'headernav.inc.php'; ?>
    
    <div id="main">
        <!-- Logo -->
        <div class="row-fluid">
          <div class="span12 text-center">    
                <div id="bigLogo" class="row-fluid">
                </div>
                <div class="row-fluid">
                    Forgot Password?<br/><br/><br/>
                </div>
          </div>
        </div>
    
    
        <!-- email and password -->  
        <div class="row-fluid">
            <div class="span8 offset4 text-center">
                <div class="span6">
                    <div class="row-fluid">
                        Enter Email Address (press enter after email entered to enable the authentication button)
                    </div>
                    <div class="row-fluid">
                        <label><input id="email" name="email" type="email" class="span6" data-bind="value: email, valueUpdate: 'keyup', valueUpdate: 'blur'" /></label>
                    </div>   
                </div>
            </div>
        </div>
        
            
        <div class="row-fluid">
            <div class="span8 offset4 text-center">
                <div class="span6">
                    <div class="row-fluid">
                        <br/><br/>
                        <button class="btn btn-danger" data-bind="click: getAuthenticationCode, enable: errors().length == 0 && String(email()).length > 1">Get Authetication Code</button>
                        <br/><br/><br/>
                    </div>
                </div>
            </div> 
        </div>
        
        <!-- email and password -->
        <div class="row-fluid">
            <div class="span8 offset4 text-center">
                <div class="span6">
                    <div class="row-fluid">
                        Enter Authentication Code
                    </div>
                    <div class="row-fluid text-center">
                        <input id="code" name="code" type="text" class="span6" data-bind="value: authenticationcode, valueUpdate: 'keyup', valueUpdate: 'blur'" />
                        <br/><br/>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- email and password -->
        <div class="row-fluid">
            <div class="span8 offset4 text-center">
                <div class="span6">
                Your new password should be more than FIVE (5) characters long.
                </div>
            </div>
        </div>
        
        <div class="row-fluid">
            <div class="span12 offset2 text-center">
                <div class="span4">
                    <div class="row-fluid">
                        Enter New Password
                    </div>
                    <div class="row-fluid">
                        <input id="password" name="password" type="password" class="span12" data-bind="value: newpassword" />
                    </div>        
                </div>
                <div class="span4">
                    <div class="row-fluid">
                        Re-Enter New Password
                    </div>
                    <div class="row-fluid">
                        <input id="password2" name="password2" type="password" class="span12" data-bind="value: reenternewpassword" />
                    </div>       
                </div>
            </div>
        </div>
        
        <div class="row-fluid">
            <div class="span12 text-center"><br/><br/>
                <button class="btn btn-inverse" value="Update" data-bind="click: resetPassword, enable: String(email()).length > 5 && String(newpassword()).length !='' && String(reenternewpassword()).length !='' && String(authenticationcode()).length > 5">Change Password</button>
            </div>
        </div> 
    </div>
	<div id="footer"></div>
</body>
</html>