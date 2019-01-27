var VM = {};

VM = new Core.ViewModel.ForgotPassword();


VM.errors = ko.validation.group(VM);

// Initialize the knockout function
ko.applyBindings(VM);
