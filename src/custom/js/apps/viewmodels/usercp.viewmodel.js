Core.ViewModel.UserCP = function() {
	var _self = this;
	_self.cinemaPanel = ko.observable(false);
	
	_self.setVisibility = function(callback) {		
			if ($.cookie('accounttype') == 3) {
				_self.cinemaPanel(true);
			}
		};

	_self.setVisibility();
};

