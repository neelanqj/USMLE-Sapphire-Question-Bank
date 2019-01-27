/*!
 * Neelan Joachimpillai Configurable Slider
 *
 * Requires JQuery
 *
 * Copyright 2012, 2013
 * Released under the MIT license
 * http://opensource.org/licenses/MIT
 *
 * Date: 2013-09-14
 */

function Slider(container, nav) {
	var _self = this;
	_self.container = container, 
	_self.nav = nav, 
	_self.imgs = _self.container.find('img'), 
	_self.imgWidth = _self.imgs[0].width, 
	_self.imgsLen = _self.imgs.length, 
	$('#slider-nav').width(_self.imgWidth), _self.current = 0;
	
	// Add the button images
	$('#slider-nav').append("<img class='tilt' id='sliderImg-0' src='/src/library/slider/src/img/slidernav_current.png' width='33px' height='33px'>");
	
	for(i=0; i < _self.imgsLen - 1; i++) {
		$('#slider-nav').append("<img class='tilt' id='sliderImg-"+ (i+1) +"' src='/src/library/slider/src/img/slidernav.png' width='33px' height='33px'>");
	}
	
	// Initialize the buttons
	_self.nav.find('img').on('click', function() {
		slider.setFrame($(this).attr("id"));
		slider.transition();
	});
	
};

Slider.prototype.transition = function ( frame ) {
	var _self = this;	
	_self.container.animate({
		'margin-left': -( frame * _self.imgWidth ) || -( _self.current * _self.imgWidth /* window.innerWidth */)
	});
};

Slider.prototype.setCurrent = function ( dir ) {
	var new_pos, _self = this, pos = _self.current;
	
	$('#sliderImg-'+pos).attr('src', '/src/library/slider/src/img/slidernav.png');
	pos += ( ~~( dir === 'next' ) || -1 );
	new_pos = (pos < 0) ? _self.imgsLen - 1 : pos % _self.imgsLen; 
	
	$('#sliderImg-' + new_pos).attr('src', '/src/library/slider/src/img/slidernav_current.png');
	_self.current = new_pos;
	return pos;
};

// Navigation functionality
Slider.prototype.setFrame = function ( imgID ) {
	var _self = this, pos = _self.current;
	$('#sliderImg-'+pos).attr('src', '/src/library/slider/src/img/slidernav.png');
	
	var pos = imgID.substr(10);
	_self.current = pos;
	
	$('#sliderImg-'+pos).attr('src', '/src/library/slider/src/img/slidernav_current.png');
};

Slider.prototype.nextSlide = function () {
	var _self = this;
	_self.setCurrent('next');
	_self.transition();
	_self.slideTime(_self.current);
};

// Custom code
Slider.prototype.slideTime = function(pos) {
	var _self = this, time = $(_self.imgs[pos%_self.imgsLen]).data('time');	
	setTimeout(function() {_self.nextSlide()}, time);
}

Slider.prototype.start = function () {
	var _self = this, time = $(_self.imgs[0]).data('time');
	setTimeout(function() {_self.nextSlide()}, time);
}