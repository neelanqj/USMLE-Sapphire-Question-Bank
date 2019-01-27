// JavaScript Document
Core.ViewModel.PersonProfile = function() {
	var _self = this;
	_self.person = ko.observable();
	
	_self.skillList = ko.observableArray();
	
	_self.selectedItem = ko.observable('');
	_self.messageObj = ko.observable(new Core.Model.Message());
	_self.messageList = ko.observableArray();
	
	_self.employervisibility = ko.observable(false);
	_self.employeevisibility = ko.observable(false);
	
	_self.setVisibility = function(callback) {		
			if ($.cookie('accounttype') == 2 || $.cookie('accounttype') == 3) {
				_self.employervisibility(true);
			}
			
			if ($.cookie('accounttype') == 1 || $.cookie('accounttype') == 3) {
				_self.employeevisibility(true);
			}
		};

	_self.setVisibility();
	
	// Below are messaging related functions
	_self.getMessageList = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._getMessageListCallback;
			
			var Info = {
				ACTION: 'getmessagelist',
				SESSION: $('#session').val(),
				JSON: ko.toJSON({userid: $('#userID').val(),
								email: $.cookie('email'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress')})
			};
		
			$.ajax({
				url: '../../json/messagecp.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._getMessageListCallback = function(data) {
		_self.messageList(data);
		};
		
	_self.getMessage = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._getMessageCallback;
			
			var Info = {
				ACTION: 'viewmessage',
				SESSION: $('#session').val(),
				JSON: ko.toJSON({userid: $('#userID').val(),
								email: $.cookie('email'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress'),
								messageid: _self.selectedItem()})
			};
	
			$.ajax({
				url: '../../json/messagecp.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._getMessageCallback = function(data) {
		_self.messageObj(new Core.Model.Message(data[0]));
		};
		
	_self.sendMessage = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._sendMessageCallback;
			
			var Info = {
				ACTION: 'sendmessage',
				SESSION: $('#session').val(),
				JSON: ko.toJSON({userid: $('#userID').val(),
								email: $.cookie('email'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress'),
								title: _self.messageObj().title(),
								message: _self.messageObj().message(),
								recieverid: $('#profileid').val() })
			};
	
			$.ajax({
				url: '../../json/messagecp.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._sendMessageCallback = function(data) {
			if( data[0].success == "1") { 
				$("#contactuser").modal('hide');
				$("#messagesent").modal(); 
			} else { 
				$("#contactuser").modal('hide');
				$("#messagenotsent").modal(); 
			}
		};
	
	// Below are the regular profile person functions
	_self.personDetails = function(callback) {		
			callback = typeof (callback) == "function" ? callback : _self._personDetailsCallback;
			
			// begin
			var Info = {
				ACTION: 'details',
				SESSION: $('#session').val(),
				JSON: ko.toJSON( {userID: $('#profileid').val()} )
			};
	
			$.ajax({
				url: '../../json/profileperson.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._personDetailsCallback = function(data) {
			_self.person(new Core.Model.UserDetails(data[0]));			
		};
		
	_self.personSkills = function(callback) {
			callback = typeof (callback) == "function" ? callback : _self._personSkillsCallback;
			
			// begin
			var Info = {
				ACTION: 'skills',
				SESSION: $('#session').val(),
				JSON: ko.toJSON( {userID: $('#profileid').val()} )
			};
	
			$.ajax({
				url: '../../json/profileperson.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		
		};
		
	_self._personSkillsCallback = function(data) {
		_self.skillList(data);		
		};
		
	_self.personDetails();
	_self.personSkills();
	_self.getMessageList();
};

