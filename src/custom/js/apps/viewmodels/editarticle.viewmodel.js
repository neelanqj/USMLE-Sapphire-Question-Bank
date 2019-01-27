// JavaScript Document
Core.ViewModel.EditArticle = function() {
	var _self = this;
	
	_self.search_articleList = ko.observableArray([]);
	_self.search_article = ko.observable("");
	
	_self.currentArticle = ko.observable();
	_self.article = ko.observable('{ "title" : "", "body" : "", "linkid" : "" }');
			
	_self.getArticleList = function(target, callback) {
		callback = typeof (callback) == "function" ? callback : _self._getArticleListCallback;
		
		var Info = {
			ACTION: 'getarticlelist',
			SESSION: $.cookie('PHPSESSID'),
			JSON: ko.toJSON({
				userid: $.cookie('user_id'),
				passcode: $.cookie('passcode'),
				ipaddress: $.cookie('ipaddress'),
				article: _self.search_article()})
		};

		$.ajax({
			url: '../../json/editarticle.json.php',
			data: Info,
			dataType: 'json',
			type: "post",
			success: callback
		});
	}
	
	_self._getArticleListCallback = function(data) {
		_self.search_articleList(data);
		
		$('html, body').animate({
			scrollTop: $("#results").offset().top
		}, 2000);
	}
		
	_self.getArticle = function(target, callback) {
		callback = typeof (callback) == "function" ? callback : _self._getArticleCallback;
		
		if(!!!_self.currentArticle() || window.confirm("Are you sure you want switch to editing article " 
			+ target.id + 
			"? All current edits will be lost if you haven't saved them.")){		
			var Info = {
				ACTION: 'getarticle',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
					userid: $.cookie('user_id'),
					passcode: $.cookie('passcode'),
					ipaddress: $.cookie('ipaddress'),
					articleid: target.id
				})
			};
	
			$.ajax({
				url: '../../json/editarticle.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		}
	}
	
	_self._getArticleCallback = function(data) {
		_self.article(data);
		_self.currentArticle(data.linkid);		
	}
		
	_self.updateArticle = function(target, callback) {
		callback = typeof (callback) == "function" ? callback : _self._updateArticleCallback;
		
		var Info = {
			ACTION: 'updatearticle',
			SESSION: $.cookie('PHPSESSID'),
			JSON: ko.toJSON({
				userid: $.cookie('user_id'),
				passcode: $.cookie('passcode'),
				ipaddress: $.cookie('ipaddress'),
				linkid: _self.article().linkid,
				title: _self.article().title,
				body: _self.article().body 
				})
		};
		
		$.ajax({
			url: '../../json/editarticle.json.php',
			data: Info,
			dataType: 'json',
			type: "post",
			success: callback
		});
	}
	
	_self._updateArticleCallback = function(data) {
		if (data[0].success == "1") alert("Update Successful");		
		else alert("Update Failed");
	}
	
	_self.deleteArticle = function(target, callback) {
		callback = typeof (callback) == "function" ? callback : _self._deleteArticleCallback;
		
		if(window.confirm("Are you sure you want delete article " +  _self.currentArticle() + "? Deleted articles cannot be recovered.")){		
			var Info = {
				ACTION: 'deletearticle',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
					userid: $.cookie('user_id'),
					passcode: $.cookie('passcode'),
					ipaddress: $.cookie('ipaddress'),
					linkid: _self.currentArticle()
				})
			};
	
			$.ajax({
				url: '../../json/editarticle.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		}
	}
		
	_self._deleteArticleCallback = function(data) {
		if (data[0].success == "1") {
			alert("Delete Successful");	
			window.location = "editarticle.view.php";	
		}
		else alert("Delete Failed");
	}
	
	_self.getArticleList();
};