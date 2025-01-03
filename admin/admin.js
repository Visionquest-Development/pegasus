
jQuery(document).ready( function($) {

	var pegasusSettingsForm = jQuery('#cmb2-metabox-pegasus_option_metabox');

	var newHTML = [];

	var classArr = [];

	var optionsContainer;

	var toggleContainer;

	var count = 1;

	$( pegasusSettingsForm ).children().each(function( index ) {

		classArr = $( this ).attr("class").split(' ');
		if ( '1' == jQuery.inArray( "cmb-type-title", classArr ) ) {

			toggleContainer = $('<div class="pegasus-parent-' + count + '">');

			optionsContainer = $('<div class="pegasus-options-toggle-content-' + count + '">');

			$( this ).before( toggleContainer );
			toggleContainer.append( this );
			$( this ).after( optionsContainer );

			$(this).addClass("pegasus-toggle");
			count++;

		}else{
			$( optionsContainer ).append(this);
		}

	});

  jQuery('[class^="pegasus-parent-"]').find('.pegasus-toggle').on("click", function (event) {
    // Find the parent number dynamically
    const parentClass = $(this).closest('[class^="pegasus-parent-"]').attr('class');
    const parentNumber = parentClass.match(/pegasus-parent-(\d+)/)[1];

    // Toggle the corresponding content and button active state
    $(`.pegasus-options-toggle-content-${parentNumber}`).slideToggle();
    $(this).toggleClass('active');
    $('.CodeMirror').each(function(i, el){
      el.CodeMirror.refresh();
    });
    event.preventDefault();
  });



/*
	jQuery('.pegasus-parent-1 .pegasus-toggle').on("click", function(event){
		//first open the container with the social stuff
		$('.pegasus-options-toggle-content-1' ).slideToggle();
		// Then add a class to the button to give it a hover
		$('.pegasus-parent-1 .pegasus-toggle' ).toggleClass('active');
		event.preventDefault();
	});

  ...............
*/


    /*============================
        WOOCOMMERCE CHECKBOX
    =============================*/

	function hideEcommerceFields() {
		jQuery('.cmb2-id-ecommerce-options').hide();
	    jQuery('.cmb2-id-shop-link-chk').hide();
        jQuery('.cmb2-id-nav-social-chk').hide();
        jQuery('.cmb2-id-woo-menu-top-chk').hide();
        jQuery('.cmb2-id-user-menu-chk').hide();
        jQuery('.cmb2-id-cart-menu-chk').hide();
	}

	function showEcommerFields() {
		jQuery('.cmb2-id-ecommerce-options').show();
	    jQuery('.cmb2-id-shop-link-chk').show();
        jQuery('.cmb2-id-nav-social-chk').show();
        jQuery('.cmb2-id-woo-menu-top-chk').show();
        jQuery('.cmb2-id-user-menu-chk').show();
        jQuery('.cmb2-id-cart-menu-chk').show();
	}

	/* FIRST CHECK */
	if (jQuery("#woo_chk").is(":checked")) {
		//show the hidden div
		showEcommerFields();
	} else {
		//otherwise, hide it
		hideEcommerceFields();
	}

	/* SDECOND CHECK */
	// Add onclick handler to checkbox w/id checkme
   	jQuery("#woo_chk").on('click', function(){
		// If checked
		if (jQuery("#woo_chk").is(":checked")) {
			//show the hidden div
			showEcommerFields();
		} else {
			//otherwise, hide it
			hideEcommerceFields();
		}
  	});

    /*=============END===============*/




    /*============================
		TOP BOX CHECKBOX
	=============================*/

	function hideTopBarFields() {
		jQuery('.cmb2-id-top-header-title').hide();
		jQuery('.cmb2-id-top-bar-bkg-color').hide();
	  jQuery('.cmb2-id-top-bar-font-color').hide();
    jQuery('.cmb2-id-toparea-code').hide();
    jQuery('.cmb2-id-top-social-chk').hide();
	}

	function showTopBarFields() {
		jQuery('.cmb2-id-top-header-title').show();
		jQuery('.cmb2-id-top-bar-bkg-color').show();
    jQuery('.cmb2-id-top-bar-font-color').show();
    jQuery('.cmb2-id-toparea-code').show();
    jQuery('.cmb2-id-top-social-chk').show();
	}

	/* FIRST CHECK */
	if (jQuery("#top_header_chk").is(":checked")) {
		//show the hidden div
		showTopBarFields();
	} else {
		//otherwise, hide it
		hideTopBarFields();
	}

	/* SDECOND CHECK */
	// Add onclick handler to checkbox w/id checkme
  jQuery("#top_header_chk").on('click', function(){
		// If checked
		if (jQuery("#top_header_chk").is(":checked")) {
			//show the hidden div
			showTopBarFields();
		} else {
			//otherwise, hide it
			hideTopBarFields();
		}
  });

  	/*=============END===============*/



    /*================================
		HEADER ONE AND TWO CHECKBOX
	=================================*/


    /*if( jQuery('#header_select').val() == 'header-one' || jQuery('#header_select').val() == 'header-two') {
        jQuery('.cmb2-id-header-one-title').show();
        jQuery('.cmb2-id-logo-centered').show();
        jQuery('.cmb2-id-nav-social-chk').show();
        jQuery('.cmb2-id-header-one-fixed-checkbox').show();
    }


    jQuery('#header_select').bind('change', function (e) {
        if( jQuery('#header_select').val() == 'header-one' || jQuery('#header_select').val() == 'header-two' ) {
            jQuery('.cmb2-id-header-one-title').show();
        	jQuery('.cmb2-id-logo-centered').show();
        	jQuery('.cmb2-id-nav-social-chk').show();
        	jQuery('.cmb2-id-header-one-fixed-checkbox').show();
        } else{
           	jQuery('.cmb2-id-header-one-title').hide();
        	jQuery('.cmb2-id-logo-centered').hide();
        	jQuery('.cmb2-id-nav-social-chk').hide();
        	jQuery('.cmb2-id-header-one-fixed-checkbox').hide();
        }
    });*/


/* fixes for save button */
$('#pegasus_option_metabox input[type="submit"]').wrap('<div class="pegasus-save-btn-container"></div>');


$('#pegasus_option_metabox input[type="submit"]').on("click", function () {
    //console.log( "save init" );

    $('.cmb-type-title').each( function ( index, value ) {
        if ( $( this ).hasClass('active') ) {
            jQuery.cookie( 'option_' + index + '_is_active', 'true', { expires: 7, path: '/' });
        } else {
            jQuery.cookie( 'option_' + index + '_is_active', 'false', { expires: 7, path: '/' });
        }

    });

});

$('.cmb-type-title').each( function( index, value ) {
    if ( 'true' === jQuery.cookie( 'option_' + index + '_is_active' ) ) {
        $('.pegasus-parent-' + parseInt( index + 1 ) + ' .pegasus-toggle' ).addClass('active');
        $('.pegasus-options-toggle-content-' + parseInt( index + 1 ) ).show();
    }
});



}); //END DOC READY FUNCT

/*
(function($) {

    // we create a copy of the WP inline edit post function
    var $wp_inline_edit = inlineEditPost.edit;

    // and then we overwrite the function with our own code
    inlineEditPost.edit = function( id ) {

        // "call" the original WP edit function
        // we don't want to leave WordPress hanging
        $wp_inline_edit.apply( this, arguments );

        // now we take care of our business

        // get the post ID
        var $post_id = 0;
        if ( typeof( id ) == 'object' )
            $post_id = parseInt( this.getId( id ) );

        if ( $post_id > 0 ) {

            // define the edit row
            var $edit_row = $( '#edit-' + $post_id );

            // get the release date
            //var $release_date = $( '#release_date-' + $post_id ).text();

            // set the release date
            //$edit_row.find( 'input[name="release_date"]' ).val( $release_date );

            // get the release date
            var $coming_soon = $( '#coming_soon-' + $post_id ).text();

            // set the film rating
            $edit_row.find( 'input[name="header_type"]' );

            // get the film rating
            var $film_rating = $( '#header_type-' + $post_id ).text();

            // set the film rating
            $edit_row.find( 'select[name="header_type"]' ).val( $film_rating );

        }

    };

    $( '#bulk_edit' ).live( 'click', function() {

        // define the bulk edit row
        var $bulk_row = $( '#bulk-edit' );

        // get the selected post ids that are being edited
        var $post_ids = new Array();
        $bulk_row.find( '#bulk-titles' ).children().each( function() {
            $post_ids.push( $( this ).attr( 'id' ).replace( /^(ttle)/i, '' ) );
        });

        // get the custom fields
        //var $release_date = $bulk_row.find( 'input[name="release_date"]' ).val();
        //var $coming_soon = $bulk_row.find( 'input[name="coming_soon"]:checked' ).val();
        var $header_type = $bulk_row.find( 'select[name="header_type"]' ).val();

        // save the data
        $.ajax({
            url: ajaxurl, // this is a variable that WordPress has already defined for us
            type: 'POST',
            async: false,
            cache: false,
            data: {
                action: 'manage_wp_posts_using_bulk_quick_save_bulk_edit', // this is the name of our WP AJAX function that we'll set up next
                post_ids: $post_ids, // and these are the 2 parameters we're passing to our function
                //release_date: $release_date,
                //coming_soon: $coming_soon,
                pegasus_header_three_select: $header_type
            }
        });

    });

})(jQuery);
*/



jQuery(window).on('load', function($) {

  jQuery( 'input[type="button"].wp-picker-clear').prop( 'value', 'Clear' );

});
