// JavaScript Document
Core.ViewModel.SignUp = function() {
	var _self = this;
	_self.userDetails = (new Core.Model.UserDetails());

	_self.userSignup = function(callback) {		
			callback = typeof (callback) == "function" ? callback : _self._userSignupCallback;
			
			// begin
			var Info = {
				ACTION: 'signup',
				JSON: ko.toJSON(_self.userDetails)
			};
	
			$.ajax({
				url: '../../json/signup.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._userSignupCallback = function(data) {

/*
			var Info = {
				ACTION: 'verificationcode',
				JSON: ko.toJSON({email: _self.userDetails.email()})
				};
			
			$.ajax({
				url: '../../json/signup.json.php',
				data: Info,
				dataType: 'json',
				type: "post"
				}); */
			
			if (data[0].success == '1') {
				window.location = "message.view.php?message=Please check your email and spam folder for your account verification code information.&mood=positive";
			} else {
				window.location = "message.view.php?message=Signup failed. Please make sure you enter in all fields correctly. &mood=negative";
			}		
		};
};

