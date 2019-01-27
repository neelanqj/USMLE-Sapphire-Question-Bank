<?php 
	session_start();
	if(!isset($_COOKIE["passcode"])) {
		echo '<meta http-equiv="expired cookie" content="logout.view.php?msg=expired">';
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Account Settings</title>
<link rel="icon" type="image/ico" href="../../logo.ico"></link> 
<link rel="shortcut icon" href="../../logo.ico"></link>
    
    <!-- CSS File Library Includes -->
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../../src/library/bootstrap/css/bootstrap-responsive.css"/>
    
    <!-- JavaScript Library Includes -->
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery/jquery-1.9.1.js'></script>
    <script language="JavaScript" type="text/javascript" src="../../src/library/jquery-maskedinput/src/jquery.maskedinput.js"></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/jquery-cookie/jquery.cookie.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/bootstrap/js/bootstrap.js'></script>
    <script language="JavaScript" type="text/javascript" src='../../src/library/knockoutjs/knockout-2.2.1.js'></script>  
    
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../../src/custom/css/page.css">      
    
    <!-- JavaScript Script -->
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/page.js'></script>    
    <script language="JavaScript" type="text/javascript" src='../../src/custom/js/knockout.bindings.js'></script>
   	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/models/user.models.js'></script>  
	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/viewmodels/accountsettings.viewmodel.js' defer></script>  
   	<script language="JavaScript" type="text/javascript" src='../../src/custom/js/apps/page/accountsettings.page.js' defer></script>
</head>

<body>
	<?php require_once 'headernav.inc.php'; 
	 if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) { ?>

        <div id="main">
            <div id="hades">    
                <!-- Logo -->
                <div class="row-fluid">
                  <div class="span12 text-center">    
                        <div id="bigLogo" class="row-fluid">                    	
                        </div>
                        <div class="row-fluid">
                            <h5>Change Account Information.</h5><br/><br/>
                        </div>
                  </div>
                </div>
                
                <form name="input" action="signup.view.php" method="get">    
                <input type="hidden" name="action" value="verify" />
                <!-- email and password -->
                <div class="row-fluid">
                    <div class="span8 offset4 text-center">
                        <div class="span3">
                            <div class="row-fluid">
                                Email
                            </div>
                            <div class="row-fluid">
                                <input id="email" name="email" type="email" class="span12" data-bind="value: user().email" />
                            </div>
                        </div>
                        <div class="span3">
                            <div class="row-fluid">
                                Password
                            </div>
                            <div class="row-fluid">
                                <input id="password" name="password" type="password" class="span12" data-bind="value: user().password" />
                            </div>        
                        </div>
                    </div>
                </div>
                
                <!-- email and password -->
                <div class="row-fluid">
                    <div class="span8 offset4 text-center">
                        <div class="span3">
                            <div class="row-fluid">
                                Re-Enter Password
                            </div>
                            <div class="row-fluid">
                                <input id="password2" name="password2" type="password" class="span12" data-bind="value: user().password2" />
                            </div>       
                        </div>
                        <div class="span3">
                             <div class="row-fluid">
                                Phone
                            </div>
                            <div class="row-fluid">
                                <input id="phone" name="phone" type="tel" class="span12"  data-bind="masked: user().phone, mask: '(999) 999-9999? x99999'"/>
                            </div>    
                        </div>
                    </div>
                </div>
                
                <!-- firstname and lastname -->
                <div class="row-fluid">
                    <div class="span8 offset4 text-center">
                        <div class="span3">
                            <div class="row-fluid">
                                First name
                            </div>
                            <div class="row-fluid">
                                <input id="fname" name="fname" type="text" class="span12"  data-bind="value: user().firstName" />
                            </div>
                        </div>
                        <div class="span3">
                            <div class="row-fluid">
                                Last name
                            </div>
                            <div class="row-fluid">
                                <input id="lname" name="lname" type="text" class="span12" data-bind="value: user().lastName" />
                            </div>        
                        </div>
                    </div>
                </div>
                
                <!-- country and postal -->
                <div class="row-fluid">
                    <div class="span8 offset4 text-center">
                        <div class="span3">
                            <div class="row-fluid">
                                Country
                            </div>
                            <div class="row-fluid">
                                <select id="country" name="country" class="span12" data-bind="value: user().country">
                                    <option value="-1">Select country</option>
                                    <option value="1">Canada</option>
                                    <option value="2">USA</option>        
                                </select>
                            </div>
                        </div>
                        <div class="span3">     
                                <div class="row-fluid" data-bind="visible: user().country() == 1">
                                    Province
                                </div>
                                <div class="row-fluid" data-bind="visible: user().country() == 2">
                                    State
                                </div>
                                <div class="row-fluid">
                                    <select name="state" data-bind="visible: user().country() == 2, value: user().state">
                                        <option value="-1">Select State</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="DC">District of Columbia</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
            
                                    <select id="province" data-bind="visible: user().country() == 1, value: user().province">
                                        <option value="-1">Select Province</option>
                                        <option value="AB">Alberta</option>
                                        <option value="BC">British Columbia</option>
                                        <option value="MB">Manitoba</option>
                                        <option value="NB">New Brunswick</option>
                                        <option value="NL">Newfoundland and Labrador</option>
                                        <option value="NS">Nova Scotia</option>
                                        <option value="ON">Ontario</option>
                                        <option value="PE">Prince Edward Island</option>
                                        <option value="QC">Quebec</option>
                                        <option value="SK">Saskatchewan</option>
                                        <option value="NT">Northwest Territories</option>
                                        <option value="NU">Nunavut</option>
                                        <option value="YT">Yukon</option>
                                    </select>
                                </div>        
                        </div>
                    </div>
                </div>
                
                <!-- country and postal -->
                <div class="row-fluid">
                    <div class="span8 offset4 text-center">
                        <div class="span3">
                            <div class="row-fluid">
                                City
                            </div>
                            <div class="row-fluid">
                                <input id="city" name="city" type="text" class="span12"  data-bind="value: user().city"/>
                            </div>
                        </div>
                        <div class="span3">
                            <div class="row-fluid">
                                Postal Code
                            </div>
                            <div class="row-fluid">
                                <input id="postalcode" name="postalcode" type="text" class="span12"  data-bind="masked: user().postalCode, mask: (user().country() == 1)?'a9a-9a9': '99999'"/>
                            </div>   
                        </div>
                    </div>
                </div>
                
            
                <div class="row-fluid">
                    <div class="span12 text-center"><br/><br/>
                        <input type="submit" class="btn btn-primary" id="signup-btn" value="Update" data-bind="click: saveAccountSettings"></input>
                    </div>
                </div>   
                </form>
                
            
                <?php 
                 } ?>
		</div>
    </div>
    <div id="footer"></div> 
</body>
</html>