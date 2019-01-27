var VM = {};

VM = new Core.ViewModel.QBankSetup();

// Initialize the knockout function
ko.applyBindings(VM);

$('#btn_bysubjecthelp').popover({ "trigger": "hover" });
$('#btn_bysystemhelp').popover({ "trigger": "hover" });
$('#btn_questionmodehelp').popover({ "trigger": "hover" });
$('#btn_modehelp').popover({ "trigger": "hover" });
$('#btn_questionshelp').popover({ "trigger": "hover" });
$('#btn_lengthhelp').popover({ "trigger": "hover" });