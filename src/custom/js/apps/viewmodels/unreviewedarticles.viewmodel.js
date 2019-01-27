// JavaScript Document
Core.ViewModel.UnreviewedArticleList = function() {
	var _self = this;
	_self.unreviewedArticleList = ko.observableArray();
	
	_self.publishArticle = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self.getList;

			var Info = {
				ACTION: 'publishunreviewed',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
								userid: $.cookie('user_id'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress'),
								linkid: target.id })
			};
			
			$.ajax({
				url: '../../json/unreviewedarticles.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self.deleteArticle = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self.getList;

			var Info = {
				ACTION: 'deleteunreviewed',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
								userid: $.cookie('user_id'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress'),
								linkid: target.id })
			};
			
			$.ajax({
				url: '../../json/unreviewedarticles.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
	
	_self.getList = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._getListCallback;

			var Info = {
				ACTION: 'unreviewedlist',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
								userid: $.cookie('user_id'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress')})
			};
			
			$.ajax({
				url: '../../json/unreviewedarticles.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._getListCallback = function(data) {
		if (data[0].logout == '1') { window.location = "logout.view.php" }
		_self.unreviewedArticleList(data);
		};		
		
	_self.getList();
};

