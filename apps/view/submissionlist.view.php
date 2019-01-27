<?php 
	session_start() ;
	if(!isset($_COOKIE["passcode"])) {
		echo '<meta http-equiv="expired cookie" content="logout.view.php?msg=expired">';
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Submit Article</title>
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
    
    <!-- JavaScript Includes -->
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/page.js'></script> 
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/viewmodels/submitarticle.viewmodel.js' defer="defer"></script>
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/page/submitarticle.page.js' defer="defer"></script>
    
</head>

<body>
		<?php 
		if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) { 
		include("../view/headernav.inc.php"); ?>
        
        <div class="row-fluid">
          <div class="span12 text-center">    
                <div id="bigLogo" class="row-fluid">
                </div>
                <div class="row-fluid">
                    <h5>Submission List</h5><br/><br/>
                </div>
                <div class="row-fluid">
                    Below is a list of the articles and links you submitted.<br/><br/>
                </div>
          </div>
        </div>
        <div class="row-fluid">
            <div class="span8 offset4 text-center">
                <div class="span6">
                    <div class="row-fluid">
                        <div class="span12">
                            <hr/>Articles and Links<hr/>
                        </div>
                    </div>
                    <div class="row-fluid">                      	
                        <div class="span12">

                        </div>
                    </div>                       
                </div>              
            </div>
        </div>
        
   		<div id="footer"></div>
        
        
        
    <?php 
	}?>

</body>
</html>