  /*====================================
      Fixed Header
  ======================================*/

  jQuery(window).bind('scroll', function($) {
    var navHeight = jQuery(window).height() - 480;
    var width = jQuery(window).width();

    if (jQuery(window).scrollTop() > navHeight) {
        jQuery('.header-sticky').addClass('on');
        if (width >= 768) {
            jQuery('#top-bar').addClass('hide');
        }
    } else {
        jQuery('.header-sticky').removeClass('on');
        jQuery('#top-bar').removeClass('hide');
    }
  });

  jQuery(document).ready(function($) {
    /*=========================*/
    /*  CUSTOM HEADER          */
    /*=========================*/
    $('.redq .navbar-toggle').click(function(e) {
        e.preventDefault();
        $('body').addClass('mobile-menu-open');
    });

    $('.mobile-menu-close').click(function(e) {
        e.preventDefault();
        $('body').removeClass('mobile-menu-open');
    });

    $(window).resize(function() {
        var width = $(window).width();
        if (width >= 768) {
            $('body').removeClass('mobile-menu-open');
        }
    });

    $('[data-toggle="offcanvas"]').on('click', function() {
        $('.offcanvas-collapse').toggleClass('open');
    });
  });

  /* This makes the header have the on class if you refresh the page when scrolled down */
  jQuery(document).scroll(function($) {
    if (jQuery(window).scrollTop() >= 75) {
        jQuery('#mega-menu').addClass('on');
    }
  });

  document.addEventListener('DOMContentLoaded', function () {
    const megaMenu = document.getElementById('mega-menu');
    const wpAdminBar = document.getElementById('wpadminbar');

    if (megaMenu) {
        const menuHeight = megaMenu.offsetHeight;
        document.documentElement.style.setProperty('--pegasus-header-three-fixed-menu-height', `${menuHeight}px`);
    } else {
        console.error('Element with id "mega-menu" not found.');
    }

    if ( wpAdminBar) {
      const wpAdminBarHeight = wpAdminBar.offsetHeight;
      document.documentElement.style.setProperty('--pegasus-admin-bar-height', `${wpAdminBarHeight}px`);
    } else {
        console.error('Element with id "wpadminbar" not found.');
    }



  });
