<?php session_start(); ?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="keywords" content="usmle step 1" />
<meta name="twitter:description" content="USMLE Sapphire is a free USMLE Step 1 clinical vintage question bank.">
<meta name="description" content="USMLE Sapphire is a free USMLE Step 1 clinical vintage question bank.">
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
    
	<!-- WhY YoU LoOk At My CoDe YoU!? Me No LoOk At Ur CoDeZ! NaRf!!! -->
</head>

<body>
    <?php include('headernav.inc.php'); ?>

    <div id="channels" class="row-fluid hidden-phone hidden-tablet">   
    	<div class="slider">
            <ul>
                <li>
                    <a href="/apps/view/qbanksetup.view.php">
                    	<img src="../../src/custom/img/slider1.jpg" data-time="10000" width="950px">
                    </a>
                </li>
                <li>
                    <a href="/apps/view/search.view.php">
                    	<img src="../../src/custom/img/slider2.jpg" data-time="5000" width="950px">
                    </a>
                </li>
                <li><a href="/apps/view/contact.view.php"><img src="../../src/custom/img/slider3.jpg" data-time="5000" width="950px" ></a></li>
                <li><a href="/apps/view/mystatistics.view.php"><img src="../../src/custom/img/slider5.jpg" data-time="5000" width="950px" ></a></li>
                <li><a href="https://www.youtube.com/channel/UCBeLjeEySD00tyjSJrepHEA"><img src="../../src/custom/img/slider7.jpg" data-time="5000" width="950px" ></a></li>
            </ul>
            <div id="slider-nav"></div>
    	</div>

	</div>
    
    <div id="content" class="row-fluid">
        <div class="span1  hidden-phone">
        </div>
    	<div class="span4 box-border hidden-phone">
        	<center>
            <br/><br/>
        	<img src="../../src/custom/img/anonymous-doctor.jpg">
            <br/><br/><br/>
            </center>
        </div>

        <div class="span3 box-border">
        	<div id="row-fluid">
            	<h3>Recent News</h3>
	        </div>
            <div id="dataloading" class="dataloading"></div>
            <div class="row-fluid" data-bind="visible: linkList().length > 0, template: { name: 'article-row',  foreach: newsList }"></div>
            
            <div class="row-fluid text-center">
            	<br/>
            	<a class="btn btn-primary" href="/apps/view/search.view.php">More NEWS</a>
            </div>            
        </div>
        
        <div class="span3 box-border hidden-tablet">
        	<div id="row-fluid">
            	<h3>Announcements</h3>
            </div>
            <div id="dataloading" class="dataloading"></div>
            <div class="row-fluid" data-bind="visible: linkList().length > 0, template: { name: 'article-row',  foreach: linkList }"></div>
            
            <div class="row-fluid text-center">
            	<br/>
            	<a class="btn btn-primary" href="/apps/view/search.view.php">More NEWS</a>
            </div>
        </div>
                
        <div class="span1  hidden-phone"></div>
    </div>
    
    <div id="footer"></div>

	<script>
    	var container = $('div.slider').css('overflow', 'hidden').children('ul');
    	var slider = new Slider( container, $('#slider-nav') );
        
        slider.start();
    </script>
    
    <!-- Templates -->
	<script type="text/html" id="article-row">	
			<div class="news-item">
				<div class="fluid-row">
					<b><a data-bind="text: title, attr: { href: (linktype == 1)? httplink :'/apps/view/article.view.php?id=' + id }" target="_blank"></a></b>
				</div>
				<!--<div class="fluid-row">
					<div class="span12" data-bind="text: 'category: ' + category"></div>
				</div>-->
				<span data-bind="text: createdate"></span>
			</div>
    </script>

</body>
</html>