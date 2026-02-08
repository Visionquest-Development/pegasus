/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~PEGASUS CUSTOM JS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

/*!
 * IE10 viewport hack for Surface/desktop Windows 8 bug
 * Copyright 2014 Twitter, Inc.
 * Licensed under the Creative Commons Attribution 3.0 Unported License. For
 * details, see http://creativecommons.org/licenses/by/3.0/.
 */

// See the Getting Started docs for more information:
// http://getbootstrap.com/getting-started/#support-ie10-width

(function () {

    'use strict';

    if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
        var msViewportStyle = document.createElement('style');
        msViewportStyle.appendChild(
            document.createTextNode('@-ms-viewport{width:auto!important}')
        );
        document.querySelector('head').appendChild(msViewportStyle);
    }



    // SCROLL TO TOP FUNCTION

    jQuery.fn.pegasusScrollToTop = function () {
        jQuery(this).hide().removeAttr('href');
        if ('0' !== jQuery(window).scrollTop()) {
            jQuery(this).fadeIn('slow');
        }

        var scrollDiv = jQuery(this);
        jQuery(window).on( 'scroll', function () {
            if ('0' === jQuery(window).scrollTop()) {
                jQuery(scrollDiv).fadeOut('slow');
            } else {
                jQuery(scrollDiv).fadeIn('slow');
            }

            // Back to Top Button
            var viewportHeight = window.innerHeight;
            var back_to_top = jQuery('#toTop');

            if (window.scrollY > viewportHeight / 3) {
                back_to_top.addClass('scrolled');
            } else {
                back_to_top.removeClass('scrolled');
            }

        });

        jQuery(this).on('click', function () {
            jQuery('html, body').animate({ scrollTop: 0 }, 'slow');
        });

    };



    // Page Loader

    jQuery('.page-loader').delay(500).fadeOut(500);

    jQuery('#toTop').pegasusScrollToTop();

    // Uncomment the following blocks as needed for admin bar checks, fixed header, etc.

    /*
    function check_admin_height(adminbarheight) {
        if (jQuery("body").hasClass("admin-bar")) {
            adminbarheight = jQuery("#wpadminbar").height();
        } else {
            adminbarheight = 0;
        }

        return adminbarheight;
    }



    function update_body_height(adminbarheight) {
        adminbarheight = check_admin_height();
        adminbarheight = adminbarheight + 'px';
        if (adminbarheight != '0px') {
            jQuery("body").css("margin-top", adminbarheight);
        }

    }

    */



    /*

    function check_header_height(fixedheaderheight) {
        fixedheaderheight = jQuery(".header-container").height();
        return fixedheaderheight;
    }



    function update_page_wrap_height(calculatedheight, cssoutput) {
        if (jQuery("body").hasClass("navbar-fixed-top-is-active")) {
            calculatedheight = check_header_height() + check_admin_height();
            cssoutput = calculatedheight + 'px';
            jQuery("#page-wrap").css("margin-top", cssoutput);
        } else {
            calculatedheight = check_header_height();
            cssoutput = calculatedheight + 'px';
            jQuery("#page-wrap").css("margin-top", cssoutput);
        }

    }

    */



    /*

    function update_fixed_header_top_value() {
        var test = check_admin_height();
        jQuery(".navbar-fixed-top").css("top", test);
    }

    */



    /*

    function calc_header_height_init() {
        var adminbarheight;
        var fixedheaderheight;
        var calculatedheight;
        var cssoutput;
        if (jQuery("body").hasClass("admin-bar")) {
            console.log("Admin Bar: " + "yes");
        } else {
            console.log("Admin Bar: " + "no");
        }

        if (jQuery("body").hasClass("navbar-fixed-top-is-active")) {
            console.log("Fixed Header checkbox: " + "yes");
        } else {
            console.log("Fixed Header checkbox: " + "no");
        }

        if (adminbarheight == null) {
            console.log("Admin Bar height: " + adminbarheight);
        }

    }

    calc_header_height_init();
    */



    /*

    jQuery(window).load(function () {
        check_admin_height();
        update_fixed_header_top_value();
        update_body_height();
        if (jQuery("body").hasClass("navbar-fixed-top-is-active")) {
            update_page_wrap_height();
        }

    });



    jQuery(window).on('resize', function () {
        update_fixed_header_top_value();
        if (jQuery("body").hasClass("navbar-fixed-top-is-active")) {
            update_page_wrap_height();
        }
        update_body_height();
    });

    */

})();



// Theme Scripts

jQuery(document).ready(function ($) {
    // Add classes to submenus
    /*
    jQuery("#menu-main-nav ul.sub-menu").each(function (i) {
        jQuery(this).addClass("item-" + (i + 1));
    });

    */

    // var checkFixedClass = $('body').hasClass("navbar-fixed-top-is-active");
    // console.log(checkFixedClass);
    // var headerHeight = parseInt($('#header').outerHeight());
    // if (true === checkFixedClass) {
    //     $('#wrapper').css("margin-top", headerHeight);
    // }



    // Replace social media nav menu with Font Awesome icons

    $('.pegasus-social .fa-facebook a').html('<i class="fa fa-facebook"></i>');
    $('.pegasus-social .fa-twitter a').html('<i class="fa fa-twitter"></i>');
    $('.pegasus-social .fa-instagram a').html('<i class="fa fa-instagram"></i>');
    $('.pegasus-social .fa-google-plus a').html('<i class="fa fa-google-plus"></i>');
    $('.pegasus-social .fa-pinterest a').html('<i class="fa fa-pinterest"></i>');
    $('.pegasus-social .fa-youtube a').html('<i class="fa fa-youtube"></i>');
    $('.pegasus-social .fa-linkedin-square a').html('<i class="fa fa-linkedin-square"></i>');
    $('.pegasus-social .fa-envelope a').html('<i class="fa fa-envelope"></i>');
    $('.pegasus-social .fa-phone a').html('<i class="fa fa-phone"></i>');
    $('.pegasus-social .fa-map-marker a').html('<i class="fa fa-map-marker"></i>');
    $('.pegasus-social .fa-wordpress a').html('<i class="fa fa-wordpress"></i>');

});

const getTopBarHeight = (topBarId, cssVar) => {
  const topBar = document.getElementById(topBarId);

  if (topBar) {
      const topBarHeight = topBar.offsetHeight;
      document.documentElement.style.setProperty(cssVar, `${topBarHeight}px`);
  } else {
      console.log(`Element with id "${topBarId}" not found.`);
  }
}

const getAdminBarHeight = (adminBarId, cssVar) => {
  const adminBar = document.getElementById(adminBarId);

  if (adminBar) {
    const adminBarHeight = adminBar.offsetHeight;
    document.documentElement.style.setProperty(cssVar, `${adminBarHeight}px`);
  } else {
    console.log(`Element with id "${adminBarId}" not found.`);
  }

}

const getHeaderHeight = (headerId, cssVar) => {
  const headers = document.querySelectorAll(headerId);
  //console.log( "header: ", header );
  headers.forEach((header, index) => {
    if (header) {
      const headerHeight = header.offsetHeight;
      document.documentElement.style.setProperty(`${cssVar}`, `${headerHeight}px`);
    } else {
      console.log(`Element matching selector "${selector}" not found.`);
    }
  });

}



document.addEventListener('DOMContentLoaded', function () {
  getTopBarHeight('top-bar', '--pegasus-top-bar-height');
  getAdminBarHeight('wpadminbar', '--pegasus-admin-bar-height');
  getHeaderHeight('#header .header-container', '--pegasus-header-fixed-menu-height');

  // Add event listener for window resize
  window.addEventListener('resize', function () {
    getTopBarHeight('top-bar', '--pegasus-top-bar-height');
    getAdminBarHeight('wpadminbar', '--pegasus-admin-bar-height');
    getHeaderHeight('#header .header-container', '--pegasus-header-fixed-menu-height');
  });

});


//# sourceMappingURL=main.js.map
