  	jQuery( window ).load(function() {
		var	adminbarheight = jQuery("#wpadminbar").height();
	});

  		function check_admin_height() {
			var adminbarheight = jQuery("#wpadminbar").height();
			console.log( "Admin Bar height: " + adminbarheight);
			return adminbarheight;
		}

  	function t(adminbarheight) {
		var u = window.innerWidth;
		var c = window.innerHeight - 90;
		var g = {
			x: u / 2,
			y: c / 2
        };
		var p;
		//var d;
		var m;

		if (jQuery("body").hasClass("admin-bar")) {
			check_admin_height();
			console.log( "Admin Bar: " + "yes" + "/n/r" + "height:" + adminbarheight );
			c = c - adminbarheight;
		}
		
		p = document.getElementById("large-header");
		
		var f = document.getElementById("demo-canvas");
		
		p.style.height = 
			c + "px", f, 
			f.width = u, 
			f.height = c, 
			m = f.getContext("2d"), 
		//d = [];
        //console.log(g);
    }

    t();
