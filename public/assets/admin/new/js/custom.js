(function($){
	// ANIMATIONS //
	function animations() {
		animations = new WOW({});
		animations.init();
	}
	// DOCUMENT READY //
	$(document).ready(function(){
		if (typeof $.fn.superfish !== 'undefined') {}
		// ANIMATIONS //
		animations();
	});

	
	
	
})(window.jQuery);