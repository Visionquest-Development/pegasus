
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
				$('#header .collapse.navbar-collapse.in').removeAttr('id');
				$('#header .collapse.navbar-collapse.in').removeClass('in');
			}
		});
		
		
		
		
		  /*====================================
			Fixed Header
			======================================*/
				var  mn = $(".primary-menu");
				var mns = "main-nav-scrolled";
				var hdr = $('header').height() - 90;

			$(window).scroll(function() {
			  if( $(this).scrollTop() > hdr ) {
				mn.addClass(mns);
				$('#page-wrap').css('padding-top','90px');
			  } else {
				mn.removeClass(mns);
				$('#page-wrap').css('padding-top','0px');
			  }
			});
		
		

	}); //end document ready function



	
	