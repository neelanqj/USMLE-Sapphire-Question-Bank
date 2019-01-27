<?php session_start();
require('../controller/database.class.php');
require('../controller/newsservice.class.php');

$pdo = Database::getConnection('read');

$newsservice = new NewsService($pdo,'','','','');

$newsservice->goToArticleAddress($_GET['id']);
?>

<html>
<head>
<meta name="description" content="Monster Creative Studio Offers Website, Mobile, Graphics and Video Design" />

<link rel="canonical" href="http://www.monstercreativestudio.com" />

<meta property="og:title" content="Marketing Development for Businesses" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://www.monstercreativestudio.com" />
<meta property="og:image" content="http://www.monstercreativestudio.com/src/img/monster-miniicon.gif" />
<meta property="og:site_name" content="Monster Creative Studio" />
<meta property="fb:admins" content="75408333052" />
<meta property="og:description" content="Monster Creative Studio Offers Website, Mobile, Graphics and Video Design" />
<meta name="twitter:card" value="summary" />
<meta name="twitter:description" value="Monster Creative Studio Offers Website, Mobile, Graphics and Video Design" />
</head>
<body>
</body>
</html>