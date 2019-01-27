Core.ViewModel.Activate = function() {
	var _self = this;
	
	_self.email = ko.observable($('#hemail').val()).extend({ 
				pattern: { 
							params: /^([\d\w-\.]+@([\d\w-]+\.)+[\w]{2,4})?$/
							, message: " Invalid"
						 } 
				});
	_self.vCode = ko.observable($('#hcode').val());
	_self.runactivate = ko.observable($('#hactivate').val());
	_self.accountType = ko.observable();
	
	_self.activate = function(callback) {		
			callback = typeof (callback) == "function" ? callback : _self._activateCallback;
			
			var Info = {
				ACTION: 'activate',
				JSON: ko.toJSON( {  email: _self.email,
						    vcode: _self.vCode} )
			};
			
			$.ajax({
				url: '../../json/activate.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._activateCallback = function(data) {
			if (data[0].success == '1') {
				window.location = "message.view.php?message=Successfully created an Account. Please log in.&mood=positive";
			} else {
				window.location = "message.view.php?message=Invalid email or verification code.&mood=negative";
			}	
		};
		
	_self.resendVerification = function(data) {
			var Info = {
				ACTION: 'verificationcode',
				JSON: ko.toJSON({email: _self.email })
				};
			
			$.ajax({
				url: '../../json/signup.json.php',
				data: Info,
				dataType: 'json',
				type: "post"
				});
			
			alert ("Check your email");
	};
	
	if (_self.runactivate() == '1') _self.activate();
};

