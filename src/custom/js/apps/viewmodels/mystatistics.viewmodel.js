Core.ViewModel.MyStatistics = function() {
	var _self = this;
	_self.testList = ko.observableArray([]);
	_self.subjectStatList = ko.observableArray([]);
	_self.categoryStatList = ko.observableArray([]);
	_self.subjectStatRecentList = ko.observableArray([]);
	_self.categoryStatRecentList = ko.observableArray([]);
	_self.recentTestScore = ko.observable(0.00);
	
	_self.getTestList = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._getTestListCallback;
			
			var Info = {
				ACTION: 'statistics_gettestlist',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
								userid: $.cookie('user_id'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress')})
			};
	
			$.ajax({
				url: '../../json/mystatistics.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._getTestListCallback = function(data) {
			if (data[0].logout == '1') { window.location = "signup.view.php" }
			for(i=0;i<data.length;i++) {
				_self.testList.push(data[i]);
			}
			
			_self.recentTestScore((_self.testList()[0].correct / _self.testList()[0].questioncount) * 100);
		};
		
	_self.getSubjectStatList = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._getSubjectStatListCallback;
			
			var Info = {
				ACTION: 'statistics_getsubjectstatlist',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
								userid: $.cookie('user_id'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress')})
			};
	
			$.ajax({
				url: '../../json/mystatistics.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._getSubjectStatListCallback = function(data) {
			for(i=0;i<data.length;i++) {
				_self.subjectStatList.push(data[i]);
			}
		};
		
	_self.getCategoryStatList = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._getCategoryStatListCallback;
			
			var Info = {
				ACTION: 'statistics_getcategorystatlist',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
								userid: $.cookie('user_id'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress')})
			};
	
			$.ajax({
				url: '../../json/mystatistics.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._getCategoryStatListCallback = function(data) {
			for(i=0;i<data.length;i++) {
				_self.categoryStatList.push(data[i]);
			}
		};
		
	// Recent			
	_self.getSubjectStatRecentList = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._getSubjectStatRecentListCallback;
			
			var Info = {
				ACTION: 'statistics_getsubjectstatrecentlist',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
								userid: $.cookie('user_id'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress')})
			};
	
			$.ajax({
				url: '../../json/mystatistics.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._getSubjectStatRecentListCallback = function(data) {
			for(i=0;i<data.length;i++) {
				_self.subjectStatRecentList.push(data[i]);
			}
		};
		
	_self.getCategoryStatRecentList = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._getCategoryStatRecentListCallback;
			
			var Info = {
				ACTION: 'statistics_getcategorystatrecentlist',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
								userid: $.cookie('user_id'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress')})
			};
	
			$.ajax({
				url: '../../json/mystatistics.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._getCategoryStatRecentListCallback = function(data) {
			for(i=0;i<data.length;i++) {
				_self.categoryStatRecentList.push(data[i]);
			}
		};
		
	_self.reviewTest = function(target, callback) {
		if(window.confirm("Are you sure you want to review this test?")) {
			window.location="test_review.view.php?review=" + target.testtrackerid;
		}
	}

	_self.getCategoryStatRecentList();
	_self.getSubjectStatRecentList();		
	_self.getCategoryStatList();
	_self.getSubjectStatList();
	_self.getTestList();
	
};