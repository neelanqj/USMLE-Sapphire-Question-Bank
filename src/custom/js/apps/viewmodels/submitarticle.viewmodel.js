// JavaScript Document
Core.ViewModel.SubmitArticle = function() {
	var _self = this;
	_self.title = ko.observable('');
	_self.category = ko.observable('');
	_self.article = ko.observable('');
	
	_self.submitArticle = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._submitArticleCallback;
			// begin
			var Info = {
				ACTION: 'submitarticle',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
								userid: $.cookie('user_id'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress'),
								title: _self.title(),
								category: _self.category(),
								article: _self.article().replace(/\r?\n/g, '<br />')})
			};
	
			$.ajax({
				url: '../../json/submitarticle.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._submitArticleCallback = function(data) {
			if (data[0].logout == '1') { window.location = "logout.view.php" }
			if (data[0].success == '1') {
				alert("Successfully submitted article for review.");
			} else {
				alert("An error occured while trying to submit this article.");
			}
		};
		
};