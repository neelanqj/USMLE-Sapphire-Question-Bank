<?php 
	session_start() ;
	if(!isset($_COOKIE["passcode"])) {
		echo '<meta http-equiv=REFRESH CONTENT="0; url=logout.view.php?msg=expired">';		
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Le Test Systema BOSS</title>
    <link rel="icon" type="image/ico" href="../../logo.ico"></link> 
    <style media="print">
		body {	display : none !important;	}
	</style>
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap-responsive.css"/> 
	<link rel="stylesheet" type="text/css" href="../../src/custom/css/page.css"/>
	<link rel="stylesheet" type="text/css" href="../../src/custom/css/test.css"/>
    
    <!-- JavaScript Library Includes -->
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery/jquery-1.9.1.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/modernizr/modernizr-2.5.3.min.js'></script>   
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery-cookie/jquery.cookie.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery-getUrlParam/jquery.getUrlParam.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/bootstrap/js/bootstrap.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/knockoutjs/knockout-2.2.1.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/knockout.bindings.js'></script>      
    
    <!-- Custom Script -->
	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/viewmodels/test.viewmodel.js' defer></script>
	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/page/test.page.js' defer></script>
	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/page.js'></script>
	<script language="JavaScript" type="text/javascript">		 
		function disableselect(e){ return false	}	 
		function reEnable(){ return true }		 
		document.onselectstart=new Function ("return false")
		if (window.sidebar){ document.onmousedown=disableselect; document.onclick=reEnable;	}
	</script>
</head>
<body>
	<div class="hidden-phone" id="pages_frame">
    	<ul data-bind="foreach: questionStatusArray()">        	
                <button data-bind="click: $parent.getQuestion
                , text: $index() + 1
                , style: { color: $index() + 1 == $parent.questionbookmark() ? 'red' : 'black' }"></button> 
                <img src="../../src/custom/img/icon/redflag-icon.png" width="10px" height="15px" data-bind="visible: flag">
                <img src="../../src/custom/img/icon/lock-icon.png" width="10px" height="15px" data-bind="visible: lock">
            <br/>
        </ul>
    </div>
	<div id="questions_frame">
        <div id="header" class="controlFrame">
            <div id="questionnumber-details" class="lfloat">
                Item <span data-bind="text: questionbookmark()"></span> of <span data-bind="text: totalquestions()"></span>
            </div>
            <div id="flagquestion" class="lfloat">
                <input type="checkbox" data-bind="checked: flagStatus, click: setFlag"/> <img src="../../src/custom/img/icon/redflag-icon.png" /> Flag
            </div>
            <div id="nav-icons" class="center">
                <a style="float:left" data-bind="click: prevQuestion, visible: questionbookmark() != 1"><img class="fade" src="/src/custom/img/icon/larrow-icon.png"/></a>
                &nbsp;
                <a style="float:right" data-bind="click:nextQuestion, visible: questionbookmark() != totalquestions()"><img class="fade" src="/src/custom/img/icon/rarrow-icon.png"/></a>
                <img style="float:right" data-bind="click: endBlockModal, visible: questionbookmark() == totalquestions()" class="fade" src="../../src/custom/img/icon/endblock-icon.png" />
            </div>
            <div id="help-icons" class="rfloat">
                <img class="fade" src="/src/custom/img/icon/labvalues-icon.png" data-bind="click: toggleLabvaluesVisibility"/> 
                &nbsp;&nbsp;
                <img class="fade" src="/src/custom/img/icon/notes-icon.png" data-bind="click: toggleNotepadVisibility"/> 
                &nbsp;&nbsp;
                <img class="fade" src="/src/custom/img/icon/calculator-icon.png" data-bind="click: toggleCalculatorVisibility"/>
            </div>        
        </div>
    
        <div class="rfloat" id="calculator" data-bind="visible: calculatorVisible">
            <form name="calc">
                <table border=4>
                    <tr>
                        <td>
                        <input type="text"   name="input" size="16" disabled>
                        <img class="rfloat fixed" src="../../src/custom/img/icon/close_icon.png" data-bind="click: toggleCalculatorVisibility">
                        <br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="button" name="one"   value="  1  " onclick="calc.input.value += '1'">
                            <input type="button" name="two"   value="  2  " onclick="calc.input.value += '2'">
                            <input type="button" name="three" value="  3  " onclick="calc.input.value += '3'">
                            <input type="button" name="plus"  value="  +  " onclick="calc.input.value += ' + '">
                            <br>
                            <input type="button" name="four"  value="  4  " onclick="calc.input.value += '4'">
                            <input type="button" name="five"  value="  5  " onclick="calc.input.value += '5'">
                            <input type="button" name="six"   value="  6  " onclick="calc.input.value += '6'">
                            <input type="button" name="minus" value="  -  " onclick="calc.input.value += ' - '">
                            <br>
                            <input type="button" name="seven" value="  7  " onclick="calc.input.value += '7'">
                            <input type="button" name="eight" value="  8  " onclick="calc.input.value += '8'">
                            <input type="button" name="nine"  value="  9  " onclick="calc.input.value += '9'">
                            <input type="button" name="times" value="  x  " onclick="calc.input.value += ' * '">
                            <br>
                            <input type="button" name="clear" value="  C  " onclick="calc.input.value = ''">
                            <input type="button" name="zero"  value="  0  " onclick="calc.input.value += '0'">
                            <input type="button" name="DoIt"  value="  =  " onclick="calc.input.value = eval(calc.input.value)">
                            <input type="button" name="div"   value="  /  " onclick="calc.input.value += ' / '">
                            <br>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        
        <div class="rfloat" id="notepad" data-bind="visible: notepadVisible">
        	<img class="rfloat fixed" src="../../src/custom/img/icon/close_icon.png" data-bind="click: toggleNotepadVisibility">
        	<textarea cols="20" rows="30" placeholder="Make notes in this textbox."></textarea>
        </div>
        
        <div class="rfloat" id="labvalues" data-bind="visible: labvaluesVisible">
        	<div id="fixed span12">
        		<img class="rfloat" src="../../src/custom/img/icon/close_icon.png" data-bind="click: toggleLabvaluesVisibility">
            </div>
        	<center><b>LAB VALUES</b></center>
            <br/>
            BLOOD, PLASMA, SERUM<br/>
            REFERENCE RANGE<br/>
            SI REFERENCE INTERVALS<br/>
            * Alanine aminotransferase (ALT, GPT at 30 ° C)<br/>
            8-20 U/L<br/>
            8-20 U/L<br/>
            Amylase, serum<br/>
            25-125 U/L<br/>
            25-125 U/L<br/>
            * Aspartate aminotransferase (AST, GOT at 30 ° C)<br/>
            8-20 U/L<br/>
            8-20 U/L<br/>
            Bilirubin, serum (adult) Total // Direct<br/>
            0.1-1.0 mg/dL // 0.0-0.3 mg/dL<br/>
            2-17 µmol/L // 0-5 µmol/L<br/>
            * Calcium, serum (Ca2+)<br/>
            8.4-10.2 mg/dL<br/>
            2.1-2.8 mmol/L<br/>
            * Cholesterol, seru<m<br/>
            Rec:&lt; 200 mg/dL<br/>
            &lt;5.2 mmol/L<br/>
            Cortisol, serum<br/>
            0800 h: 5-23 µg/dL // 1600 h: 3-15 µg/dL<br/>
            138-635 nmol/L // 82-413 nmol/L<br/>
            <br/>
            2000 h: &lt; 50% of 0800 h<br/>
            Fraction of 0800 h: &lt; 0.50<br/>
            Creatine kinase, serum<br/>
            Male: 25-90 U/L<br/>
            25-90 U/L<br/>
            <br/>
            Female: 10-70 U/L<br/>
            10-70 U/L<br/>
            * Creatinine, serum<br/>
            0.6-1.2 mg/dL<br/>
            53-106 µmol/L<br/>
            Electrolytes, serum<br/>
            <br/>
            <br/>
            Sodium (Na+)<br/>
            136-145 mEq/L<br/>
            136-145 mmol/L<br/>
            Chloride (Cl-)<br/>
            95-105 mEq/L<br/>
            95-105 mmol/L<br/>
            * Potassium (K+)<br/>
            3.5-5.0 mEq/L<br/>
            3.5-5.0 mmol/L<br/>
            Bicarbonate (HCO3-)<br/>
            22-28 mEq/L<br/>
            22-28 mmol/L<br/>
            Magnesium (Mg2+)<br/>
            1.5-2.0 mEq/L<br/>
            1.5-2.0 mmol/L<br/>
            Estriol, total, serum (in pregnancy)<br/>
            <br/>
            <br/>
            24-28 wks // 32-36 wks<br/>
            30-170 ng/mL // 60-280 ng/mL<br/>
            104-590 // 208-970 nmol/L<br/>
            28-32 wks // 36-40 wks<br/>
            40-220 ng/mL // 80-350 ng/mL<br/>
            140-760 // 280-1210 nmol/L<br/>
            Ferritin, serum<br/>
            Male: 15-200 ng/mL<br/>
            15-200 µg/L<br/>
            <br/>
            Female: 12-150 ng/mL<br/>
            12-150 µg/L<br/>
            Follicle-stimulating hormone, serum/plasma<br/>
            Male: 4-25 mIU/mL<br/>
            4-25 U/L<br/>
            <br/>
            Female: premenopause 4-30 mIU/mL<br/>
            4-30 U/L<br/>
            <br/>
            midcycle peak 10-90 mIU/mL<br/>
            10-90 U/L<br/>
            <br/>
            postmenopause 40-250 mIU/mL<br/>
            40-250 U/L<br/>
            Gases, arterial blood (room air)<br/>
            <br/>
            <br/>
            pH<br/>
            7.35-7.45<br/>
            [H+] 36-44 nmol/L<br/>
            PCO2<br/>
            33-45 mm Hg<br/>
            4.4-5.9 kPa<br/>
            PO2<br/>
            75-105 mm Hg<br/>
            10.0-14.0 kPa<br/>
            * Glucose, serum<br/>
            Fasting: 70-110 mg/dL<br/>
            3.8-6.1 mmol/L<br/>
            <br/>
            2-h postprandial: &lt; 120 mg/dL<br/>
            &lt; 6.6 mmol/L<br/>
            Growth hormone - arginine stimulation<br/>
            Fasting: < 5 ng/mL<br/>
            &lt; 5 µg/L<br/>
            <br/>
            provocative stimuli: &gt; 7 ng/mL<br/>
            &gt; 7 µg/L<br/>
            Immunoglobulins, serum<br/>
            <br/>
            <br/>
            IgA<br/>
            76-390 mg/dL<br/>
            0.76-3.90 g/L<br/>
            IgE<br/>
            0-380 IU/mL<br/>
            0-380 kIU/L<br/>
            IgG<br/>
            650-1500 mg/dL<br/>
            6.5-15 g/L<br/>
            IgM<br/>
            40-345 mg/dL<br/>
            0.4-3.45 g/L<br/>
            Iron<br/>
            50-170 µg/dL<br/>
            9-30 µmol/L<br/>
            Lactate dehydrogenase, serum<br/>
            45-90 U/L<br/>
            45-90 U/L<br/>
            Luteinizing hormone, serum/plasma<br/>
            Male: 6-23 mIU/mL<br/>
            6-23 U/L<br/>
            <br/>
            Female: follicular phase 5-30 mIU/mL<br/>
            5-30 U/L<br/>
            <br/>
            midcycle 75-150 mIU/mL<br/>
            75-150 U/L<br/>
            <br/>
            postmenopause 30-200 mIU/mL<br/>
            30-200 U/L<br/>
            Osmolality, serum<br/>
            275-295 mOsmol/kg<br/>
            275-295 mOsmol/kg<br/>
            Parathyroid hormone, serum, N-terminal<br/>
            230-630 pg/mL<br/>
            230-630 ng/L<br/>
            * Phosphatase (alkaline), serum (p-NPP at 30 ° C)<br/>
            20-70 U/L<br/>
            20-70 U/L<br/>
            * Phosphorus (inorganic), serum<br/>
            3.0-4.5 mg/dL<br/>
            1.0-1.5 mmol/L<br/>
            Prolactin, serum (hPRL)<br/>
            &lt; 20 ng/mL<br/>
            &lt; 20 µg/L<br/>
            * Proteins, serum<br/>
            <br/>
            
            Total (recumbent)<br/>
            6.0-7.8 g/dL<br/>
            60-78 g/L<br/>
            Albumin<br/>
            3.5-5.5 g/dL<br/>
            35-55 g/L<br/>
            Globulin<br/>
            2.3-3.5 g/dL<br/>
            23-35 g/L<br/>
            Thyroid-stimulating hormone, serum or plasma<br/>
            0.5-5.0 µU/mL<br/>
            0.5-5.0 mU/L<br/>
            Thyroidal iodine (123I) uptake<br/>
            8-30% of administered dose/24 h<br/>
            0.08-0.30/24 h<br/>
            Thyroxine (T4), serum<br/>
            5-12 µg/dL<br/>
            64-155 nmol/L<br/>
            Triglycerides, serum<br/>
            35-160 mg/dL<br/>
            0.4-1.81 mmol/L<br/>
            Triiodothyronine (T3), serum (RIA)<br/>
            115-190 ng/dL<br/>
            1.8-2.9 nmol/L<br/>
            Triiodothyronine (T3) resin uptake<br/>
            25-35%<br/>
            0.25-0.35<br/>
            * Urea nitrogen, serum (BUN)<br/>
            7-18 mg/dL<br/>
            1.2-3.0 mmol urea/L<br/>
            * Uric acid, serum<br/>
            3.0-8.2 mg/dL<br/>
            0.18-0.48 mmol/L<br/>
        </div>
        <img id="loading" class="centerimage hide" src="../../src/custom/img/animate/loading2.gif" />
        
        <div id="question_body">
        <div class="backgroundwhite" style="padding:10px;"> 
			<div data-bind="html: questiontext" ></div>
            <hr/>
            	<div class="text-center bold" data-bind="foreach: questionanswerimagestext, visible: questionanswerimagestext().length >= 1" style="text-align:center">
                	<img data-bind="attr: { src: '../../src/custom/img/uploads/' + link }" width="50%">
                    <br/>
                    <span data-bind="text: description"></span>
                    <br/><br/><br/>
                </div>
            <hr/>
        </div>
            <span class="bold">Pick an Answer</span><br/>
            <div class="backgroundwhite" style="padding:10px;"> 
            <ul  class="backgroundwhite" data-bind="foreach: questionanswertext">
            	<li>
                    <input type="checkbox" name="answers" data-bind="checked: $parent.questionanswers, value: questionanswersid, enable: !$parent.lockStatus(), click: $parent.setAnswer" /><span data-bind="html: answer"></span>
                </li>
            </ul>
            </div>
        </div>
        
        <div id="footer-quiz" class="controlFrame">
            <div id="timeleft-details" class="lfloat">
                <table>
                    <tr>
                        <td>Block Time Remaining:</td>
                        <td><span style="weight:700" data-bind="text: testmode() == 'timed'? timeLeft: 'Not Timed'"></span></td>
                    </tr>
                    <tr>
                        <td>Question Time:</td>
                        <td>1 minute per question</td>
                    </tr>
                </table>
            </div>
            <div id="stop-icons" class="rfloat">
                <img data-bind="click: endBlockModal" class="fade" src="../../src/custom/img/icon/endblock-icon.png" />
            </div>
            <div id="lock-icons" class="center">
                <img class="fade" data-bind="click: setLock, attr: { class: lockStatus()? '':'greyout' }" src="../../src/custom/img/icon/lock-icon.png" />
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal hide" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Are You Sure You Want To End The Test?</h4>
          </div>
          <div class="modal-body">
          	Make sure you have completed all necessary questions to your satisfaction prior to clicking Yes.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bind="click: endBlock">Yes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          </div>
        </div>
      </div>
    </div>    
</body>


</html>