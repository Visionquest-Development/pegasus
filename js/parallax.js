/*
Plugin: jQuery Parallax
Version 1.1.3
Author: Ian Lunn
Twitter: @IanLunn
Author URL: http://www.ianlunn.co.uk/
Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/

Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/

(function( $ ){
	var $window = $(window);
	var windowHeight = $window.height();

	$window.on( 'resize', function () {
		windowHeight = $window.height();
	});

	$.fn.parallax = function(xpos, speedFactor, outerHeight) {
		var $this = $(this);
		var getHeight;
		var firstTop;
		var paddingTop = 0;

		//get the starting position of each element to have parallax applied to it
		function update (){

			$this.each(function(){

				//firstTop = $this.offset().top;
                firstTop = 0;
			});

			if (outerHeight) {
				getHeight = function(jqo) {
					return jqo.outerHeight(true);
				};
			} else {
				getHeight = function(jqo) {
					return jqo.height();
				};
			}

			// setup defaults if arguments aren't specified
			if (arguments.length < 1 || xpos === null) xpos = "50%";
			if (arguments.length < 2 || speedFactor === null) speedFactor = 0.5;
			if (arguments.length < 3 || outerHeight === null) outerHeight = true;

			// function to be called whenever the window is scrolled or resized

				var pos = $(window).scrollTop();

				$this.each(function(){
					var $element = $(this);
					var top = $element.offset().top;
					var height = getHeight($element);

					// Check if totally above or totally below viewport
					if (top + height < pos || top > pos + windowHeight) {
						return;
					}

					if($(window).width() > 768) $this.css('backgroundPosition', xpos + " " + Math.round((firstTop - pos) * speedFactor) + "px");

				});
		}

		$window.on('scroll', update).resize(update);
		update();
	};
})(jQuery);







// =============================================
// Parallax Init
// =============================================

	//jQuery(window).on('load', function () {
		//parallaxInit();
	//});

	jQuery(document).ready(function($) {
		parallaxInit();
	});

	function parallaxInit() {
		jQuery('#small-header .parallax').each(function(){
			jQuery(this).parallax("50%", 0.5);
		});


		//jQuery('.parallax').each(function(){
			//jQuery(this).parallax("50%", 0.5);
		//});

		//jQuery('.single-qbiq_events .qbiq-parallax').each(function(){
			//jQuery(this).parallax("20%", 0.25);
		//});


		//jQuery('.parallax').each(function(){
			//jQuery(this).parallax("50%", 0.5);
		//});
	}
