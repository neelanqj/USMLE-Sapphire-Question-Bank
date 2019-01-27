<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Verification Page</title>
    <link rel="icon" type="image/ico" href="../../logo.ico"></link> 
    <link rel="shortcut icon" href="../../logo.ico"></link>  
        
    <!-- CSS File Library Includes -->
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap-responsive.css"/>
    
    <!-- JavaScript Library Includes -->
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery/jquery-1.9.1.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/bootstrap/js/bootstrap.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/knockoutjs/knockout-2.2.1.js'></script> 
    <script language="JavaScript" src="../../src/library/knockoutjs/knockout.validation.min.js"></script> 
        
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../../src/custom/css/page.css">
    
    <!-- JavaScript -->
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/page.js'></script> 
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/viewmodels/activate.viewmodel.js' defer></script>
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/page/activate.page.js' defer></script>  
        
</head>
<body>
	<?php include("../view/headernav.inc.php"); ?>
    
    <div id="main">
        <div class="row-fluid">
              <div class="span12 text-center">    
                    <div id="bigLogo" class="row-fluid">
                    </div>
                    <div class="row-fluid">
                        <h5>Verification Page.</h5>
                    </div>
              </div>
        </div>
        <div class="row-fluid">
            <div class="span8 offset4 text-center">
                    <div class="span6"><br/><br/><br/>
                        Please enter your email and the verification code you were sent along with your email in order to activate your account.
                    </div>
            </div>
        </div>
     
         <div class="row-fluid">
            <div class="span12 offset2 text-center"><br/><br/>
                    <div class="row-fluid">
                        <div class="span2">
                            <b>Enter Your Email Address &amp; Press Enter (dont forget!):</b>
                        </div>
                        <div class="span3">
                            <input id="hactivate" type="hidden" value="<?php echo $_GET['activate'] ?>" />
                            <input id="hcode" type="hidden" value="<?php echo $_GET['code'] ?>" />
                            <input id="hemail" type="hidden" value="<?php echo $_GET['email'] ?>" />
                            <input id="email" type="email" data-bind="value: email, valueUpdate: 'keypress', valueUpdate: 'blur'"/>
                        </div>
                        <div class="span3"><button class="btn btn-danger" data-bind="click: resendVerification, enable: String(email()).length > 1 && errors().length == 0">Resend Verification Code</button></div>
                    </div>
                                  
                    <div class="row-fluid">
                        <div class="span8 text-center"><br/>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span2">
                            <b>Enter Your Verification Code &amp; Press Enter (dont forget!):</b>
                        </div>
                        <div class="span3"> 
                            <input id="code" type="text" data-bind="value: vCode, valueUpdate: 'keydown'"/>
                        </div>
                        <div class="span3"></div>
                    </div>                
                    <div class="row-fluid">
                        <div class="span8 text-center"><br/>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span8 text-center"><br/><br/><br/>
                            <button class="btn btn-inverse" data-bind="click: activate, enable: errors().length == 0 && String(vCode()).length > 3 && String(email()).length > 1">Submit Verification</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
	<div id="footer"></div>
</body>
</html>
