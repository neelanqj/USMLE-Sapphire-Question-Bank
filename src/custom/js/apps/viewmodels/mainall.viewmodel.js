Core.ViewModel.MainAll = function() {
	var _self = this;
	_self.linkList = ko.observableArray();
	_self.newsList = ko.observableArray();
	_self.searchTerm = ko.observable('');
	_self.totalpages = ko.observable(1);
	_self.pagenum = ko.observable(1);
	_self.perpage = ko.observable(5);
	
	_self.category = ko.observable('announcements');
	
	_self.setPage = function(target, callback) {
		_self.pagenum(target);		
		_self.searchLinks(target, _self._searchLinksCallback2);
	}

	_self.searchNews = function(target, callback) {			
			callback = typeof (callback) == "function" ? callback : _self._searchNewsCallback;
			
			var Info = {
				ACTION: 'search',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({category: '',
								searchterm: _self.searchTerm(),
								pagenum: _self.pagenum(),
								perpage: 2})
			};
	
			$.ajax({
				url: '../../json/search.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._searchNewsCallback = function(data) {	
		_self.newsList(data);
	}

	_self.searchLinks = function(target, callback) {			
			callback = typeof (callback) == "function" ? callback : _self._searchLinksCallback;
			
			var Info = {
				ACTION: 'search',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({category: _self.category(),
								searchterm: _self.searchTerm(),
								pagenum: _self.pagenum(),
								perpage: _self.perpage()})
			};
	
			$.ajax({
				url: '../../json/search.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._searchLinksCallback = function(data) {
		_self.searchLinksCount();
		_self.linkList(data);
		};
		
	_self._searchLinksCallback2 = function(data) {
		_self.linkList(data);
		};
	
	_self.searchLinksCount = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._searchLinksCountCallback;
			
			var Info = {
				ACTION: 'count',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({category: _self.category(),
								searchterm: _self.searchTerm(),
								pagenum: _self.pagenum(),
								perpage: _self.perpage()})
			};
	
			$.ajax({
				url: '../../json/search.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._searchLinksCountCallback = function(data) {
		_self.totalpages(parseInt(data[0].count));
		};
		
	_self.searchLinks();
	_self.searchNews();
};
