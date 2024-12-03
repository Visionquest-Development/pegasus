
const getHeaderFourHeight = (headerId, cssVar) => {
  const headers = document.getElementById(headerId);
  //console.log( "header: ", header );

    if (header) {
      const headerHeight = header.offsetHeight;
      document.documentElement.style.setProperty(`${cssVar}`, `${headerHeight}px`);
    } else {
      console.log(`Element matching selector "${selector}" not found.`);
    }

}


jQuery(document).ready(function($) {

  /*=========================*/
  /* 	CUSTOM HEADER  */
  /*=========================*/
  $('.navbar-toggler').on( 'click', function(e){
    e.preventDefault();
    //$('.collapse.navbar-collapse').addClass('in');
    $('body').addClass('mobile-menu-open');
    //$('.collapse.navbar-collapse').show();
  });
  $('.mobile-menu-close').on( 'click', function(e){
    e.preventDefault();
    $('.collapse.navbar-collapse').removeClass('show');
    //$('.collapse.navbar-collapse').removeClass('in');
    $('body').removeClass('mobile-menu-open');
    //$('.navbar-toggler').trigger('click');
    //$('.collapse.navbar-collapse').hide();
  });
  $( window ).on( 'resize', function() {
    var width = $(window).width();
    if ((width>=768)) {
      $('body').removeClass('mobile-menu-open');
      //$('#header .collapse.navbar-collapse.in').removeAttr('id');
      //$('#header .collapse.navbar-collapse.in').removeClass('in');
    }
  });




    /*====================================
    Fixed Header
    ======================================*/
      var  mn = $(".primary-menu");
      var mns = "main-nav-scrolled";
      var hdr = $('header').height() - 90;

    $(window).on( 'scroll', function() {
      if( $(this).scrollTop() > hdr ) {
        mn.addClass(mns);
        $('#page-wrap').css('padding-top','90px');
      } else {
        mn.removeClass(mns);
        $('#page-wrap').css('padding-top','0px');
      }
    });

}); //end document ready function


document.addEventListener('DOMContentLoaded', function () {
  getHeaderFourHeight('mega-menu', '--pegasus-header-four-menu-height');

  // Add event listener for window resize
  window.addEventListener('resize', function () {
    getHeaderFourHeight('mega-menu', '--pegasus-header-four-menu-height');
  });

});
