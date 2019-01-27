Core.Model.Message = function(obj) {
	var _self = this;
	obj || (obj = {});
	
	_self.title = ko.observable(obj.title || '');
	_self.message = ko.observable(obj.message || '');
	_self.messageid = ko.observable(obj.mid || '');	
	_self.createdate = ko.observable(obj.createdate || '');
	_self.revisedate = ko.observable(obj.revisedate || '');
};

