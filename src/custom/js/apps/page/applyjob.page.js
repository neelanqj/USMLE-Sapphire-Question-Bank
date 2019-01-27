// Fix for word wrap in explorer.
$("div.nicEdit-main").addClass('wordwrap');

var VM = {};

VM = new Core.ViewModel.ApplyJob();

// Initialize the knockout function
ko.applyBindings(VM);
