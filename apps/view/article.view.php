<?php session_start(); 
require('../controller/database.class.php');
require('../controller/newsservice.class.php');

$pdo = Database::getConnection('read');
$newsservice = new NewsService($pdo,'','','','');
$results = $newsservice->getArticle($_GET['id']);

?>
<!DOCTYPE html>
<head>    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title><?php echo $results['title']; ?></title>
<link rel="icon" type="image/ico" href="../../logo.ico"></link> 
<link rel="shortcut icon" href="../../logo.ico"></link>
    
    <!-- CSS File Library Includes -->
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap-responsive.css"/>    
    <link rel="stylesheet" type="text/css" href="../../src/custom/css/page.css"/>    
    <link rel="stylesheet" type="text/css" href="../../src/custom/css/article.css"/>
    
    <!-- JavaScript Library Includes -->
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery/jquery-1.9.1.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/bootstrap/js/bootstrap.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/knockoutjs/knockout-2.2.1.js'></script>
    
    <!-- Custom Script -->
	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/page.js'></script>
</head>

<body>
	<?php include('headernav.inc.php'); ?>
    
    
    <div id="main">
            <div class="row-fluid">
                <div class="span12 padsides"> 
                        <h1><?php echo $results['title']; ?></h1><br/>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12 padsides">
                    Written By: <?php echo $results['author'] . ', ' . $results['createdate']; ?>
                </div>
            </div>
            <hr/>
            
            <div id="articlebody">
                <div class="row-fluid">
                    <div class="span12 padsides">
                        <?php echo $results['body']; ?>
                    </div>
                </div>	
            </div>
    </div> 
    <div id="footer"></div>
</body>
</html>
