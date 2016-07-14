 /*====================================
    Fixed Header
    ======================================*/
    jQuery(window).bind('scroll', function() {
        var navHeight = jQuery(window).height() - 480;
		var width = jQuery(window).width();
			
        if (jQuery(window).scrollTop() > navHeight) {
            jQuery('.header-sticky').addClass('on');
			if ((width>=768)) { jQuery('#top-bar').addClass('hide'); }
        } else {
            jQuery('.header-sticky').removeClass('on');
			jQuery('#top-bar').removeClass('hide');
        }
    });
	
	
	jQuery(document).ready(function($) {
		
		
		/*=========================*/
		/* 	CUSTOM HEADER  */
		/*=========================*/
		$('.navbar-toggle').click(function(e){
			e.preventDefault();
			$('.collapse.navbar-collapse').addClass('in');
			$('body').addClass('mobile-menu-open');
			$('.collapse.navbar-collapse').show().prop('id', 'mobile-menu-wrap');
		});
		$('.mobile-menu-close').click(function(e){
			e.preventDefault();
			// $('.collapse.navbar-collapse').removeClass('in');
			$('body').removeClass('mobile-menu-open');
			// $('.collapse.navbar-collapse').removeClass('in').hide();
		});
		$( window ).resize(function() {
			var width = $(window).width();
			if ((width>=768)) {
				$('body').removeClass('mobile-menu-open');
				$('.collapse.navbar-collapse.in').removeAttr('id');
				$('.collapse.navbar-collapse.in').removeClass('in');
			}
		});
		
		

	}); //end document ready function
	
	
	/* this makes the header have the on class if you refresh the page when scrolled down */
	jQuery(document).scroll(function($) {
		if (jQuery(window).scrollTop() >= 75) {
			
			jQuery('#mega-menu').addClass('on');
			//jQuery('#top-bar').addClass('hide');
		}
	});
