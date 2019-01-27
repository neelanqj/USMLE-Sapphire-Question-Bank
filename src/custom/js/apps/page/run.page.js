iClickCounter = 0;
sPrevClick = 'X';

$('#loading, #loading2').click(function(event) {
	
	//if (sPrevClick != event.target.id) {
		iClickCounter = iClickCounter + 1;
	//	sPrevClick = event.target.id;
	//}
	
	if (iClickCounter > 7) {
		 $('#loading, #loading2').hide();
		 $('#content').show();
		}
	
	});