Core.ViewModel.QBankSetup = function() {
	var _self = this;
	_self.testmode = ko.observable("timed");
	_self.questioncount = ko.observable(30);
	_self.testtime = ko.computed(function() {
						return _self.testmode() == 'timed' ? _self.questioncount() : 'Unlimited';
					}, this);
								
	_self.questiontype = ko.observable("all");
	
	_self.questionsubjects = ko.observableArray();
	_self.questioncategories = ko.observableArray();
	
	_self.questionsubjectsselected = ko.observableArray([]);
	_self.questioncategoriesselected = ko.observableArray([]);
								
	_self.allcategories = ko.computed({
        read: function() {
            var item = ko.utils.arrayFirst(_self.questioncategoriesselected(), function(item) {
                return true;
            });
            return false;
        },
        write: function(value) {
			_self.questioncategoriesselected.removeAll();
			
            ko.utils.arrayForEach(_self.questioncategories(), function (cat) {
                _self.questioncategoriesselected.push(cat.name);
            });
        }
    });
	
								
	_self.clearcategories = ko.computed({
        read: function() {
            var item = ko.utils.arrayFirst(_self.questioncategoriesselected(), function(item) {
                return true;
            });
			
			return item == null;
        },
        write: function(value) {
			_self.questioncategoriesselected.removeAll();
        }
    });	
	
	_self.allsubjects = ko.computed({
        read: function() {
            var item = ko.utils.arrayFirst(_self.questionsubjectsselected(), function(item) {
                return true;
            });
            return false;
        },
        write: function(value) {
			_self.questionsubjectsselected.removeAll();
			
            ko.utils.arrayForEach(_self.questionsubjects(), function (subj) {
                _self.questionsubjectsselected.push(subj.name);
            });
        }
    });
	
	_self.clearsubjects = ko.computed({
        read: function() {
            var item = ko.utils.arrayFirst(_self.questionsubjectsselected(), function(item) {
                return true;
            });
            return item == null;
        },
        write: function(value) {
			_self.questionsubjectsselected.removeAll();
        }
    });	
	
	_self.startEnabled = ko.computed(function() {
					return (_self.questioncount() > 0 && 
					(_self.questionsubjectsselected().length > 0 && _self.questioncategoriesselected().length > 0)) ? true : false;
					}, this);
	
	_self.modalText = ko.computed(function() {
					return (_self.questioncount() > 0 ) ? "Once started, you will have " + _self.testtime() + " minutes to finish the test. Your results will be stored for this month and contribute to your performance statistics. If you leave the test before completing it, you will have to start the test again." : "Please make sure you have at least one subject, system  and more than one question in your osetup options.";
					}, this);
												
	_self.checkTestSetup = function(callback) {		
						$('#myModal').modal();		
					}
	
	_self.startTest = function(callback) {
			callback = typeof (callback) == "function" ? callback : _self._startTestCallback;
			
			_self.createTest();
		
			var Info = {
					ACTION: 'getTitle',
					SESSION: $.cookie('PHPSESSID'),
					JSON: ko.toJSON({
								userid: $.cookie('user_id'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress'),
								testmode: _self.testmode(),
								questioncount: _self.questioncount(),
								testtime: _self.testtime(),
								questiontype: _self.questiontype(),
								questioncategories: _self.questioncategoriesselected(),
								questionsubjects: _self.questionsubjectsselected()							
							})
				};
		
				$.ajax({
					url: '/json/qbanksetup.json.php',
					data: Info,
					dataType: 'json',
					type: "post",
					success: callback
				});
	}
	
	_self.getSubjects = function(callback) {
		callback = typeof (callback) == "function" ? callback : _self._getSubjectsCallback;
		
		var Info = {
				ACTION: 'getsubjects',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
							userid: $.cookie('user_id'),
							passcode: $.cookie('passcode'),
							ipaddress: $.cookie('ipaddress')													
							})
			};
			
		$.ajax({
				url: '/json/qbanksetup.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		
	}	
	
	_self._getSubjectsCallback = function(data) {
		_self.questionsubjects(data);
		
		if (data[0].logout == '1') { window.location = "signup.view.php" }
		
	}
	
	_self.getCategories = function(callback) {
		callback = typeof (callback) == "function" ? callback : _self._getCategoriesCallback;
		
		var Info = {
				ACTION: 'getcategories',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
							userid: $.cookie('user_id'),
							passcode: $.cookie('passcode'),
							ipaddress: $.cookie('ipaddress')													
							})
			};
			
		$.ajax({
				url: '/json/qbanksetup.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		
	}
	
	_self._getCategoriesCallback = function(data) {
		_self.questioncategories(data);
	}	
	
	_self.createTest = function(callback) {
		callback = typeof (callback) == "function" ? callback : _self._createTestCallback;
		
		var Info = {
				ACTION: 'createtest',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
							userid: $.cookie('user_id'),
							passcode: $.cookie('passcode'),
							ipaddress: $.cookie('ipaddress'),
							subjects: _self.questionsubjectsselected(),
							categories: _self.questioncategoriesselected(),
							questiontype: _self.questiontype(),
							testmode: _self.testmode(),
							questioncount: _self.questioncount()													
							})
			};
			
		$.ajax({
				url: '/json/qbanksetup.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		
	}	
	
	_self._createTestCallback = function(data) {
		window.location = "test.view.php";
	}
	
	
	_self.getSubjects();
	_self.getCategories();
	
};

