var VM = {};

VM = new Core.ViewModel.Test_Review();

// Initialize the knockout function
ko.applyBindings(VM);

/* ************* AJAX Loader Screen Code ************* */
$(document).ajaxStart(function() {
      $( "#loading" ).show();
});

$(document).ajaxStop(function() {
      $( "#loading" ).hide();
});