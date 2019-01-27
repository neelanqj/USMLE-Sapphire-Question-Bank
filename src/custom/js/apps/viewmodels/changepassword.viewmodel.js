Core.ViewModel.ChangePassword = function() {
	var _self = this;
	_self.oldpassword = ko.observable();
	_self.password = ko.observable();
	_self.password2 = ko.observable();
		
	_self.changePassword = function(callback) {		
		callback = typeof (callback) == "function" ? callback : _self._changePasswordCallback;
		
		// begin
		var Info = {
			ACTION: 'changepassword',
			SESSION: $('#session').val(),
			JSON: ko.toJSON( {	userID: $('#userID').val(),
								email: $.cookie('email'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress'),
								password: _self.password,
								password2: _self.password2,
								oldpassword: _self.oldpassword} )
		};
	
		$.ajax({
			url: '../../json/changepassword.json.php',
			data: Info,
			dataType: 'json',
			type: "post",
			success: callback
		});
	};
	
	_self._changePasswordCallback = function(data) {
			// if (data[0].logout == '1') { window.location = "logout.view.php" }
			if (data[0].success == '1') {
				window.location = "logout.view.php?message=Your password has been successfully changed. Please login with your new password.";
			} else {
				window.location = "message.view.php?message=Password change failed. Please try again.&mood=negative";
			}
		
	};

};

