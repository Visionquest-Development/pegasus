 /*====================================
    Fixed Header
    ======================================*/
    jQuery(window).bind('scroll', function($) {
        var navHeight = $(window).height() - 480;
		var width = $(window).width();
			
        if ($(window).scrollTop() > navHeight) {
            $('.header-sticky').addClass('on');
			if ((width>=768)) { $('#top-bar').addClass('hide'); }
        } else {
            $('.header-sticky').removeClass('on');
			$('#top-bar').removeClass('hide');
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
		if ($(window).scrollTop() >= 75) {
			
			$('#mega-menu').addClass('on');
			//$('#top-bar').addClass('hide');
		}
	});
