Core.ViewModel.ApplyJob = function() {
	var _self = this;
	_self.resume = ko.observable();
	_self.coverletter = ko.observable();
	
	_self.apply = function(callback) {		
			callback = typeof (callback) == "function" ? callback : _self._applyCallback;
			
			// begin
			var Info = {
				ACTION: 'apply',
				SESSION: $('#session').val(),
				JSON: ko.toJSON({userID: $('#userID').val(),
								jobID: $('#jobID').val(),
								resume: _self.resume() || '',
								coverletter: _self.coverletter() || '',
								email: $.cookie('email'),
								passcode: $.cookie('passcode'),
								ipaddress: $.cookie('ipaddress')})
			};
	
			$.ajax({
				url: '../../json/applyjob.json.php',
				data: Info,
				dataType: 'json',
				type: "post",
				success: callback
			});
		};
		
	_self._applyCallback = function(data) {
			if (data[0].success == '1') {
				window.location = "message.view.php?message=Successfully applied for the job.&mood=positive";
			} else {
				window.location = "message.view.php?message=You already applied for this position.&mood=negative";
			}
		};
};

