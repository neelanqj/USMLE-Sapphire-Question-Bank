// JavaScript Document
var VM = {};

VM = new Core.ViewModel.Activate();

VM.errors = ko.validation.group(VM);

// Initialize the knockout function
ko.applyBindings(VM);