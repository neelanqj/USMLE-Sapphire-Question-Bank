<?php session_start(); ?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>USMLE Sapphire - Whats happening online?</title>

<link rel="icon" type="image/ico" href="../../logo.ico"></link> 
<link rel="shortcut icon" href="../../logo.ico"></link>
    
    <!-- CSS File Library Includes -->
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap-responsive.css"/>    
    <link rel="stylesheet" type="text/css" href="../../src/custom/css/page.css"/>
    <link rel="stylesheet" type="text/css" href="../../src/custom/css/search.css">
    
    <!-- JavaScript Library Includes -->
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery/jquery-1.9.1.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/modernizr/modernizr-2.5.3.min.js'></script>   
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery-cookie/jquery.cookie.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/bootstrap/js/bootstrap.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery-getUrlParam/jquery.getUrlParam.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/knockoutjs/knockout-2.2.1.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/knockout.bindings.js'></script>  
    
    <!-- Custom Script -->
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/viewmodels/search.viewmodel.js' defer></script>  
   	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/page/search.page.js' defer></script>
	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/page.js'></script>

</head>

<body>
	<?php include('headernav.inc.php'); ?>

     <div id="main">
    	<div id="hades"> 
            <div id="titlenews" class="hidden-phone">
                <a href="/apps/view/article.view.php?id=357">      
                    <div class="titleconfig">
                    </div>
                    <div class="titlenewstext" data-bind="text: newestannouncement">
                    </div>
                </a>
            </div>
            <div class="row-fluid">
                <div id="container" data-bind="visible: linkList().length > 0, template: { name: 'article-row',  foreach: linkList }">
                </div>
            </div>
            
            <div class="row-fluid">
                <div id="loading" class="text-center" data-bind="scroll: linkList().length < 100, scrollOptions: { loadFunc: scrolled, offset: 10 }">  
                    <img src="../../src/custom/img/mini-loading.gif"/>
                </div>
            </div>
            
            <div class="row-fluid" data-bind="visible: linkList().length == 0">
                <div class="span12 text-center"> No Articles<br/><br/><br/><br/></div>
           </div>
           
        	<br/><br/><br/>
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
           
		</div>
    </div>

    <div class="row-fluid">
        <div id="footer"></div>
    </div>
    
    <!-- Templates -->
	<script type="text/html" id="article-row">	
			<div class="item">
				<div class="fluid-row">
					<div class="span12" data-bind="text: 'category: ' + category"></div>
				</div>

				<div class="fluid-row">
					<h3><a data-bind="text: title, attr: { href: (linktype == 1)? httplink :'article.view.php?id=' + id }" target="_blank"></a></h3>
				</div>
				<div class="fluid-row">
					<img data-bind="attr: { src: pathname }" />
				</div>
				<div class="fluid-row fbottom">

					<a data-bind="attr: { href: 'comments.view.php?id=' + id }, text: 'comments (' + numcomments + ') '"></a><br/>

					<a class="twitter_ico pull-left" data-bind="attr: { href: 'http://twitter.com/share?text=' + title +' @USMLESapphire&url=http://usmlesapphire.com/apps/view/link.view.php?id=' + id }"></a>
					<a class="facebook_ico pull-left "  data-bind="attr: { href: 'https://www.facebook.com/sharer/sharer.php?u=http://usmlesapphire.com/apps/view/link.view.php?id=' + id +'&p[images][0]=http://usmlesapphire.com/src/custom/img/Logo.jpg&p[title]=' + title + ' @USMLESapphire' }"></a>
					<a class="linkedin_ico pull-left" data-bind="attr: { href: 'http://www.linkedin.com/shareArticle?mini=true&url=http://usmlesapphire.com/apps/view/link.view.php?id=' + id + '&title=' + title + ' @USMLESapphire' }"></a><br/><br/>
					<span data-bind="text: createdate"></span>
				</div>
			</div>
    </script>
    
    <script type="text/html" id="pagination-item">
           <li data-bind="attr: { 'class': ($data == $root.pagenum())?'active':'' }">
		   		<a data-bind="text: $data, click: $root.setPage"></a>
		   </li>
    </script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42820320-1', 'peoot.com');
  ga('send', 'pageview');

</script>
</body>
</html>