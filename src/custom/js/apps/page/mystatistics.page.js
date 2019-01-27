var VM = {};

VM = new Core.ViewModel.MyStatistics();

// Initialize the knockout function
ko.applyBindings(VM);

/* ************* AJAX Loader Screen Code ************* */
$(document).ajaxStart(function() {
      $( "#loading" ).show();
});

$(document).ajaxStop(function() {
      $( "#loading" ).hide();
});