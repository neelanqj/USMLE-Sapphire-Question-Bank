<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Verification Page</title>
    <link rel="icon" type="image/ico" href="../../favicon.ico"></link> 
    <link rel="shortcut icon" href="../../favicon.ico"></link>    
    
    <!-- CSS File Library Includes -->
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap-responsive.css"/>
    
    <!-- JavaScript Library Includes -->
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery/jquery-1.9.1.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/bootstrap/js/bootstrap.js'></script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../../src/custom/css/page.css">
    
</head>
<body>
		<?php include("../view/headernav.inc.php"); ?>
        
        <div class="row-fluid">
              <div class="span12 text-center">    
              		<div class="row-fluid">
                    	<img src="../../src/custom/img/logo/Logo.png" />
                    </div>
                    <div class="row-fluid">
                		Please enter the verification information sent to your phone and email.
            		</div>
              </div>
        </div>
        <div class="row-fluid">
            <div class="span8 offset4 text-center">
                	<div class="span3">
	                    <div class="row-fluid">
                    		Phone Code
                        </div>
                        <div class="row-fluid">
                        	<input type="text" id="skills"> 
                        </div>
                    </div>
                    <div class="span3">
	                    <div class="row-fluid">
                    		 Email Code
                        </div>
                        <div class="row-fluid">
                        	<input type="text" id="location">
                        </div>
                    </div>            
            </div>
         </div>

     	<div class="row-fluid">
          	<div class="span12 text-center">
        		<a href="" type="button" class="btn btn-primary" id="search-btn" data-loading-text="Loading...">Confirm</a>
			</div>
        </div>
        
     </div>
        
	 <?php include("../view/footer.inc.php"); ?>        
</body>
</html>
