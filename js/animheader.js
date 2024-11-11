
  //function to parse this string: '--pegasus-header-fixed-menu-height: 71px; --pegasus-admin-bar-height: 32px;'
  function getCSSVariableValue(propertyName) {
    // Get the computed style of the document's root element (html)
    const rootStyles = document.documentElement.getAttribute('style');
    console.log( "rootStyles: ", rootStyles );
    // Get the value of the specified CSS variable
    //const variableValue = rootStyles;
    //console.log( "variableValue: ", variableValue );
    // Return the trimmed value
    //return variableValue.trim();
    const properties = rootStyles.split(';').filter(Boolean);

    // Parse each property and store it in an object
    const parsedCSS = {};
    properties.forEach(property => {
        const [key, value] = property.split(':').map(part => part.trim());
        if (key && value) {
            parsedCSS[key] = value;
        }
    });

    // Return the requested property value or null if not found
    return parsedCSS[propertyName] || null;
  }

  jQuery( window ).load(function() {
    //var	adminbarheight = jQuery("#wpadminbar").height();
    //console.log( "admin bar height: ", adminbarheight );

    let adminBarHeight = parseInt( getCSSVariableValue('--pegasus-admin-bar-height'), 10 );
    console.log( "Admin bar height 2: ", adminBarHeight );

    t(adminBarHeight);

    window.addEventListener('resize', function(adminBarHeight) {
      //adminBarHeight = getCSSVariableValue('--pegasus-admin-bar-height');
      //console.log( "Admin bar height 3: ", parseInt(adminBarHeight, 10) );
      t(adminBarHeight);
    });

  });

  function t(adminBarHeight = 32) {
    var windowWidth = window.innerWidth;
    var windowHeight = window.innerHeight;
    var g = {
      x: windowWidth / 2,
      y: windowHeight / 2
        };
    var largeHeader;
    var header_canvas;
    var h_height = jQuery("#header").height();

		//console.log(h_height);

		largeHeader = document.getElementById("large-header");

		var canvasNode = document.getElementById("demo-canvas");

		// if (jQuery("body").hasClass("navbar-fixed-top-is-active")) {
		// 	console.log( "Fixed Header checkbox: " + "yes" );
		// }

		//if (jQuery("body").hasClass("admin-bar")) {
			//console.log( "Admin Bar: " + "yes " + "height:" + adminbarheight);
			//windowHeight = windowHeight - adminbarheight;
		//}
		//console.log(c);

    //--pegasus-admin-bar-height
     // Get the value of the --pegasus-admin-bar-height CSS variable
     //const adminBarHeight = getComputedStyle(document.documentElement).getPropertyValue('--pegasus-admin-bar-height');
     //const styleAttribute = document.documentElement.getAttribute('style');
    //const variables = getCSSVariable(styleAttribute);
    //console.log( "style attribute: ", styleAttribute );

    //console.log("Admin bar height:", adminBarHeight);



     //const adminBarHeightVariable = variables.find(variable => variable.name === '--pegasus-admin-bar-height');
     //const adminBarHeight = adminBarHeightVariable ? parseFloat(adminBarHeightVariable.value) : 0;

     //const temp = document.documentElement.getAttribute('style');
      //console.log( "admin bar height: ", adminBarHeight );

    //console.log( "variables: ", variables );

		windowHeight = windowHeight - h_height;
		//console.log(windowHeight);
    if( jQuery('body').hasClass('admin-bar') ) {
      //const adminBarHeight = getCSSVariableValue('--pegasus-admin-bar-height');
      windowHeight = windowHeight - adminBarHeight;
    }
		//p.style.height = c + "px", f, f.width = u, f.height = c, m = f.getContext("2d");
    largeHeader.style.height = windowHeight + "px";
    canvasNode.width = windowWidth;
    canvasNode.height = windowHeight;
    header_canvas = canvasNode.getContext("2d");

		//console.log(m);
		//canvasNode.height = windowHeight;

		//console.log(p.style.height);
  }

  t();
