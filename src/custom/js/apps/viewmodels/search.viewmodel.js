Core.ViewModel.LinkSearch = function() {
	var _self = this;
	_self.linkList = ko.observableArray();
	_self.searchTerm = ko.observable($(document).getUrlParam("s") || '');
	_self.totalpages = ko.observable(1);
	_self.pagenum = ko.observable(1);
	_self.perpage = ko.observable(30);
	_self.newestannouncement = ko.observable();
	
	_self.category = ko.observable($(document).getUrlParam("f") || '');
	
	_self.setPage = function(target, callback) {
		_self.pagenum(target);		
		_self.searchLinks(target, _self._searchLinksCallback2);
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
	
	_self.scrolled = function (target, callback) {
               if (_self.pagenum() < _self.totalpages()) {
			_self.pagenum(_self.pagenum() + 1);
			_self.searchLinks(null, _self._searchLinksCallback3);
               }
	}
	
	_self._searchLinksCallback3 = function(data) {
			ko.utils.arrayForEach(data, function(element) {
				_self.linkList.push(element);
			});
		};

	_self.searchLinks = function(target, callback) {			
			callback = typeof (callback) == "function" ? callback : _self._searchLinksCallback;
			
			// begin
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
		// $('#channels').width($('#container').width());
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
	
	
	_self.selectCategory = function(target, callback) {
                _self.pagenum(1);
		_self.category(target);
		_self.searchLinks();
		};
	
	_self.onEnter = function(data, event) {
			var keyCode = (event.which ? event.which : event.keyCode);
			if (keyCode === 13) {
				_self.searchLinks();
				return false;
			}
			return true;
		};
		
		_self.getNewestAnnouncement = function(target, callback) {			
			callback = typeof (callback) == "function" ? callback : _self._getNewestAnnouncementCallback;
			
			// begin
			var Info = {
				ACTION: 'newestannouncement'
			};
	
			$.ajax({
				url: '../../json/search.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._getNewestAnnouncementCallback = function(data) {
		_self.newestannouncement(data[0][0]);
		};

	_self.searchLinks();
	_self.getNewestAnnouncement();
};

