Core.ViewModel.ForgotPassword = function() {
	var _self = this;
	_self.email = ko.observable('').extend({ 
				pattern: { 
							params: /^([\d\w-\.]+@([\d\w-]+\.)+[\w]{2,4})?$/
							, message: " Invalid"
						 } 
				});
	_self.authenticationcode = ko.observable('');
	_self.newpassword = ko.observable('');
	_self.reenternewpassword = ko.observable('');
	_self.showauthinput = ko.observable(false);
	
	_self.getAuthenticationCode = function(callback) {
			callback = typeof (callback) == "function" ? callback : _self._getAuthenticationCodeCallback;
			var sessionid = $.cookie('PHPSESSID');
			
			// begin
			var Info = {
				ACTION: 'getauthenticationcode',
				SESSION: sessionid,
				JSON: ko.toJSON( {	userID: $('#userID').val(),
									email: _self.email()} )
			};
		
			$.ajax({
				url: '../../json/forgotpassword.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
	
	_self._getAuthenticationCodeCallback = function(data) {
		if (data[0][0] == '1') {
			alert("Please check your email for your authentication code.");
			_self.showauthinput(true);	
		}
		else if(data[0][0] == '2') alert("Account does not exist, please create a new account.");
		else alert("Something went wrong.");
		};
	
	
	_self.resetPassword = function(callback) {		
			callback = typeof (callback) == "function" ? callback : _self._resetPasswordCallback;
			var sessionid = $.cookie('PHPSESSID');
			
			// begin
			var Info = {
				ACTION: 'resetpassword',
				SESSION: sessionid,
				JSON: ko.toJSON( {	userID: $('#userID').val(),
									email: _self.email(),
									newpassword: _self.newpassword(),
									reenternewpassword: _self.reenternewpassword(),
									authenticationcode: _self.authenticationcode()} )
			};
		
			$.ajax({
				url: '../../json/forgotpassword.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
	
	_self._resetPasswordCallback = function(data) {
			if (data[0].success == '1') {
				window.location = "message.view.php?message=Your password has been successfully changed. Please login with your new password.&mood=positive";
			} else {
				window.location = "message.view.php?message=Password change failed. Please make sure you fill the fields out correctly and try again.&mood=negative";
			}
		};
		
	
	ko.extenders.logChange = function(target, option) {
		target.subscribe(function(newValue) {
		   console.log(option + ": " + newValue);
		});
		return target;
	};

};

