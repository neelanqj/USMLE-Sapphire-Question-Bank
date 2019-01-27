<!-- <img id="loading" class="centerimage hide" src="../../src/custom/img/animate/loading2.gif" /> -->
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>
    <a class="brand" href="/apps/view/mainall.view.php"> 
        <span class="visible-phone visible-tablet"> 
        	<img src="../../src/custom/img/Logo-mini.png" width="25" height="25" /> USMLE Sapphire
        </span>
    </a>
  <div class="nav-collapse collapse navbar-responsive-collapse">
      <ul class="nav">
      	  <li></li>
          <li><a class="brand hidden-phone hidden-tablet" href="/apps/view/mainall.view.php"> <img src="../../src/custom/img/Logo-mini.png" width="25" height="25" /></a></li>
          <li><a href="/apps/view/mainall.view.php">Home</a></li>
          
          <li><a href="/apps/view/search.view.php">News</a></li>
          <li class="divider-vertical"></li>
          <?php
          if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) { 
                            echo "</li>
                                    <li><a href='/apps/view/usercp.view.php'>Control Panel</a></li>
                                    <li class='divider-vertical'>
                                    <li><a href='/apps/view/qbanksetup.view.php'>Qbank</a></li>								
                                    <li><a href='/apps/view/mystatistics.view.php#tab3'>Test Review</a></li>							
                                    <li class='divider-vertical'></li>";
                        }
                        if (!isset($_SESSION['user_id'])) { 
                        ?>
                        
                        <li class="dropdown">
                          <a class="dropdown-toggle" role="button" data-toggle="dropdown">
                            Login
                            <b class="caret"></b>
                          </a>   
                          <!-- Drop down element -->
                           <ul id="login-menu" class="dropdown-menu logo" role="menu" aria-labelledby="dLabel">
                                <li>                      
                                    <!-- Login Element -->
                                    <div class="loginform">
                                        <form action="/apps/view/login.view.php" method="post" class="form-horizontal">
                                          <div class="control-group">
                                            <label class="control-label" for="email">Email</label>
                                            <div class="controls">
                                              <input type="text" name="email" id="email" placeholder="Email">
                                            </div>
                                          </div>
                                          <div class="control-group">
                                            <label class="control-label" for="password">Password</label>
                                            <div class="controls">
                                              <input type="password" name="password" id="password" placeholder="Password">
                                            </div>
                                          </div>
                                          <div class="control-group">
                                            <div class="controls">
                                              <button type="submit" class="btn">Sign in</button>
                                            </div>
                                          </div>
                                          <div class="pull-right">
                                            <a href="/apps/view/forgotpassword.view.php">Forgot Password?</a> 
                                            <span class="hidden-mobile">&nbsp;&nbsp;</span>
                                            <br class="visible-phone" />
                                            <a href="/apps/view/activate.view.php?activate=&code=&email=">Verify Account</a>
                                            <br/><br/>
                                          </div>
                                        </form>
                                    </div>
                                    <!-- End Of Login Element -->
                                </li>
                            </ul>
                            <!-- End of drop down element -->
                        </li>
                        <li><a href="/apps/view/signup.view.php">Join</a></li>
                    <?php } else { 
                        echo '<li><a href="/apps/view/logout.view.php">Logout</a></li>';
                     } ?>               
                        <li class="divider-vertical"></li>
                        <li><a href="/apps/view/about.view.php">Help</a></li>
                        <li><a href="/apps/view/contact.view.php">Contact us</a></li>
                    </ul>
        </ul>
    </div>
    <div class="nav-collapse collapse">
        <ul class="nav pull-right">
            <li class="divider-vertical"></li>
                <li id="welcome-text">
                <?php 
                if (isset($_SESSION['name']) && !empty($_SESSION['name'])) {
                    echo "   Mode: " . ucwords(strtolower($_SESSION['name'])); 
                } else {
                     echo "   Mode: Guest";
                }?>
                </li>
            <form action="/apps/view/search.view.php" method="get"  class="navbar-search">
              <input name="f" type="hidden" value="<?php echo isset($_GET['f'])?$_GET['f']:''; ?>" />
              <input name="s" type="text" class="search-query" placeholder="Search Articles">
            </form>
            <li class="divider-vertical"></li>
        </ul>
    </div>
  </div>
</div>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-57026418-1', 'auto');
  ga('send', 'pageview');

</script>

