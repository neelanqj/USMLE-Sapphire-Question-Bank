Core.ViewModel.AccountSettings = function() {
	var _self = this;
	_self.user = ko.observable(new Core.Model.UserDetails());
	
	_self.loadAccountSettings = function(callback) {		
			callback = typeof (callback) == "function" ? callback : _self._loadAccountSettingsCallback;
			
			var Info = {
				ACTION: 'userdetails',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON( {	userID: $.cookie('user_id'),
									email: $.cookie('email'),
									passcode: $.cookie('passcode'),
									ipaddress: $.cookie('ipaddress')} )
			};
	
			$.ajax({
				url: '../../json/accountsettings.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._loadAccountSettingsCallback = function(data) {
			 if (data[0].logout == '1') { window.location = "logout.view.php" }
			_self.user(new Core.Model.UserDetails(data[0]));
		};
		
	_self.saveAccountSettings = function(callback) {		
		callback = typeof (callback) == "function" ? callback : _self._saveAccountSettingsCallback;
		
		// begin
		var Info = {
			ACTION: 'updatedetails',
			SESSION: $.cookie('PHPSESSID'),
			JSON: ko.toJSON( {	userID: $.cookie('user_id'),
								email: $.cookie('email'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress'),
								password: _self.user().password,
								password2: _self.user().password2,
								phone: _self.user().phone,
								firstName: _self.user().firstName,
								lastName: _self.user().lastName,
								region: _self.user().region,
								city: _self.user().city,
								country: _self.user().country,
								postalCode: _self.user().postalCode,
								careerLvl: _self.user().careerLvl,
								education: _self.user().education} )
		};
	
		$.ajax({
			url: '../../json/accountsettings.json.php',
			data: Info,
			dataType: 'json',
			type: "post",
			success: callback
		});
	};
	
	_self._saveAccountSettingsCallback = function(data) {
			if (data[0].success == '1') {
				window.location = "message.view.php?message=Successfully updated account settings.&mood=positive";
			} else {
				window.location = "message.view.php?message=Account settings update failed.&mood=negative";
			}	
		
	};

	_self.loadAccountSettings();
};

