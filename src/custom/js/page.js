/* ************************************************************************************************************************ *
 *                                                                                                                          *
 *      Filename: page.js                                                                                           		*
 *      Description: This page contains the base models, collections, and viewmodels common functionality that will be used *
 *                   as the basis for the rest of the system. This was created to minimize code redundancy.                 *
 *      Dependancies:   Knockoutjs                                                                                          *
 *      Developer: Neelan Joachimpillai                                                                                     *
 *                                                                                                                          *
 *      Version control:                                                                                                    *
 *                              Neelan Joachimpillai        Dec 23, 2012        Created file.                               *
 *                                                                                                                          *
 * ************************************************************************************************************************ */

/* ************* Arranges knockout elements ************* */
var Core = {};

Core.Model = {};

Core.ViewModel = {};

/* ************* AJAX Loader Screen Code ************* */
$(document).ajaxStart(function() {
  $( "#loading" ).show();
  $( ".dataloading" ).show();
});

$(document).ajaxStop(function() {
  $( "#loading" ).hide();
  $( ".dataloading" ).hide();
});

$(document).ready(function(){
   $("#bigLogo").load("/apps/view/html/logo.html");
   $("#footer").load("/apps/view/html/footer.html");
   
	$("#signintoggle").click(function(e){
		e.stopPropagation();
		$("#login-menu").toggle();
	});
	
	$(".dropdown").click(function(e){
		e.stopPropagation();
		$("#login-menu").toggle();
	});
	
	$("#login-menu").click(function(e){
		e.stopPropagation();
	});
	
	$(document).click(function(){
     	$("#login-menu").hide();
	});
});

String.prototype.toHHMMSS = function () {
    var sec_num = parseInt(this, 10); // don't forget the second param
    var hours   = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
    var seconds = sec_num - (hours * 3600) - (minutes * 60);

    if (hours   < 10) {hours   = "0"+hours;}
    if (minutes < 10) {minutes = "0"+minutes;}
    if (seconds < 10) {seconds = "0"+seconds;}
    var time    = hours+':'+minutes+':'+seconds;
    return time;
}