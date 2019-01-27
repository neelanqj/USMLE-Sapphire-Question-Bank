Core.ViewModel.Test_Review = function() {
	var _self = this;
	_self.url = window.location.toString();
	_self.testhistoryid = _self.url.substring(_self.url.indexOf("=")+1, _self.url.length);
	
	_self.title = ko.observable('');
	_self.images = ko.observableArray();
	_self.question =  ko.observable('');
	_self.answeroptions =  ko.observableArray();
	_self.calculatorVisible = ko.observable(false);
	_self.notepadVisible = ko.observable(false);
	_self.labvaluesVisible = ko.observable(false);
	_self.questionbookmark = ko.observable(1);
	_self.totalquestions = ko.observable();
	_self.testmode = ko.observable("Review Mode");
	
	_self.questionStatusArray = ko.observableArray([]);
	_self.questionanswers = ko.observableArray([]);
	
	_self.questiontext = ko.observable(); // Question text
	_self.questioncorrect = ko.observable();
	_self.questionanswertext = ko.observableArray([]);
	_self.questionanswerimagestext = ko.observableArray([]);
	
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
								ipaddress: $.cookie('ipaddress'),
								testhistoryid: _self.testhistoryid })
			};
	
			$.ajax({
				url: '../../json/test_review.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
	}
	
	_self._getTotalQuestionsCallback = function(data) {
		_self.totalquestions(data[0].count);
		
		for (i=0; i < parseInt(data[0].count); i ++) {
			_self.questionStatusArray.push({ index: i + 1
											, answered: ko.observable(false)
											, flag: ko.observable(false)
											, lock: ko.observable(false) });
		}
	}

	_self.prevQuestion = function(target, callback) {
			callback = typeof (callback) == "function" ? callback : _self._getQuestionCallback;
		
			questionnumber =  parseInt(_self.questionbookmark()) - 1;			
			if (questionnumber < 1) questionnumber = 1;

			var Info = {
				ACTION: 'getquestion',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
								userid: $.cookie('user_id'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress'),
								testhistoryid: _self.testhistoryid,
								questionnumber: questionnumber 
								})
			};
			
			$.ajax({
				url: '../../json/test_review.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
	}
	
	_self.nextQuestion = function(target, callback) {
			callback = typeof (callback) == "function" ? callback : _self._getQuestionCallback;
			
			questionnumber =  parseInt(_self.questionbookmark()) + 1;
			if (questionnumber > _self.totalquestions()) questionnumber = _self.totalquestions();
			
			var Info = {
				ACTION: 'getquestion',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
								userid: $.cookie('user_id'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress'),
								testhistoryid: _self.testhistoryid,
								questionnumber: questionnumber 
								})
			};
			
			$.ajax({
				url: '../../json/test_review.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
	}
	
	_self.getQuestion = function(target, callback) {		
			callback = typeof (callback) == "function" ? callback : _self._getQuestionCallback;
			
			try {
				if (target.index) questionnumber = target.index;
			} catch (e) {
				questionnumber =  _self.questionbookmark();
			} finally {
				var Info = {
					ACTION: 'getquestion',
					SESSION: $.cookie('PHPSESSID'),
					JSON: ko.toJSON({
									userid: $.cookie('user_id'),
									passcode: $.cookie('passcode'),
									ipaddress: $.cookie('ipaddress'),
									testhistoryid: _self.testhistoryid,
									questionnumber: questionnumber 
									})
				};
				
				$.ajax({
					url: '../../json/test_review.json.php',
					data: Info,
					dataType: 'json',
					type: "post",
					success: callback
				});
			}
		};
		
	_self._getQuestionCallback = function(data) {
			if (data[0].logout == '1') { window.location = "logout.view.php" }
			_self.questiontext(data[0].question);
			_self.questioncorrect(data[0].correct);
			_self.getQuestionAnswers(data[0], null);
			_self.getQuestionAnswersImages(data[0], null);
			_self.questionbookmark(data[0].questionnumber);
		};
		
	_self.getQuestionAnswers = function(target, callback) {		
		callback = typeof (callback) == "function" ? callback : _self._getQuestionAnswersCallback;
		_self.questionanswertext([]);
			
		try {
			if (target.questionnumber) questionnumber = target.questionnumber;
		} catch (e) {
			questionnumber =  _self.questionbookmark();
		} finally {		
			var Info = {
				ACTION: 'getquestionanswers',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
								userid: $.cookie('user_id'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress'),
								testhistoryid: _self.testhistoryid,
								questionnumber: questionnumber
								})
			};
	
			$.ajax({
				url: '../../json/test_review.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		}
	};
	
	_self._getQuestionAnswersCallback = function(data) {	
		for(i=0;i<data.length;i++) {
			_self.questionanswertext.push(data[i]);
		}
	}
	
	_self.getQuestionAnswersImages = function(target, callback) {		
		callback = typeof (callback) == "function" ? callback : _self._getQuestionAnswersImagesCallback;
		_self.questionanswerimagestext([]); 
			
		try {
			if (target.questionnumber) questionnumber = target.questionnumber;
		} catch (e) {
			questionnumber =  _self.questionbookmark();
		} finally {
			var Info = {
				ACTION: 'getquestionanswerimages',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
								userid: $.cookie('user_id'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress'),
								testhistoryid: _self.testhistoryid,
								questionnumber: questionnumber})
			};
	
			$.ajax({
				url: '../../json/test_review.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		}
	};
	
	_self._getQuestionAnswersImagesCallback = function(data) {	
		for(i=0;i<data.length;i++) {
			_self.questionanswerimagestext.push(data[i]);
		}
		
		if(_self.questionanswerimagestext().length = 0) {
			_self.questionanswerimagestext.push({link:'',description:''});
		}
	}
	
	_self.endBlockModal = function(target, callback) {
		$('#myModal').modal();	
	}
	
	_self.endBlock = function(target, callback) {
		window.location = "mystatistics.view.php";
	}
	
	_self.getQuestion();
	// _self.getQuestionAnswers();
	_self.getTotalQuestions();
	_self.getQuestionAnswersImages();	
};
