<?php session_start(); ?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Search</title>
<link rel="icon" type="image/ico" href="../../logo.ico"></link> 
<link rel="shortcut icon" href="../../logo.ico"></link>
    
    <!-- CSS File Library Includes -->
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap-responsive.css"/>    
    <link rel="stylesheet" type="text/css" href="../../src/custom/css/page.css"/>
    
    <!-- JavaScript Library Includes -->
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery/jquery-1.9.1.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery-cookie/jquery.cookie.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/bootstrap/js/bootstrap.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery-getUrlParam/jquery.getUrlParam.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/knockoutjs/knockout-2.2.1.js'></script>
    
    <!-- Custom Script -->
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/viewmodels/unreviewedarticles.viewmodel.js' defer></script>  
   	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/page/unreviewedarticles.page.js' defer></script>
	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/page.js'></script>

</head>

<body>
	<?php include('headernav.inc.php'); ?>
        <div id="main">
            <div id="hades">
                <!-- Logo -->
                <div class="row-fluid">
                  <div class="span12 text-center">    
                        <div id="bigLogo" class="row-fluid">
                        </div>
                        <div class="row-fluid">
                            <h5>Unreviewed Article List.</h5><br/><br/>
                        </div>
                  </div>
                </div>
                
                <table class="table table-striped center-table span7">
                    <thead>
                        <th>User ID</th><th>Title</th><th>Author</th><th>Body</th><th></th>
                    </thead>
                    <tbody data-bind="template: { name: 'review-row', foreach: unreviewedArticleList }">
                    </tbody>
                </table>
                <div class="text-center" data-bind="visible: unreviewedArticleList().length < 1">
                <br/><br/>
                No Articles To Review
                </div>
		</div>
    </div>
        
    <div id="footer"></div>
    
    <script type="text/html" id="review-row">
		<tr>
		<td data-bind="text: id"></td>
		<td data-bind="text: title"></td>
		<td data-bind="text: author"></td>
		<td data-bind="text: body"></td>
		<td><a href="#" data-bind="click: $root.publishArticle">Publish</a> <a href="#" data-bind="click: $root.deleteArticle">Delete</a></td>
		</tr>
    </script>
</body>
</html>