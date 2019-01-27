// JavaScript Document
Core.Model.Skill = function(obj) {
	var _self = this;
	obj || (obj = {});
	
	_self.mandatory = ko.observable(obj.mandatory || true);
	_self.skillname = ko.observable(obj.skill || '');
	_self.experience = ko.observable(obj.experience || '0');	
};

Core.Model.Job = function (obj) {
	var _self = this;
	
	obj || (obj = {});
	
	_self.company = ko.observable(obj.company || '');
	_self.title = ko.observable(obj.title || '');
	_self.country = ko.observable(obj.country || '');
	
	_self.state = ko.observable(obj.state || '');
	_self.province = ko.observable(obj.province || '');	
	_self.region = ko.computed(function() {
			if (_self.country() == '1') {
				return _self.province();	
			} else if (_self.country() == '2') {
				return _self.state();	
			} else {
				return null;
			}
		});
	_self.city = ko.observable(obj.city || '');
	
	_self.address1 = ko.observable(obj.address1 || '');
	_self.address2 = ko.observable(obj.address2 || '');
	_self.postalcode = ko.observable(obj.postalcode || '');
	_self.contactname = ko.observable(obj.contactname || '');
	_self.contactphonenumber = ko.observable(obj.contactnumber || '');
	_self.contactemail = ko.observable(obj.contactemail || '');
	_self.hidecontactemail = ko.observable(obj.hideemail || false);
	_self.hidecontactphonenumber = ko.observable(obj.hidephonenumber || false);
	_self.expirationdate = ko.observable(obj.expiredate || null);
	_self.formatedexpirationdate = ko.computed(function() {
			return standardMDYFormat(_self.expirationdate());
		});
	_self.description = ko.observable(obj.description || '');
	_self.category = ko.observable(obj.category || '');
	_self.education = ko.observable(obj.education || '-1');
	_self.careerlvl = ko.observable(obj.careerlvl || '-1');
	
	_self.skillList = ko.observableArray(obj.skillList || []);
	_self.minsalary = ko.observable(obj.minsalary || '0.00');
	_self.maxsalary = ko.observable(obj.maxsalary || '0.00');
};