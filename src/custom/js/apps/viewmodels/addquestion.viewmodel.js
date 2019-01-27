Core.ViewModel.AddQuestion = function() {
	var _self = this;
	
	_self.questionCategoriesList = ko.observableArray();
	_self.questionSubjectsList = ko.observableArray();
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
		_self.questionCategoriesList(data);	
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
		_self.questionSubjectsList(data);
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

	_self.removeImgFile = function(target, callback) {
		_self.questionImages.pop(target);
	}
	
	_self.createQuestion = function(target, callback) {
		callback = typeof (callback) == "function" ? callback : _self._createQuestionCallback;
		
		var Info = {
			ACTION: 'createquestion',
			SESSION: $.cookie('PHPSESSID'),
			JSON: ko.toJSON({
							userid: $.cookie('user_id'),
							passcode: $.cookie('passcode'),
							ipaddress: $.cookie('ipaddress'),
							category: _self.category(),
							subject: _self.subject(),
							question: _self.question().replace(/\r?\n/g, '<br />'),
							images: _self.questionImages(),
							answers: _self.answerOptions()})
		};

		$.ajax({
			url: '../../json/addquestion.json.php',
			data: Info,
			dataType: 'json',
			type: "post",
			success: callback
		});
		
	}
	
	_self._createQuestionCallback = function(data) {
		window.location = "message.view.php?message=Question Added!";
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
	
	_self.getCategoriesList();
	_self.getSubjectsList();
	
};