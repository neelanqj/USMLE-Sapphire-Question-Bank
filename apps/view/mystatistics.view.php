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
	<title>Your Test History &amp; Statistics</title>

    <link rel="icon" type="image/ico" href="../../logo.ico"></link> 
    <link rel="shortcut icon" href="../../logo.ico"></link>
    
    <!-- CSS File Library Includes -->
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap-responsive.css"/>    
    <link rel="stylesheet" type="text/css" href="../../src/custom/css/page.css"/>
    <link rel="stylesheet" type="text/css" href="../../src/custom/css/mystatistics.css"/>
    
    <!-- JavaScript Library Includes -->
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery/jquery-1.9.1.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/modernizr/modernizr-2.5.3.min.js'></script>   
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery-cookie/jquery.cookie.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/bootstrap/js/bootstrap.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/knockoutjs/knockout-2.2.1.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/knockout.bindings.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery-getUrlParam/jquery.getUrlParam.js'></script>        
    
    <!-- Custom Script --> 
	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/viewmodels/mystatistics.viewmodel.js' defer></script>
	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/page/mystatistics.page.js' defer></script>
	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/page.js'></script>
    
</head>

<body>
	<?php 
	if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) { 
	include('headernav.inc.php'); ?>
    <img id="loading" class="centerimage hide" src="../../src/custom/img/animate/loading2.gif" />
    
    <div class="titleconfig hidden-phone">
        <div id="title">Test History &amp;<br/><br/>Statistics</div>
    </div>

    <div id="content">
        <div class="tabbable"> <!-- Only required for left/right tabs -->
        <ul class="nav nav-tabs">
            <li id="stab1" class="active"><a href="#tab" data-toggle="tab">Test Statistics (Most Recent Test)</a></li>
            <li id="stab2"><a href="#tab2" data-toggle="tab">Test Statistics (Overall)</a></li>
            <li id="stab3"><a href="#tab3" data-toggle="tab">Test History &amp; Study</a></li>
        </ul>
        <div id="results" class="tab-content">
            <div class="tab-pane active" id="tab">
                <h1>Test Statistics (Most Recent Test)</h1><hr/>
                <div data-bind="visible: subjectStatRecentList().length == 1 && subjectStatRecentList()[0].subject == '0'">
                    <center>
                    	No Test Statistics Available
                    </center>
                </div>
                <div data-bind="visible: subjectStatRecentList().length >= 1 && subjectStatRecentList()[0].subject != '0'">
                <h3>Breakdown by Subject</h3><hr/>
                <table class="table">
                    <thead class="heavy">
                        <tr>
                            <td>Percent of Questions Correct</td>
                            <td>Subject</td>
                        </tr>
                    </thead>
                    <tbody data-bind="foreach: subjectStatRecentList">
                        <tr>
                            <td>
                                <div class="progress">
                                  <div class="bar" data-bind="text: stat + '% (out of ' + totalquestions + ' questions)', style: { width: stat + '%' }"></div>
                                </div>
                            </td>
                            <td data-bind="text: subject"></td>
                        </tr>                
                    </tbody>
                    </table><br/><br/>
                    
                    <h3>Breakdown by Category</h3><hr/>
                    <table class="table">
                    <thead class="heavy">
                        <tr>
                            <td>Percent of Questions Correct</td>
                            <td>Category</td>
                        </tr>
                    </thead>
                    <tbody data-bind="foreach: categoryStatRecentList">
                        <tr>
                            <td>
                                <div class="progress">
                                  <div class="bar" data-bind="text: stat + '% (out of ' + totalquestions + ' questions)', style: { width: stat + '%' }"></div>
                                </div>
                            </td>
                            <td data-bind="text: category"></td>
                        </tr>                
                    </tbody>
                </table>
                </div>
                <br/><br/>
              
            </div>
            <div class="tab-pane" id="tab2">
                <h1>Test Statistics (Overall)</h1><hr/>
                
                <div data-bind="visible: subjectStatList().length == 0">
                	<center>
	                	No Test Statistics Available
                    </center>
                </div>
                <div>
                <h3>Breakdown by Subject</h3><hr/>
                <table class="table">
                    <thead class="heavy">
                        <tr>
                            <td>Percent of Questions Correct</td>
                            <td>Subject</td>
                        </tr>
                    </thead>
                    <tbody data-bind="foreach: subjectStatList">
                        <tr>
                            <td>
                                <div class="progress">
                                  <div class="bar" data-bind="text: stat + '%', style: { width: stat + '%' }"></div>
                                </div>
                            </td>
                            <td data-bind="text: subject"></td>
                        </tr>                
                    </tbody>
                    </table><br/><br/>
                    
                    <h3>Breakdown by Category</h3><hr/>
                    <table class="table">
                    <thead class="heavy">
                        <tr>
                            <td>Percent of Questions Correct</td>
                            <td>Category</td>
                        </tr>
                    </thead>
                    <tbody data-bind="foreach: categoryStatList">
                        <tr>
                            <td>
                                <div class="progress">
                                  <div class="bar" data-bind="text: stat + '%', style: { width: stat + '%' }"></div>
                                </div>
                            </td>
                            <td data-bind="text: category"></td>
                        </tr>                
                    </tbody>
                </table>
                </div>
                <br/><br/>
            </div>
        	<div class="tab-pane" id="tab3">
                <h1>Test History &amp; Study</h1>
                <b><font face="verdana" color="green">Click a row in the table below to review the test and see the answers.</font></b>
                <hr/>
                <div data-bind="visible: testList().length == 1 && testList()[0].subjects == 'no subjects'">
                	<center>
                		No Test History
                    </center>
                </div>
                <div id="history" data-bind="visible: testList().length >= 1 && testList()[0].subjects != 'no subjects'">
                    <table class="table table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>Subjects</th>
                                <th class="hidden-phone">Categories</th>
                                <th class="hidden-phone">Test Mode</th>
                                <th>Test Duration (minutes)</th>
                                <!--<th>Question Type</th>-->
                                <th class="hidden-phone">Start Time</th>
                                <th class="hidden-phone">End Time</th>
                                <th>Question Count</th>                  
                                <th>Score</th>
                                <!--<th>Unanswered</th>-->
                            </tr>
                        </thead>
                        <tbody data-bind="foreach: testList">
                            <tr data-bind="click: $parent.reviewTest">
                                <td  data-bind='text: subjects.replace(/(<([^>]+)>)/ig," ").replace(/(^\s*)|(\s*$)/gi,"").replace(/[ ]{2,}/gi," ").replace(/( )/ig,", ")'></td>
                                <td class="hidden-phone" data-bind='text: categories.replace(/(<([^>]+)>)/ig," ").replace(/(^\s*)|(\s*$)/gi,"").replace(/[ ]{2,}/gi," ").replace(/( )/ig,", ")'></td>
                                <td  class="hidden-phone" data-bind="text: testmode"></td>
                                <td data-bind="text: testduration"></td>
                                <!-- <td data-bind="text: questiontype"></td> -->
                                <td class="hidden-phone" data-bind="text: starttime"></td>
                                <td class="hidden-phone" data-bind="text: endtime == '0000-00-00 00:00:00'? 'Incomplete': endtime"></td>
                                <td data-bind="text: questioncount"></td>
                                <td data-bind="text: (correct / questioncount * 100).toFixed(2) + '%'"></td>
                                <!--<td data-bind="text: unanswered"></td>-->
                            </tr>
                        </tbody>
                    </table>  
                </div>
			</div>            
                
            </div>
			<?php 
            }?>			
        </div>
    </div>
    
    <div id="footer"></div>
    
    <div class="modal hide" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Test Complete</h4>
          </div>
          <div class="modal-body">
          	You recieved <br/>
          	<div id="modalTestResults" data-bind="text: recentTestScore() + '%', style: {color: recentTestScore() < 70?  'red' :  'green' }"></div><br/>            
            on this test. To pass the USMLE you need a minimum score of 70%.<br/>
            However, by just passing, you will not be guarenteed a internship.<br/>
            Aim to get high 90s and make sure you have adequate volunteer and<br/>
            community service activities. Go to the <b>Test History &amp; Study</b> tab to <br/> 
            review your test and see the answers.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>   
    
    <script language="JavaScript" type="text/javascript">
		if (!!(window.location.hash=="#results?results=1")){
			$('#myModal').modal();
		} else if (window.location.hash=="#tab3") {
			$("#stab1").removeClass("active");
			$("#tab").removeClass("active");
			$("#stab3").addClass("active");	
			$("#tab3").addClass("active");	
		}
    </script>
    
    
</body>
</html>