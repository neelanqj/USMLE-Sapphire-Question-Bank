<?php 
	session_start() ;
	if(!isset($_COOKIE["passcode"])) {
		echo '<meta HTTP-EQUIV=REFRESH CONTENT="0; url=logout.view.php?msg=expired">';
		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Edit Question</title>
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
    
    <!-- JavaScript Includes -->
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/page.js'></script> 
    
</head>

<body>
		<?php 
		if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) { 
		include("../view/headernav.inc.php"); ?>
            
        <div id="main">
            <div id="hades">               
                <div class="row-fluid">
                  <div class="span12 text-center">    
                        <div id="bigLogo" class="row-fluid">
                        </div>
                        <div class="row-fluid">
                            <h5>Edit Question</h5><br/><br/>
                        </div>
                  </div>
                </div>
                <div class="row-fluid text-center">
                    Please type in the first few sentences of the question you would like to edit
                </div> 

                <div class="row-fluid text-center">
                <hr/>
                </div>
                <div class="row-fluid">
                    <div id="content">
                        <div class="tabbable"> <!-- Only required for left/right tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active">
                                <a href="#tab" data-toggle="tab">Edit Question</a>
                                </li>
                                <li>
                                <a href="#tab2" data-toggle="tab">Add Question</a>
                                </li>
                            </ul>
                            <div id="results" class="tab-content">
                                <div class="tab-pane active" id="tab">
                                    <div class="row-fluid text-center">
                                        <br/>
                                        <input placeholder="Find Question" type="text" />
                                        <br/>
                                        <a class="btn btn-primary" href=#>Search</a>
                                        <hr/>
                                    </div>
                                    
                                    
                                </div>
                                <div class="tab-pane" id="tab2">
                                    Detective2
                                </div>
                            </div>
                    	</div>
                    </div>
                </div>
        	</div>
            </div>
		<?php 
        }?>
        
        <div id="footer"></div>

</body>
</html>