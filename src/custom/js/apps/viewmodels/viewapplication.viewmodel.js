// JavaScript Document
Core.ViewModel.ViewApplication = function() {
	var _self = this;
	_self.application = ko.observable();
	
	_self.loadApplication = function(callback) {		
			callback = typeof (callback) == "function" ? callback : _self._loadApplicationCallback;
			
			// begin
			var Info = {
				ACTION: 'load',
				SESSION: $('#session').val(),
				JSON: ko.toJSON({userID: $('#userID').val(),
								appID: $('#appID').text(),
								email: $.cookie('email'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress')})
			};
	
			$.ajax({
				url: '../../json/viewapplication.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._loadApplicationCallback = function(data) {
			_self.application(data[0]);
		};
		
	_self.loadApplication();
};

