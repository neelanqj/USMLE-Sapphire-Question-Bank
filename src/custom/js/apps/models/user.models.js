// JavaScript Document
Core.Model.UserDetails = function(obj) {
	var _self = this;
	obj || (obj = {});
	_self.country = ko.observable(obj.country || '-1');
	_self.province = ko.observable(obj.province || '-1');
	_self.state = ko.observable(obj.state || '-1');
	
	_self.region = ko.computed(function() {
			if (_self.country() == '1') {
				return _self.province();	
			} else if (_self.country() == '2') {
				return _self.state();	
			} else {
				return '-1';
			}
		});
	
	_self.email = ko.observable(obj.email || '').extend({ 
													pattern: { 
														params: /^([\d\w-\.]+@([\d\w-]+\.)+[\w]{2,4})?$/
														, message: "Invalid email address."
														} 
													});
													
	_self.password = ko.observable(obj.password || '').extend({
													required: {
														message: "Please provide your password."
														}
													});
													
	_self.password2 = ko.observable(obj.password2 || '').extend({
													required: {
														message: "Please provide your password."
														}
													});
													
	_self.phone = ko.observable(obj.phone || '').extend({ 
													pattern: { 
														params:/.{16,}/
														, message: "Invalid mobile number."
														} 
													});
														
	_self.firstName = ko.observable(obj.firstName || '').extend({
														required: {
															message: "Please provide your first name"
															}
														});
														
	_self.lastName = ko.observable(obj.lastName || '').extend({
														required: {
															message: "Please provide your last name"
															}
														});

	_self.postalCode = ko.observable(obj.postalCode || '');

	_self.city = ko.observable(obj.city || '');
	_self.careerLvl = ko.observable(obj.careerLvl || '-1');
	_self.education = ko.observable(obj.education || '-1');
};

Core.Model.User = function(obj) {
	var _self = this;
	obj || (obj = {});
	
	_self.email = ko.observable(obj.email || '');
	_self.password = ko.observable(obj.password || '');
};

Core.Model.Skill = function(obj) {
	var _self = this;
	obj || (obj = {});
	
	_self.lastused = ko.observable(obj.lastused || '0');
	_self.skillname = ko.observable(obj.skillname || '');
	_self.experience = ko.observable(obj.experience || '1');
};