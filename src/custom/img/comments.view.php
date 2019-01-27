<?php session_start(); ?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Comments</title>
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
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/viewmodels/comments.viewmodel.js' defer="defer"></script>
   	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/page/comments.page.js' defer="defer"></script>
	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/page.js'></script>
</head>

<body>
    <?php include('headernav.inc.php'); ?>
    
    <div class="row-fluid">
        <div class="span12 text-center">    
            <div id="bigLogo" class="row-fluid">
            </div>
            <div class="row-fluid text-center">
            	<a href="http://PEooT.com/apps/view/link.view.php?id=" data-bind="attr: { href: 'http://PEooT.com/apps/view/link.view.php?id=' + articleid() }" target="_blank"><h2 data-bind="text: title"></h2></a>
            </div>
            <div class="row-fluid">
                <h5>Comments.</h5><br/><br/>
            </div>
        </div>
    </div>
    <hr/>
    
    <div class="container" data-bind="visible: commentList().length > 0, template: { name: 'comment-row',  foreach: commentList }"></div>
    <div class="row-fluid" data-bind="visible: commentList().length == 0">
        <div class="span12 text-center"> No Comments<br/><br/><br/><br/> </div>
	</div>

     <!-- pagination -->
     <div class="row-fluid">
     	<div class="span12 text-center">
            <div class="pagination">
              <ul>
                <li data-bind="attr: { 'class': (pagenum() == 1)?'disabled':'' }"><a data-bind="click: prevPage">Prev</a></li>
                <li data-bind="attr: { 'class': (pagenum() == totalpages() || totalpages() == 0)?'disabled':'' }"><a data-bind="click: nextPage">Next</a></li>
              </ul>
            </div>        
        </div>
     </div>
     
     <div class="row-fluid">
    	<div class="span12 text-center">
           <div class="pagination">
             <ul data-bind="template: { name: 'pagination-item',  foreach: ko.utils.range(1, totalpages()) }"></ul>
           </div>
		</div>
    </div>
    <!-- end pagination -->

   <div class="row-fluid">
    	<div class="span12 text-center" data-bind="visible: $.cookie('accounttype')">
            <textarea class="span6" rows="5" data-bind="value: comment"></textarea><br/>
            <button class="btn btn-inverse" data-bind="click: addComment">Post Comment</button>
        </div>
        <div class="span12 text-center" data-bind="visible: !$.cookie('accounttype')">
            <textarea class="span6" rows="5" disabled>You must be logged in to comment.</textarea><br/>
            <button class="btn btn-inverse" disabled>Post Comment</button>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span12" id="footer"></div>
    </div>
    
    <!-- Templates -->
	<script type="text/html" id="comment-row">
			<div class="alert alert-info">
				<div class="fluid-row">
					<span data-bind="text: comment"></span>
				</div>
				<button type="button" class="close" data-dismiss="alert">Hide</button>
				<div class="fluid-row">					
					<span data-bind="text: author + ', ' + createdate"></span>					
				</div>
				
			</div>
    </script>
    
    <script type="text/html" id="pagination-item">
           <li data-bind="attr: { 'class': ($data == $root.pagenum())?'active':'' }">
		   		<a data-bind="text: $data, click: $root.setPage"></a>
		   </li>
    </script>
</body>
</html>
