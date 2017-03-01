
		
/* Side bar animation JS */

jQuery(document).ready(function ($) {
	

	if($(window).width() <= 767){
		$("#header").removeClass("open");
		$(".sidebar-nav").css("left","-281px");
		$(".mainbar").css("margin-left","0px");
	}
	
	
		
	$(window).resize(function(){
		/* windows resize less than 1023 close it */
		if($(window).width() <= 1023){
			$("#header").removeClass("open");
			$(".sidebar-nav").css("left","-281px");
			$(".mainbar").css("margin-left","0px");
			
		}
		
		
	});
	
	
	
	
	$(".navi-btn a").click(function(e){
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
		}else{
			side_bar.animate({left:"0"});
			side_bar.addClass("open");
			main_bar.css("margin-left","0px");
			if($(window).width() >= 1023){
				main_bar.css("margin-left","280px");
			}
		} 
	}); 
	
	
	
	
});
