Core.ViewModel.Comments = function() {
	var _self = this;
	_self.comment = ko.observable('');
	_self.commentList = ko.observableArray();
	_self.articleid = ko.observable($(document).getUrlParam("id") || '');
	_self.title = ko.observable('');
	_self.totalpages = ko.observable(1);
	_self.pagenum = ko.observable(1);
	_self.perpage = ko.observable(50);
	
	_self.setPage = function(target, callback) {
		_self.pagenum(target);		
		_self.listComments(target, _self._listCommentsCallback2);
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
	
	_self.getTitle = function(target, callback) {
		callback = typeof (callback) == "function" ? callback : _self._getTitleCallback;
		
			var Info = {
					ACTION: 'getTitle',
					SESSION: $.cookie('PHPSESSID'),
					JSON: ko.toJSON({
								userid: $.cookie('user_id'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress'),
								linkid: _self.articleid()})
				};
		
				$.ajax({
					url: '../../json/comments.json.php',
					data: Info,
					dataType: 'json',
					type: "post",
					success: callback
				});		
		
	}
	
	_self._getTitleCallback = function(data) {
		_self.title(data[0].title);	
	}
	
	_self.addComment = function(target, callback) {
		callback = typeof (callback) == "function" ? callback : _self._addCommentCallback;
		
		var Info = {
					ACTION: 'addcomment',
					SESSION: $.cookie('PHPSESSID'),
					JSON: ko.toJSON({
								userid: $.cookie('user_id'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress'),
								comment: _self.comment(),
								linkid: _self.articleid()})
				};
		
				$.ajax({
					url: '../../json/comments.json.php',
					data: Info,
					dataType: 'json',
					type: "post",
					success: callback
				});		
		};
	
	_self._addCommentCallback = function(data) {
			_self.listComments();
		};
	
	_self.listComments = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._listCommentsCallback;
			
			var Info = {
				ACTION: 'listcomments',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({ linkid: _self.articleid() })
			};
	
			$.ajax({
				url: '../../json/comments.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._listCommentsCallback = function(data) {
		_self.listCommentsCount();
		_self.commentList(data);
		};
		
	_self._listCommentsCallback2 = function(data) {
		_self.commentsList(data);
		};
	
	_self.listCommentsCount = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._listCommentsCountCallback;
			
			var Info = {
				ACTION: 'listcommentscount',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({ linkid: _self.articleid() })
			};
	
			$.ajax({
				url: '../../json/comments.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._listCommentsCountCallback = function(data) {
		_self.totalpages(parseInt(data[0].count));
		};
	
	_self.onEnter = function(data, event) {
			var keyCode = (event.which ? event.which : event.keyCode);
			if (keyCode === 13) {
				_self.listComments();
				return false;
			}
			return true;
		};

	_self.getTitle();
	_self.listComments();
};

