

var VM = {};

VM = new Core.ViewModel.LinkSearch();

// Initialize the knockout function
ko.applyBindings(VM);

/* ************* Setup Category Buttons ************* */	
$('.categories').click(function() {
	VM.selectCategory($(this).attr("id"));
});
