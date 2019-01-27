<?php 
	session_start() ;
	if(!isset($_COOKIE["passcode"])) {
		echo '<meta HTTP-EQUIV=REFRESH CONTENT="0; url=logout.view.php?msg=expired">';
	}
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>USMLE Question Bank</title>

    <link rel="icon" type="image/ico" href="../../logo.ico"></link> 
    <link rel="shortcut icon" href="../../logo.ico"></link>
    
    <!-- CSS File Library Includes -->
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap-responsive.css"/>    
    <link rel="stylesheet" type="text/css" href="../../src/custom/css/page.css"/>
    
    <!-- JavaScript Library Includes -->
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery/jquery-1.9.1.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/modernizr/modernizr-2.5.3.min.js'></script>   
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery-cookie/jquery.cookie.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/bootstrap/js/bootstrap.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/knockoutjs/knockout-2.2.1.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/knockout.bindings.js'></script>    
    
    <!-- Custom Script --> 
	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/viewmodels/qbanksetup.viewmodel.js' defer></script>
	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/page/qbanksetup.page.js' defer></script>
	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/page.js'></script>
    <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-57026418-1', 'auto');
	  ga('send', 'pageview');
	
	</script>
    <link rel="stylesheet" type="text/css" href="../../src/custom/css/qbanksetup.css">
</head>

<body>
	<?php include('headernav.inc.php'); ?>
    <img id="loading" class="centerimage hide" src="../../src/custom/img/animate/loading2.gif" />

    <div id="channels" class="row-fluid">
        <div id="floater" class="hidden-phone"></div>
    	<div class="row-fluid">
        	<div class="span1 hidden-phone"></div>
            <div class="span11"><h2>Create Your Test<br class="hidden-desktop" /> <a href="mystatistics.view.php">(View Your Test History &amp; Statistics)</a></h2></div>
        </div>
        
    	<div class="row-fluid">
            <div style="height:300px;padding-left:20px;" class="span2 hidden-phone">
            </div>
            
            <div class="span3">
                <b>By Subject</b> 
                <button id="btn_bysubjecthelp" type="button" class="btn-xs btn-danger" data-toggle="popover" data-placement="bottom" title="By Subject" data-content="Select the checkboxes for the subjects you want questions from.">?</button> 
                <ul>
                	<li><input data-bind="checked: allsubjects" type="checkbox"> (All) </li>
                	<li><input data-bind="checked: clearsubjects" type="checkbox"> (Clear) </li>
                </ul>
                <ul data-bind="template: { name: 'subject-item',  foreach: questionsubjects() }">
                </ul>
            </div>
            
            <div class="span3">
                <b>By System</b> 
                <button id="btn_bysystemhelp" class="btn-xs btn-danger" data-toggle="popover" data-placement="bottom" title="By System" data-content="Select the checkboxes for the system you want questions from. This is a subcategory of subjects">?</button> 
                <ul>
                	<li><input data-bind="checked: allcategories" type="checkbox"> (All) </li>
                	<li><input data-bind="checked: clearcategories" type="checkbox"> (Clear) </li>
                </ul>
                <ul data-bind="template: { name: 'system-item',  foreach: questioncategories() }">
                </ul>
            </div>
            
            <div class="span3">
                <b>Questions Mode</b> 
                <button id="btn_questionmodehelp" class="btn-xs btn-danger" data-toggle="popover" data-placement="bottom" title="Questions Mode"  data-content="Select what type of questions you want on your test. You can use All, the questions you previously got Incorrect, or Unused questions you haven't answered previously. Incorrect and unanswered questions are questions you got wrong in all of the tests you've completed.">?</button> 
                <ul>
                    <li><input type="radio" name="questionstouse" value="all" data-bind="checked: questiontype"> All</li>
                    <li><input type="radio" name="questionstouse" value="unused" data-bind="checked: questiontype"> Unused</li>
					<li><input type="radio" name="questionstouse" value="incorrect" data-bind="checked: questiontype"> Incorrect/Unanswered</li>    
                </ul>
            </div>
            
            <div class="span3 form-inline">
                <b>Mode</b> 
                <button id="btn_modehelp" class="btn-xs btn-danger" data-toggle="popover" data-placement="bottom" title="Mode"  data-content="Select whether you want a timed test or not.">?</button> 
                <ul>
                    <li><input type="radio" name="testmode" value="timed" data-bind="checked: testmode"> Timed</li>
                    <li><input type="radio" name="testmode" value="not timed" data-bind="checked: testmode"> Not Timed</li>
                </ul>
                <br/>
                <b>Questions</b>
                <button id="btn_questionshelp" class="btn-xs btn-danger" data-toggle="popover" data-placement="bottom" title="Questions"  data-content="Select how many questions you want on the test. If you select a number that is bigger than the amount of questions we have in the subject and categories you selected. You'll only get the number of questions we have on file.">?</button> 
                <br/>
                <input type="text" class="input-small" data-bind="value: questioncount, valueUpdate: 'input'"> 
                <br/><br/>
                Test Length (Minutes) 
                <button id="btn_lengthhelp" class="btn-xs btn-danger" data-toggle="popover" data-placement="bottom" title="Test Length (Minutes)"  data-content="This is an automatically populated field. You have one minute per question. This will pace you to answer questions at the rate that you have to for the USMLE Step 1. However, if you selected untimed mode, you will have unlimited time to complete this test.">?</button> 
                <br/>
                <input type="text" class="input-small" data-bind="value: testtime" disabled> 
                               
            </div>            
        </div>
        <div class="row-fluid">
            <div class="span12 text-center">
            	<br class="visible-phone" />
                <br class="visible-phone" />
                <button type="button" class="btn btn-primary" data-bind="click: checkTestSetup, enable: startEnabled()">Start Test</button>
                <br/><br/>
            </div>
        </div>
	</div>
 
    <div id="footer"></div>

    <!-- Modal -->
    <div class="modal hide" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Are You Sure You Want To Start The Test?</h4>
          </div>
          <div class="modal-body" data-bind="text: modalText">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Exit</button>
            <a href="test.view.php" class="btn btn-primary" target="_blank" 
            data-bind="visible: startEnabled, text: 'Start The Test', click: startTest"></a>
          </div>
        </div>
      </div>
    </div>

    <!-- Templates -->
	<script type="text/html" id="subject-item">
		<li>
			<input type="checkbox" data-bind="checked:$parent.questionsubjectsselected, value:name"> <span data-bind="text:name"></span>
		</li>
    </script>
    
	<script type="text/html" id="system-item">
		<li>
			<input type="checkbox" data-bind="checked:$parent.questioncategoriesselected, value:name"> <span data-bind="text:name"></span>
		</li>
    </script>
</body>
</html>