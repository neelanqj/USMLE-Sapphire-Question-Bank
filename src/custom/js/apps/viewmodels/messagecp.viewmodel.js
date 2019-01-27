Core.ViewModel.MessageCP = function() {
	var _self = this;
	
	_self.createMessageObj = new Core.Model.Message();
	_self.editMessageObj = ko.observable(new Core.Model.Message());
	_self.viewMessageObj = ko.observable(new Core.Model.Message());
	_self.selectedItem = ko.observable();
	_self.messageList = ko.observableArray();
	_self.existMessages = ko.observable(true);
	
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
		(_self.messageList().length == 0)?_self.existMessages(false):_self.existMessages(true);
		};
	
	_self.createMessage = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._createMessageCallback;
			
			var Info = {
				ACTION: 'createmessage',
				SESSION: $('#session').val(),
				JSON: ko.toJSON({userid: $('#userID').val(),
								email: $.cookie('email'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress'),
								title: _self.createMessageObj.title(),
								message: _self.createMessageObj.message()})
			};
	
			$.ajax({
				url: '../../json/messagecp.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
		
	_self._createMessageCallback = function(data) {	
		$("#newmessage").modal('hide');
		$("#operationsuccess").modal('show');
		_self.getMessageList();
		if (data[0].success == '1') $("#operationsuccess").modal('show'); else $("#operationfail").modal('show');	
		};
	
	_self.viewEditMessage = function(target,callback) {
		callback = typeof (callback) == "function" ? callback : _self._viewEditMessageCallback;
		_self.viewMessage(null, callback);
		};
	
	_self.editMessage = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._editMessageCallback;
			
			var Info = {
				ACTION: 'editmessage',
				SESSION: $('#session').val(),
				JSON: ko.toJSON({userid: $('#userID').val(),
								email: $.cookie('email'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress'),
								title: _self.editMessageObj().title(),
								message: _self.editMessageObj().message(),
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
		
	_self._editMessageCallback = function(data) {
		$("#editmessage").modal('hide');
		_self.getMessageList();
		if (data[0].success == '1')  $("#operationsuccess").modal('show'); else $("#operationfail").modal('show');
		};
		
	_self.deleteMessage = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._deleteMessageCallback;
			
			var Info = {
				ACTION: 'deletemessage',
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
		
	_self._deleteMessageCallback = function(data) {
		_self.getMessageList();
		if (data[0].success == '1')  $("#operationsuccess").modal('show'); else $("#operationfail").modal('show');
		};
		
	_self.viewMessage = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._viewMessageCallback;
			
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
		
	_self._viewMessageCallback = function(data) {
		_self.viewMessageObj(new Core.Model.Message(data[0]));
		$('#viewmessage').modal('show');
		};
		
	_self._viewEditMessageCallback = function(data) {
		_self.editMessageObj(new Core.Model.Message(data[0]));
		$('#editmessage').modal('show');
		};

	_self.getMessageList();
};

