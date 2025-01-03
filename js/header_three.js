  /*====================================
      Fixed Header
  ======================================*/

  const getHeaderHeightThree = (headerId, cssVar) => {
    //const header = document.getElementById(headerId);
    const headers = document.querySelectorAll(headerId);
    headers.forEach((header, index) => {
      if (header) {
        const headerHeight = header.offsetHeight;
        document.documentElement.style.setProperty(`${cssVar}`, `${headerHeight}px`);
      } else {
        console.log(`Element matching selector "${selector}" not found.`);
      }
    });
    // if (header) {
    //     const headerHeight = header.offsetHeight;
    //     document.documentElement.style.setProperty(cssVar, `${headerHeight}px`);
    // } else {
    //     console.error(`Element with id "${headerId}" not found.`);
    // }
  }

  // const getAdminBarHeightThree = (adminBarId, cssVar) => {
  //   const adminBar = document.getElementById(adminBarId);

  //   if (adminBar) {
  //       const adminBarHeight = adminBar.offsetHeight;
  //       document.documentElement.style.setProperty(cssVar, `${adminBarHeight}px`);
  //   } else {
  //       console.error(`Element with id "${adminBarId}" not found.`);
  //   }
  // }

  /* ===================================
      ON SCROLL EFFECT
  ====================================*/
  jQuery(window).on('scroll', function($) {
    var navHeight = jQuery(window).height() - 480;
    var width = jQuery(window).width();

    if (jQuery(window).scrollTop() > navHeight) {
        jQuery('.header-sticky').addClass('on');
        if (width >= 768) {
            jQuery('#top-bar').fadeOut(600).addClass('hide');
        }
    } else {
        jQuery('.header-sticky').removeClass('on');
        jQuery('#top-bar').fadeIn(600).removeClass('hide');
        getAdminBarHeight('wpadminbar', '--pegasus-admin-bar-height');
    }
    //getAdminBarHeightThree('wpadminbar', '--pegasus-admin-bar-height');
  });

  /* ===================================
      DOCUMENT READY FN
  ====================================*/

  jQuery(document).ready(function($) {

    // Mobile Menu Toggle
    $('.redq .navbar-toggle').on('click',function(e) {
        e.preventDefault();
        $('body').addClass('mobile-menu-open');
    });

    //mobile menu close
    $('.mobile-menu-close').on('click', function(e) {
        e.preventDefault();
        $('body').removeClass('mobile-menu-open');
    });

    //close mobile menu on window resize
    $(window).on('resize', function() {
        var width = $(window).width();
        if (width >= 768) {
            $('body').removeClass('mobile-menu-open');
        }
    });

    // Offcanvas Menu
    $('[data-toggle="offcanvas"]').on('click', function() {
        $('.offcanvas-collapse').toggleClass('open');
    });
  });


  /* This makes the header have the on class if you refresh the page when scrolled down */
  jQuery(document).trigger( 'scroll', function($) {
    if (jQuery(window).scrollTop() >= 75) {
      //jQuery('#top-bar').addClass('hide');
      jQuery('.header-sticky').addClass('on');
      getHeaderHeightThree('#mega-menu', '--pegasus-header-three-fixed-menu-height');
    }
  });

document.addEventListener('DOMContentLoaded', function() {
  //var test = getHeaderHeightThree('header', '--pegasus-header-three-fixed-menu-height');
  //console.log( "test: ", test );

  getHeaderHeightThree('#mega-menu', '--pegasus-header-three-fixed-menu-height');
  //getAdminBarHeightThree('wpadminbar', '--pegasus-admin-bar-height');

  // Add event listener for window resize
  window.addEventListener('resize', function() {
    getHeaderHeightThree('#mega-menu', '--pegasus-header-three-fixed-menu-height');
    //getAdminBarHeightThree('wpadminbar', '--pegasus-admin-bar-height');
  });

  //getHeaderHeightThree('header', '--pegasus-header-three-fixed-menu-height');
});
