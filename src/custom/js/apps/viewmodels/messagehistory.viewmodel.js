Core.ViewModel.MessageHistory = function() {
	var _self = this;
	
	_self.messageHistoryList = ko.observableArray([]);
	
	_self.totalpages = ko.observable(1);
	_self.pagenum = ko.observable(1);
	_self.perpage = ko.observable(10);
	_self.iasloadedpage = ko.observable(1);
	_self.pendingRequest = ko.observable(false);
	
	_self.viewMessageObj = ko.observable(new Core.Model.Message());
	
	_self.viewMessage = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._viewMessageCallback;
			
			var Info = {
				ACTION: 'viewmessage',
				SESSION: $('#session').val(),
				JSON: ko.toJSON({userid: $('#userID').val(),
								email: $.cookie('email'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress'),
								messageid: target.id})
			};
	
			$.ajax({
				url: '../../json/messagehistory.json.php',
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
	
	_self.setPage = function(target, callback) {
		_self.pagenum(target);
		_self.getMessageHistory(target, _self._getMessageHistoryCallback2);
	}
	
	_self.prevPage = function(target, callback) {
		if (_self.pagenum() > 1) {
			_self.pagenum(_self.pagenum() - 1) ;
			_self.setPage(_self.pagenum());
		}
	}
	
	_self.nextPage = function(target, callback) {
		if (_self.pagenum() < _self.totalpages()) {
			_self.pagenum(_self.pagenum() + 1) ;
			_self.setPage(_self.pagenum());
		}
	}
	
	_self.scrolled = function (data, event) {
		var elem = event.target;
        if (elem.scrollTop > (elem.scrollHeight - elem.offsetHeight - 20)) {
			_self.getMessageHistoryIAS(null, _self._getMessageHistoryCallback3);
        }		
	}
	
	_self.getMessageHistoryIAS = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._getMessageHistoryCallback;
			
			if (_self.pagenum() < _self.totalpages()) {
				_self.pendingRequest(true);
				_self.pagenum(_self.pagenum() + 1);
				
				var Info = {
					ACTION: 'messagehistory',
					SESSION: $('#session').val(),
					JSON: ko.toJSON({
									userID: $('#userID').val(),
									email: $.cookie('email'),
									passcode: $.cookie('passcode'),
									ipaddress: $.cookie('ipaddress'),
									filter: '',
									pagenum: _self.pagenum(),
									perpage: _self.perpage()})
				};
		
				$.ajax({
					url: '../../json/messagehistory.json.php',
					data: Info,
					dataType: 'json',
					type: "post",
					success: callback
				});
			
			}
		};
	
	_self.getMessageHistory = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._getMessageHistoryCallback;
			_self.pendingRequest(true);
			var Info = {
				ACTION: 'messagehistory',
				SESSION: $('#session').val(),
				JSON: ko.toJSON({
								userID: $('#userID').val(),
								email: $.cookie('email'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress'),
								filter: '',
								pagenum: _self.pagenum(),
								perpage: _self.perpage()})
			};
	
			$.ajax({
				url: '../../json/messagehistory.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._getMessageHistoryCallback = function(data) {
		_self.getMessageHistoryCount();
		_self.messageHistoryList(data);
		_self.pendingRequest(false);
		};
		
	_self._getMessageHistoryCallback2 = function(data) {
		_self.messageHistoryList(data);
		_self.pendingRequest(false);
		};
		
	_self._getMessageHistoryCallback3 = function(data) {
			ko.utils.arrayForEach(data, function(element) {
				_self.messageHistoryList.push(element);
			});			
			_self.pendingRequest(false);
		};
		
	_self.getMessageHistoryCount = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._getMessageHistoryCountCallback;
			
			var Info = {
				ACTION: 'messagehistorycount',
				SESSION: $('#session').val(),
				JSON: ko.toJSON({
								userID: $('#userID').val(),
								email: $.cookie('email'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress'),
								filter: '',
								pagenum: _self.pagenum(),
								perpage: _self.perpage()})
			};
	
			$.ajax({
				url: '../../json/messagehistory.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._getMessageHistoryCountCallback = function(data) {
		_self.totalpages(Math.ceil(data[0].count))
		};
	
	_self.getMessageHistory();
};

