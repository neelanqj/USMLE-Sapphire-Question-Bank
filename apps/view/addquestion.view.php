<?php 
session_start() ;
	if(!isset($_COOKIE["passcode"])) {
		echo '<meta HTTP-EQUIV=REFRESH CONTENT="0; url=logout.view.php?msg=expired">';
	}
	// FILEFRAME section of the script
	if (isset($_POST['fileframe']) && substr($_POST['identity'], 0,2) == $_COOKIE["user_id"]) 
	{
		$upload_dir = "../../src/custom/img/uploads/"; // Directory for file storing
		$web_upload_dir = "../../src/custom/img/uploads/"; // Directory for file storing
		
		$result = 'ERROR';
		$result_msg = 'No FILE field found';
		
		if (isset($_FILES['file']))  // file was send from browser
		{			
			if ($_FILES['file']['error'] == UPLOAD_ERR_OK)  // no error
			{
				$filename = $_POST['identity'].$_FILES['file']['name']; // file name 
				move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir.'/'.$filename);
				// main action -- move uploaded file to $upload_dir 
				$result = 'OK';
			}
			elseif ($_FILES['file']['error'] == UPLOAD_ERR_INI_SIZE)
				$result_msg = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
			else 
				$result_msg = 'Unknown error';
		}
	
		// outputing trivial html with javascript code 
		// (return data to document)
	
		// This is a PHP code outputing Javascript code.
		// Do not be so confused ;) 
		echo '<html>'."\n".'<head>'."\n".'<title>Load Progress</title>'."\n".'</head>'."\n".'<body>'."\n";
		echo '<script language="JavaScript" type="text/javascript">'."\n";
		echo 'var parDoc = window.parent.document;';
	
		if ($result == 'OK')
		{
			// Simply updating status of fields and submit button
			echo 'parDoc.getElementById("loadingImg").src = "/src/custom/img/animate/greencheck.png";';
		}
		else
		{
			echo 'parDoc.getElementById("uploadComment").innerhtml = "ERROR: '.$result_msg.')";';
		}
	
		echo "\n".'</script></body></html>';
		exit();
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Add Question</title>
    <link rel="icon" type="image/ico" href="../../logo.ico"></link> 
    <link rel="shortcut icon" href="../../logo.ico"></link>
    
    <!-- CSS File Library Includes -->
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap-responsive.css"/>   
    
    <!-- JavaScript Library Includes -->
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery/jquery-1.9.1.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery-cookie/jquery.cookie.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/bootstrap/js/bootstrap.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/knockoutjs/knockout-2.2.1.js'></script>  
    
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../../src/custom/css/page.css">
    <link rel="stylesheet" type="text/css" href="../../src/custom/css/addquestion.css">
    
    <!-- JavaScript Includes -->
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/page.js'></script> 
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/viewmodels/addquestion.viewmodel.js' defer="defer"></script>
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/page/addquestion.page.js' defer="defer"></script>
</head>

<body>
	<?php 
    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) { 
	
		include("../view/headernav.inc.php");
		?>	
    
        <div id="main">
            <div id="hades">               
                <div class="row-fluid">
                  <div class="span12 text-center">    
                    <div id="bigLogo" class="row-fluid">
                    </div>
                    <div class="row-fluid">
                        <h5>Add Question</h5>
                    </div>
                  </div>
                </div>                    
             </div>
             
             <div class="tabbable"> <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs">
                    <li>
                    <a  href="editquestion.view.php">Edit/Delete Question</a>
                    </li>
                    <li class="active">
                    <a href="#tab" data-toggle="tab">Add Question</a>
                    </li>
                </ul>
                <div id="results" class="tab-content">
                    <div class="tab-pane active" id="tab">
                         <div class="row-fluid">
                            <div class="span6 text-center bold">
                            	<span class="bold">Subject (Pick One)</span><br/>
                                <select placeholder="Pick a Subject" data-bind="options: questionSubjectsList, optionsText: function(item) { return item.name; }, value: subject"></select><br/><br/>
                            </div>
                            <div class="span6 text-center bold">
                            	<span class="bold">Category (Pick One)</span><br/>
                                <select placeholder="Pick a Category" data-bind="options: questionCategoriesList, optionsText:  function(item) { return item.name; }, value: category"></select><br/><br/>
                            </div>
                         </div>    
                         
                        <div class="row-fluid">
                            <div class="span12 text-center bold">
                                <span class="bold">Question</span>
                            </div>
                        </div>                  
                        <div class="row-fluid">
                            <div class="span12 text-center">
                                <textarea data-bind="value: question" placeholder="Enter your question (min 200 letters)" style="width: 80%; height:300px;"></textarea>
                            </div>
                        </div>                
                        <div class="row-fluid">
                            <div class="span12 text-center">
                                <br/><br/>
                                <span class="bold">Add Image</span>
                                <br/><br/>
                            </div>
                        </div>
                        <div>  
                            <div class="row-fluid">
                                <div class="span12 text-center">
                                     <form id="imageupload" action="<?=$_SERVER['PHP_SELF']?>" target="upload_iframe" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="fileframe" value="true" />
                                        <input type="hidden" id="identity" name="identity" value="<?php echo $_COOKIE['user_id'].'_'.time().'_' ?>" />
                                        <!-- JavaScript is called by a knockoutjs subscription to the fileName attribute -->
                                        <input type="file" name="file" id="file" data-bind="value: fileName">
                                        <span id="uploadComment"></span>
                                     </form>
                                     
                                     <br/><br/>
                                     <span class="bold">Images</span>
                                     <br/><br/>
                                     
                                     <table class="table table-bordered table-condensed">  
                                        <thead>
                                            <th>File Name</th>
                                            <th>Description</th>
                                            <th>Options</th>
                                        </thead>
                                        <tbody data-bind="foreach: questionImages">                        
                                            <tr>
                                                <td class="text-center" data-bind="text: fileName"></td>
                                                <td><input data-bind="value: description, valueUpdate: 'afterkeydown'" type="text" /></td>
                                                <td>
                                                    <a title="Delete" href=#" data-bind="click: $parent.removeImgFile"><i class="icon-trash"></i></a>                                                   
                                                    <a title="Preview Image" href="#" target="_blank" data-bind="attr: { href: '../../src/custom/img/uploads/' + fileValue }"><i class="icon-eye-open"></i></a>
                                                 </td>
                                            </tr>
                                        </tbody>
                                        <tbody data-bind="visible: questionImages().length < 1?true:false"> 
                                            <tr>
                                                <td class="text-center">-</td>
                                                <td class="text-center">-</td>
                                                <td class="text-center">-</td>
                                            </tr>
                                        </tbody>
                                     </table>
                                     <!-- <input type="file" data-bind="value: fileName, fileUpload: fileName, url: $parent.url"> -->
                                     <iframe name="upload_iframe" style="width: 400px; height: 100px; display: none;"></iframe>
                                    
                                </div>
                            </div>
                        </div>    
                        
                         <div>  
                            <div class="row-fluid">
                                <div class="span12 text-center">  
                                    <br/><br/>
                                    <span class="bold">Answers</span> <a data-bind="click: addAnswer" href="#">(Add)</a>
                                    <br/><br/>
                                             
                                    <table class="table table-bordered table-condensed">
                                        <thead>
                                            <th>Index</th>
                                            <th>Answer</th>
                                            <th>Explaination</th>
                                            <th>Correct?</th>
                                            <th>Delete</th>
                                        </thead>
                                        <tbody data-bind="foreach: answerOptions">
                                            <tr>
                                                <td>
                                                    <span class="bold" data-bind="text: index"></span>
                                                </td>
                                                <td>
                                                    <input class="input-large" type="text" data-bind="value: answer, valueUpdate: 'afterkeydown'">
                                                </td>
                                                <td>
                                                    <input class="input-large" type="text" data-bind="value: explaination, valueUpdate: 'afterkeydown'"> 
                                                </td>
                                                <td>                            
                                                    <input type="checkbox" data-bind="checked: correct, valueUpdate: 'afterkeydown'"> Yes
                                                </td>
                                                <td>
                                                    <a href="#" data-bind="click: $parent.removeAnswer"><i class="icon-trash"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                               
                        <div class="row-fluid">
                            <div class="span12 text-center"><br/><br/><br/>
                                <button data-bind="click: createQuestion, enable: createButtonEnabled" class="btn btn-primary">Create Question</button>
                                <br/><br/>
                            </div>
                        </div>
                    <?php 
                    }?>
                    </div>
                 </div>
              </div>
           </div>
        </div>
         
        <div id="footer"></div>    
</body>
</html>