Core.ViewModel.EditQuestion = function() {
	var _self = this;
		
	_self.search_questionCategoriesList = ko.observableArray();
	_self.search_questionSubjectsList = ko.observableArray();
	_self.search_subject = ko.observable({name :""});
	_self.search_category = ko.observable({name :""});
	
	_self.search_questionList = ko.observableArray([]);
	_self.search_question = ko.observable("");
	
	_self.currentQuestion = ko.observable();
	
	/* Add Question Variables */
	_self.subject = ko.observable();
	_self.category = ko.observable();
	_self.question = ko.observable("");
	_self.answerOptions = ko.observableArray([{ index: '1', answer: '', explaination: '', correct: '' }]);
	_self.fileName = ko.observable();
  	_self.url = window.location.protocol + "//" + window.location.host + "/json/fileupload.json.php";
	_self.questionImages = ko.observableArray();
	_self.uploadComment = ko.observable();
	
	_self.createButtonEnabled = ko.computed(function() {
		return (_self.answerOptions().length > 1 && _self.question().trim() != "" && _self.question().length > 50 && _self.subject() != "" && _self.category() != "")? true:false ;
	});
	/* End of Add Question Variables */
	
	_self.getQuestionList = function(target, callback) {
		callback = typeof (callback) == "function" ? callback : _self._getQuestionListCallback;
		
		var Info = {
			ACTION: 'getquestionlist',
			SESSION: $.cookie('PHPSESSID'),
			JSON: ko.toJSON({
				userid: $.cookie('user_id'),
				passcode: $.cookie('passcode'),
				ipaddress: $.cookie('ipaddress'),
				category: (!!_self.search_category().name?_self.search_category().name : ""),
				subject: (!!_self.search_subject().name?_self.search_subject().name: ""),
				question: _self.search_question()})
		};

		$.ajax({
			url: '../../json/editquestion.json.php',
			data: Info,
			dataType: 'json',
			type: "post",
			success: callback
		});
	}
	
	_self._getQuestionListCallback = function(data) {
		if (data[0].logout == '1') { window.location = "logout.view.php" }
		_self.search_questionList(data);
		
		$('html, body').animate({
			scrollTop: $("#results").offset().top
		}, 2000);
	}	
	
	_self.getCategoriesList = function(target, callback) {
		callback = typeof (callback) == "function" ? callback : _self._getCategoriesListCallback;
		
		var Info = {
			ACTION: 'getcategories',
			SESSION: $.cookie('PHPSESSID'),
			JSON: ko.toJSON({
				userid: $.cookie('user_id'),
				passcode: $.cookie('passcode'),
				ipaddress: $.cookie('ipaddress')})
		};

		$.ajax({
			url: '../../json/addquestion.json.php',
			data: Info,
			dataType: 'json',
			type: "post",
			success: callback
		});
		
	}	
	
	_self._getCategoriesListCallback = function(data) {	
		data.unshift('');
		_self.search_questionCategoriesList(data);	
	}
	
	_self.getSubjectsList = function(target, callback) {
		callback = typeof (callback) == "function" ? callback : _self._getSubjectsListCallback;
		
		var Info = {
			ACTION: 'getsubjects',
			SESSION: $.cookie('PHPSESSID'),
			JSON: ko.toJSON({
				userid: $.cookie('user_id'),
				passcode: $.cookie('passcode'),
				ipaddress: $.cookie('ipaddress')})
		};

		$.ajax({
			url: '../../json/addquestion.json.php',
			data: Info,
			dataType: 'json',
			type: "post",
			success: callback
		});
	}
	
	_self._getSubjectsListCallback = function(data) {	
		data.unshift('');
		_self.search_questionSubjectsList(data);
	}
	
	// Below is the edit question code
	_self.getQuestion = function(target, callback) {
		callback = typeof (callback) == "function" ? callback : _self._getQuestionCallback;
		if(!!!_self.currentQuestion() || window.confirm("Are you sure you want switch to editing question " 
			+ target.questionid + 
			"? All current edits will be lost if you haven't saved them.")){		
			var Info = {
				ACTION: 'getquestion',
				SESSION: $.cookie('PHPSESSID'),
				JSON: ko.toJSON({
					userid: $.cookie('user_id'),
					passcode: $.cookie('passcode'),
					ipaddress: $.cookie('ipaddress'),
					questionid: target.questionid
					})
			};
	
			$.ajax({
				url: '../../json/editquestion.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		}
	}
	
	_self._getQuestionCallback = function(data) {
		_self.question(data[0].question);
		_self.category(data[0].category);
		_self.subject(data[0].subject);
		_self.currentQuestion(data[0].questionid);
		_self.getQuestionImages();
		
		$('html, body').animate({
			scrollTop: $("#results").offset().top - 110
		}, 2000);
	}
	
	_self.getQuestionImages = function(target, callback) {
		callback = typeof (callback) == "function" ? callback : _self._getQuestionImagesCallback;
		
		var Info = {
			ACTION: 'getquestionimages',
			SESSION: $.cookie('PHPSESSID'),
			JSON: ko.toJSON({
				userid: $.cookie('user_id'),
				passcode: $.cookie('passcode'),
				ipaddress: $.cookie('ipaddress'),
				questionid: _self.currentQuestion()})
		};

		$.ajax({
			url: '../../json/editquestion.json.php',
			data: Info,
			dataType: 'json',
			type: "post",
			success: callback
		});		
	}
	
	_self._getQuestionImagesCallback = function(data) {
		_self.questionImages(data);
		_self.getAnswers();
	}
	
	_self.addImages = function(target, callback) {
		_self.questionImages.push('');
	}
	
	_self.addAnswer = function(target, callback) {
		_self.answerOptions.push( { index: _self.answerOptions().length + 1, answer: '', explaination: '',correct: '' } );
	}
	
	_self.removeAnswer = function(target, callback) {
		_self.answerOptions.remove(target);	
	}
	
	_self.getAnswers = function(target, callback) {
		callback = typeof (callback) == "function" ? callback : _self._getAnswersCallback;
		
		var Info = {
			ACTION: 'getquestionanswers',
			SESSION: $.cookie('PHPSESSID'),
			JSON: ko.toJSON({
				userid: $.cookie('user_id'),
				passcode: $.cookie('passcode'),
				ipaddress: $.cookie('ipaddress'),
				questionid: _self.currentQuestion()})
		};

		$.ajax({
			url: '../../json/editquestion.json.php',
			data: Info,
			dataType: 'json',
			type: "post",
			success: callback
		});				
	}
	
	_self._getAnswersCallback = function(data) {

                data.forEach(function(element) {
                          element.correct = parseInt(element.correct);
                     });
		_self.answerOptions(data);
       
	}	
	
	_self.removeImgFile = function(target, callback) {
		_self.questionImages.pop(target);
	}
	
	/* http://www.anyexample.com/programming/php/php_ajax_example__asynchronous_file_upload.xml */
	_self.fileName.subscribe( function(element) {		
			var re_text = /\.jpg|\.jpeg|\.gif|\.png|\.bmp/i;
			var filename = element.replace("C:\\fakepath\\", "");
			
			if (_self.fileName() != '') {
				if (filename.search(re_text) == -1)
				{
					alert("File does not have text(jpg, jpeg, gif, png, bmp) extension");
					$("#imageupload").reset();
					return false;
				}
			
				$("#imageupload").submit();
				$("#uploadComment").html('<img id="loadingImg" src="/src/custom/img/animate/mini-loading.gif"></img>');
				_self.questionImages.push( { 'fileName': filename, 'fileValue' : $('#identity').val() + filename, 'description': ko.observable('') });
				
				$("#imageupload").disabled = true;
				_self.fileName('');
				
				return true;
			}
	});
			
	_self.updateQuestion = function(target, callback) {
		callback = typeof (callback) == "function" ? callback : _self._updateQuestionCallback;
		
		var Info = {
			ACTION: 'updatequestion',
			SESSION: $.cookie('PHPSESSID'),
			JSON: ko.toJSON({
				userid: $.cookie('user_id'),
				passcode: $.cookie('passcode'),
				ipaddress: $.cookie('ipaddress'),
				questionid: _self.currentQuestion(),
				question:_self.question(),
				answers:_self.answerOptions(),
				images:_self.questionImages(),
				category:_self.category(),
				subject:_self.subject()
				})
		};

		$.ajax({
			url: '../../json/editquestion.json.php',
			data: Info,
			dataType: 'json',
			type: "post",
			success: callback
		});
	}
	
	_self._updateQuestionCallback = function(data){
		 	window.location = "message.view.php?message=Question Updated!"
	};	
			
	_self.deleteQuestion = function(target, callback) {
		callback = typeof (callback) == "function" ? callback : _self._deleteQuestionCallback;
		if(!!!_self.currentQuestion() || window.confirm("Are you sure you want delete question " 
			+ target.questionid + 
			"? All deleted items cannot be recovered.")){
				var Info = {
					ACTION: 'deletequestion',
					SESSION: $.cookie('PHPSESSID'),
					JSON: ko.toJSON({
						userid: $.cookie('user_id'),
						passcode: $.cookie('passcode'),
						ipaddress: $.cookie('ipaddress'),
						questionid: _self.currentQuestion()
						})
				};
		
				$.ajax({
					url: '../../json/editquestion.json.php',
					data: Info,
					dataType: 'json',
					type: "post",
					success: callback
				});
		}
	}
	
	_self._deleteQuestionCallback = function(data){
		 	window.location = "message.view.php?message=Question Deleted!"
	};
	/* end*/
	
	_self.getCategoriesList();
	_self.getSubjectsList();	
	
	_self.getQuestionList();	
};
