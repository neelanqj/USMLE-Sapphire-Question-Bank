<?php 	
session_start() ;
	if(!isset($_COOKIE["passcode"])) {
		echo '<meta HTTP-EQUIV=REFRESH CONTENT="0; url=logout.view.php?msg=expired">';
	} ?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Edit Article</title>
    <link rel="icon" type="image/ico" href="../../logo.ico"></link> 
    <link rel="shortcut icon" href="../../logo.ico"></link>
    
    <!-- CSS File Library Includes -->
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap-responsive.css"/>   
    
    <!-- JavaScript Library Includes -->
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery/jquery-1.9.1.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/modernizr/modernizr-2.5.3.min.js'></script> 
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery-cookie/jquery.cookie.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/bootstrap/js/bootstrap.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/knockoutjs/knockout-2.2.1.js'></script> 
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/knockout.bindings.js'></script>     
    
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../../src/custom/css/page.css">
    <link rel="stylesheet" type="text/css" href="../../src/custom/css/editarticle.css"/>
    
    <!-- JavaScript Includes -->
	<script type="text/javascript" src="../../src/custom/js/apps/viewmodels/editarticle.viewmodel.js" defer></script>
    <script type="text/javascript" src="../../src/custom/js/apps/page/editarticle.page.js" defer></script>
    <script type="text/javascript" src='../../src/custom/js/page.js'></script> 
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
                            <h5>Edit Article</h5><br/><br/>
                        </div>
                  </div>
                </div>
                <div class="row-fluid text-center">
                    Use the search box on the left to find the question you wish to edit. Select it,<br/>
                    then use the question details on the right to edit it. Press Submit to save<br/>
                    the changes.
                </div> 

                <div class="row-fluid text-center">
                <hr/>
                </div>
                <div class="row-fluid">
                    <div id="content">
                        <div class="tabbable"> <!-- Only required for left/right tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active">
                                <a href="#tab" data-toggle="tab">Edit/Delete Article</a>
                                </li>
                                <li>
                                <a href="directpublisharticle.view.php">Add Article</a>
                                </li>
                            </ul>
                            <div id="results" class="tab-content">
                                <div class="tab-pane active" id="tab">
                                     <div class="row-fluid">       
                                    	<div class="span4 highlight">
                                            <b>Find a Article</b><br/>
                                            Containing the title ...<br/>
                                            <div class="input-append">
                                            <input class="span10" placeholder="Find Article" type="text" data-bind="value: search_article"/><button class="btn" href="#" data-bind="click: getArticleList"><i class="icon-search"></i></button>
                                            </div>
                                            <hr/>
                                            Hover over article button, to see article. Click the article button to edit/delete the article. Larger numbers are newer.
                                            <hr/>
                                            <ul data-bind="foreach: search_articleList">
                                            	<li>
                                                	<button type="button" data-bind="text: id, click: $parent.getArticle, bootstrapPopover : {content : title }, style: { color: id == $parent.currentArticle()?'red':'black' }" data-toggle="popover" data-placement="right" title="Article Title ..."></button> <span data-bind="text: title.substr(0,21) + ' ...'"></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="span8" data-bind="visible: !!currentArticle()">
                                        	<!-- In this div will be code for the question you are editing -->
                                            <div class="row-fluid">
                                            	<div class="span12 bold text-center">
                                            	Article <span data-bind="text: currentArticle"></span> Details 
                                                <a data-bind="click: deleteArticle" href="#">(Delete Article)</a>
                                                </div>
                                            </div>                                         
                                            <div class="row-fluid">
                                                <div class="span12 text-center bold">
                                                    <span class="bold">Article Title</span>
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span12 text-center">
                                                    <input type="text" data-bind="value: article().title" style="width:90%"/>
                                                </div>
                                            </div>                                         
                                            <div class="row-fluid">
                                                <div class="span12 text-center bold">
                                                    <span class="bold">Article</span>
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span12 text-center">
                                                    <textarea placeholder="Enter your article (min 200 letters)" data-bind='value: article().body' style="width:90%;height:200px;"></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="row-fluid">
                                                <div class="span12 text-center"><br/><br/><br/>
                                                    <button data-bind="click: updateArticle" class="btn btn-primary">Submit</button>
                                                    <br/><br/>
                                                </div>
                                            </div>                   
                                            <!-- End of question editing code -->
                                        </div>
                                    </div>
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