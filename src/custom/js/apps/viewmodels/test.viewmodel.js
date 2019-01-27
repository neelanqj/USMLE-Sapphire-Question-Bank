Core.ViewModel.Test = function() {
	var _self = this;
	
	_self.title = ko.observable('');
	_self.images = ko.observableArray();
	_self.question =  ko.observable('');
	_self.answeroptions =  ko.observableArray();
	_self.calculatorVisible = ko.observable(false);
	_self.notepadVisible = ko.observable(false);
	_self.labvaluesVisible = ko.observable(false);
	_self.questionbookmark = ko.observable(1);
	_self.totalquestions = ko.observable();
	_self.testmode = ko.observable();
	
	_self.questionStatusArray = ko.observableArray([]);
	_self.questionanswers = ko.observableArray([]);
	
	_self.flagStatus = ko.observable();
	_self.lockStatus = ko.observable();
	
	_self.questiontext = ko.observable(); // Question text
	_self.questionanswertext = ko.observableArray([]);
	_self.questionanswerimagestext = ko.observableArray([]);
	
	_self.timeLeftSeconds = ko.observable();
	_self.timeLeft = ko.computed(
						function() {
								var sec_num = parseInt(_self.timeLeftSeconds(), 10); // don't forget the second param
								var hours   = Math.floor(sec_num / 3600);
								var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
								var seconds = sec_num - (hours * 3600) - (minutes * 60);
							
								if (hours   < 10) {hours   = "0"+hours;}
								if (minutes < 10) {minutes = "0"+minutes;}
								if (seconds < 10) {seconds = "0"+seconds;}
								return hours+':'+minutes+':'+seconds;						
							}, this);
		
	_self.setFlag = function(target, callback) {		
		_self.questionStatusArray()[_self.questionbookmark() - 1].flag(
			!_self.questionStatusArray()[_self.questionbookmark() - 1].flag()
		);
		return true;
	}
	
	_self.setLock = function(target, callback) {		
		_self.questionStatusArray()[_self.questionbookmark() - 1].lock(
			!_self.questionStatusArray()[_self.questionbookmark() - 1].lock()
		);		
		_self.lockStatus(!_self.lockStatus());		
		return true;
	}
	
	_self.toggleCalculatorVisibility = function(target, callback) {
		_self.calculatorVisible(!_self.calculatorVisible());
		_self.notepadVisible(false);
		_self.labvaluesVisible(false);
	}
	
	_self.toggleNotepadVisibility = function(target, callback) {
		_self.notepadVisible(!_self.notepadVisible());
		_self.calculatorVisible(false);
		_self.labvaluesVisible(false);
	}	
	
	_self.toggleLabvaluesVisibility = function(target, callback) {
		_self.labvaluesVisible(!_self.labvaluesVisible());
		_self.notepadVisible(false);
		_self.calculatorVisible(false);
	}	
	
	_self.getTotalQuestions = function(target, callback) {
			callback = typeof (callback) == "function" ? callback : _self._getTotalQuestionsCallback;
			
			var Info = {
				ACTION: 'gettotalquestions',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
								userid: $.cookie('user_id'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress')})
			};
	
			$.ajax({
				url: '../../json/test.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
	}
	
	_self._getTotalQuestionsCallback = function(data) {
		_self.totalquestions(data[0].count);
		
		if (_self.totalquestions() == 0) {
		
		 	window.location = "message.view.php?message=You have no used questions left with these subjects and categories.";			
		}
		
		for (i=0; i < parseInt(data[0].count); i ++) {
			_self.questionStatusArray.push({ index: i + 1
											, answered: ko.observable(false)
											, flag: ko.observable(false)
											, lock: ko.observable(false) });
		}
	}
	
	_self.getQuestionBookmark = function(target, callback) {
			callback = typeof (callback) == "function" ? callback : _self._getQuestionBookmarkCallback;
			
			var Info = {
				ACTION: 'getquestionbookmark',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
								userid: $.cookie('user_id'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress')})
			};
	
			$.ajax({
				url: '../../json/test.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
	}
	
	_self._getQuestionBookmarkCallback = function(data) {
		
		if (data[0].logout == '1') { window.location = "logout.view.php" }
		_self.questionbookmark(data[0].questionbookmark);
		_self.flagStatus(_self.questionStatusArray()[_self.questionbookmark() - 1].flag());
		_self.lockStatus(_self.questionStatusArray()[_self.questionbookmark() - 1].lock());
		
		_self.getQuestionAnswers();

	}

	_self.prevQuestion = function(target, callback) {
			callback = typeof (callback) == "function" ? callback : _self._getQuestionCallback;
			
			var Info = {
				ACTION: 'prevquestion',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
								userid: $.cookie('user_id'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress')})
			};
	
			$.ajax({
				url: '../../json/test.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
	}
	
	_self.nextQuestion = function(target, callback) {
			callback = typeof (callback) == "function" ? callback : _self._getQuestionCallback;
			
			var Info = {
				ACTION: 'nextquestion',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
								userid: $.cookie('user_id'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress')})
			};
	
			$.ajax({
				url: '../../json/test.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
	}
	
	_self.getQuestion = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._getQuestionCallback;
			
			var Info = {
				ACTION: 'getquestion',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
								userid: $.cookie('user_id'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress'),
								questionbookmark: target? target.index : _self.questionbookmark() })
			};
	
			$.ajax({
				url: '../../json/test.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._getQuestionCallback = function(data) {
			_self.questiontext(data[0].question);
			_self.getQuestionBookmark();
		};
		
	_self.getQuestionAnswers = function(target, callback) {		
		callback = typeof (callback) == "function" ? callback : _self._getQuestionAnswersCallback;
		_self.questionanswertext([]); 
		
		var Info = {
			ACTION: 'getquestionanswers',
			SESSION: $.cookie('PHPSESSID'),
			JSON: ko.toJSON({
							userid: $.cookie('user_id'),
							passcode: $.cookie('passcode'),
							ipaddress: $.cookie('ipaddress')})
		};

		$.ajax({
			url: '../../json/test.json.php',
			data: Info,
			dataType: 'json',
			type: "post",
			success: callback
		});
	};
	
	_self._getQuestionAnswersCallback = function(data) {	
		for(i=0;i<data.length;i++) {
			_self.questionanswertext.push(data[i]);
		}
		
		_self.answerHistory();
	}
	
	_self.getQuestionAnswersImages = function(target, callback) {		
		callback = typeof (callback) == "function" ? callback : _self._getQuestionAnswersImagesCallback;
		_self.questionanswerimagestext([]); 
		
		var Info = {
			ACTION: 'getquestionanswerimages',
			SESSION: $.cookie('PHPSESSID'),
			JSON: ko.toJSON({
							userid: $.cookie('user_id'),
							passcode: $.cookie('passcode'),
							ipaddress: $.cookie('ipaddress')})
		};

		$.ajax({
			url: '../../json/test.json.php',
			data: Info,
			dataType: 'json',
			type: "post",
			success: callback
		});
	};
	
	_self._getQuestionAnswersImagesCallback = function(data) {	
		for(i=0;i<data.length;i++) {
			_self.questionanswerimagestext.push(data[i]);
		}
		
		if(_self.questionanswerimagestext().length = 0) {
			_self.questionanswerimagestext.push({link:'',description:''});
		}
	}
	
	_self.setAnswer = function(target, callback) {
		var Info = {
			ACTION: 'setanswer',
			SESSION: $.cookie('PHPSESSID'),
			JSON: ko.toJSON({
							userid: $.cookie('user_id'),
							passcode: $.cookie('passcode'),
							ipaddress: $.cookie('ipaddress'),
							questionbookmark: _self.questionbookmark(),
							questionanswers: _self.questionanswers()})
		};
		
		$.ajax({
			url: '../../json/test.json.php',
			data: Info,
			dataType: 'json',
			type: "post"
		});
		
		return true;
	};
	
	_self.answerHistory = function(target, callback) {		
		callback = typeof (callback) == "function" ? callback : _self._answerHistoryCallback;
		
		var Info = {
			ACTION: 'answerhistory',
			SESSION: $.cookie('PHPSESSID'),
			JSON: ko.toJSON({
							userid: $.cookie('user_id'),
							passcode: $.cookie('passcode'),
							ipaddress: $.cookie('ipaddress'),
							questionbookmark: _self.questionbookmark()})
		};
		
		$.ajax({
			url: '../../json/test.json.php',
			data: Info,
			dataType: 'json',
			type: "post",
			success: callback
		});
	};
	
	_self._answerHistoryCallback = function(data) {
		_self.questionanswers.removeAll();
		for(i=0;i<data.length;i++) {
			_self.questionanswers.push(data[i].questionanswersid);
		}
		
		_self.getQuestionAnswersImages();
	};
	
	_self.endBlockModal = function(target, callback) {
		$('#myModal').modal();	
	}
	
	_self.endBlock = function(target, callback) {
		callback = typeof (callback) == "function" ? callback : _self._endBlockCallback;
		
		// begin
		var Info = {
			ACTION: 'endblock',
			SESSION: $.cookie('PHPSESSID'),
			JSON: ko.toJSON({
							userid: $.cookie('user_id'),
							passcode: $.cookie('passcode'),
							ipaddress: $.cookie('ipaddress')})
		};
		
		$.ajax({
			url: '../../json/test.json.php',
			data: Info,
			dataType: 'json',
			type: "post",
			success: callback
		});
	}
	
	 _self._endBlockCallback = function(data) {
		 window.location = "mystatistics.view.php#results?results=1";		 
	 }
	
	_self.getRemainingTestTime = function(target, callback) {
		callback = typeof (callback) == "function" ? callback : _self._getRemainingTestTimeCallback;
		
		var Info = {
			ACTION: 'getremainingtime',
			SESSION: $.cookie('PHPSESSID'),
			JSON: ko.toJSON({
							userid: $.cookie('user_id'),
							passcode: $.cookie('passcode'),
							ipaddress: $.cookie('ipaddress')})
		};
		
		$.ajax({
			url: '../../json/test.json.php',
			data: Info,
			dataType: 'json',
			type: "post",
			success: callback
		});		
	}
	
	_self._getRemainingTestTimeCallback = function(data) {
		_self.timeLeftSeconds(data[0].remainingtime);
		
		if (_self.testmode() == 'timed') 
			setInterval(function() { 
				(_self.timeLeftSeconds() < 0)? _self.endBlock():_self.timeLeftSeconds(_self.timeLeftSeconds()-1);
			}, 1000);
	
	}
	
	_self.getTestMode = function(target, callback) {
		callback = typeof (callback) == "function" ? callback : _self._getTestModeCallback;
		
		var Info = {
			ACTION: 'gettestmode',
			SESSION: $.cookie('PHPSESSID'),
			JSON: ko.toJSON({
							userid: $.cookie('user_id'),
							passcode: $.cookie('passcode'),
							ipaddress: $.cookie('ipaddress')})
		};
		
		$.ajax({
			url: '../../json/test.json.php',
			data: Info,
			dataType: 'json',
			type: "post",
			success: callback
		});
	}
	
	 _self._getTestModeCallback = function(data) {
		 _self.testmode(data[0].testmode);		 
	 }
	 
	_self.getTestMode();
	_self.getQuestion();
	_self.getTotalQuestions();
	_self.getRemainingTestTime();
	
};
