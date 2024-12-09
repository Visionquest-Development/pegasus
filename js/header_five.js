

/* Side bar animation JS */

jQuery(document).ready(function ($) {


  // if ( 'function' === typeof jQuery.cookie ) {
  //   if ( jQuery('#header').hasClass('open') ) {
  //     jQuery.cookie( 'pegasus_header_five_mobile_collapse', 'false', { expires: 7, path: '/' });
  //   } else {
  //     jQuery.cookie( 'pegasus_header_five_mobile_collapse', 'true', { expires: 7, path: '/' });
  //   }
  // }

  // if(jQuery.cookie('pegasus_header_five_mobile_collapsed')){
  //   jQuery.cookie('pegasus_header_five_mobile_collapsed', 'false', { expires: 7, path: '/' });
  // }

  if(jQuery.cookie('pegasus_header_five_mobile_collapsed') == 'true' || jQuery.cookie('pegasus_header_five_mobile_collapsed') == true ) {
      $("#header").removeClass("open");
      $(".sidebar-nav").css("left","-281px");
      $(".mainbar").css("margin-left","0px");
  }

  if(jQuery.cookie('pegasus_header_five_mobile_collapsed') == 'false' || jQuery.cookie('pegasus_header_five_mobile_collapsed') == false ) {
      $("#header").addClass("open");
      $(".sidebar-nav").css("left","0");
      $(".mainbar").css("margin-left","280px");
  }


	if($(window).width() <= 767){
		$("#header").removeClass("open");
		$(".sidebar-nav").css("left","-281px");
		$(".mainbar").css("margin-left","0px");
	}



	$(window).on('resize', function(){
		/* windows resize less than 1023 close it */
		if($(window).width() <= 1023){
			$("#header").removeClass("open");
			$(".sidebar-nav").css("left","-281px");
			$(".mainbar").css("margin-left","0px");

		}


	});




	$(".navi-btn a").on( 'click', function(e){
		e.preventDefault();
		var button = $(".navi-btn a");
		var side_bar = $("#header");
		var main_bar = $(".mainbar");

		if(side_bar.hasClass("open")){

			side_bar.animate({left:"-281px"});
			side_bar.removeClass("open");
			main_bar.css("margin-left","0px");
			if($(window).width() >= 1023){
				main_bar.css("margin-left","0px");
			}
      if ( 'function' === typeof jQuery.cookie ) {
        jQuery.cookie( 'pegasus_header_five_mobile_collapsed', 'true', { expires: 7, path: '/' });
      }
		}else{

			side_bar.animate({left:"0"});
			side_bar.addClass("open");
			main_bar.css("margin-left","0px");
			if($(window).width() >= 1023){
				main_bar.css("margin-left","280px");
			}
      if ( 'function' === typeof jQuery.cookie ) {
        jQuery.cookie( 'pegasus_header_five_mobile_collapsed', 'false', { expires: 7, path: '/' });
      }
		}

	});




});
