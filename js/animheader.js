  	jQuery( window ).load(function() {
		var	adminbarheight = jQuery("#wpadminbar").height();
	});

  	function t(adminbarheight) {
		var u = window.innerWidth;
		var c = window.innerHeight;
		var g = {
			x: u / 2,
			y: c / 2
        };
		var p;
		var d;
		var m;
		
		var h_height = jQuery("#header").height();
			
		
		//console.log(h_height);

		p = document.getElementById("large-header");
		
		var f = document.getElementById("demo-canvas");

		if (jQuery("body").hasClass("navbar-fixed-top-is-active")) {
			//console.log( "Fixed Header checkbox: " + "yes" );
		}

		if (jQuery("body").hasClass("admin-bar")) {
			//console.log( "Admin Bar: " + "yes" + "height:" + adminbarheight);
			//c = c - adminbarheight;
		}
		//console.log(c);

		//c = c - h_height;
		//console.log(c);
		p.style.height = c + "px", f, f.width = u, f.height = c, m = f.getContext("2d");
		//console.log(m);
		f.height = c;

		//console.log(p.style.height);
    }

    t();