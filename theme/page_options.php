<?php

	/**
	 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
	 *
	 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
	 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
	 *
	 * @category YourThemeOrPlugin
	 * @package  Demo_CMB2
	 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
	 * @link     https://github.com/WebDevStudios/CMB2
	 */
	/**
	 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
	 */
	if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
		require_once dirname( __FILE__ ) . '/cmb2/init.php';
	} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
		require_once dirname( __FILE__ ) . '/CMB2/init.php';
	}

	add_action( 'cmb2_admin_init', 'pegasus_register_metabox' );
	/**
	 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
	 */
	function pegasus_register_metabox() {
		// Start with an underscore to hide fields from custom fields list
		$prefix = 'pegasus';

		$cmb_demo2 = new_cmb2_box( array(
			'id'            => $prefix . 'metabox2',
			'title'         => __( 'Pegasus Page Options', 'pegasus' ),
			'object_types'  => array( 'page', 'post', 'course_unit' ), // Post type
		) );

		$cmb_demo2->add_field( array(
			'name' => __( 'Fullwidth Container Checkbox', 'pegasus' ),
			'desc' => __( 'Check this box to make the page fullwidth, this shuold override the global fullwidth theme option.', 'pegasus' ),
			'id'   => $prefix . '-page-container-checkbox',
			'type' => 'checkbox',
		) );

		$cmb_demo2->add_field( array(
			'name' => __( 'Disable Page Header', 'pegasus' ),
			'desc' => __( 'Check this box to disable the Page Header.', 'pegasus' ),
			'id'   => $prefix . '-page-header-checkbox',
			'type' => 'checkbox',
		) );


		/**
		 * Sample metabox to demonstrate each field type included
		 */
		$cmb_demo = new_cmb2_box( array(
			'id'            => $prefix . 'metabox',
			'title'         => __( 'Additional Header Options', 'pegasus' ),
			'object_types'  => array( 'page',  'course_unit', 'staff', 'reviews', 'post' ), // Post type, might need to add more cpt's to this

		) );

		$cmb_demo->add_field( array(
			'name'             => __( 'Additional Header', 'pegasus' ),
			'desc'             => __( 'This is used if you need additional header spacing. Select Header Type (no hdr, sml hdr, lrg hdr)', 'pegasus' ),
			'id'               => $prefix . '_page_header_select',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => 'no-header',
			'options'          => array(
				'no-header' => __( 'No Header - No Spacing', 'pegasus' ),
				'space' => __( 'No Header - Just Spacing', 'pegasus' ),
				'sml-header'   => __( 'Small Header - With Parallax', 'pegasus' ),
				'lrg-header'     => __( 'Large Header - Full Width and Height', 'pegasus' ),
			),
		) );

		$cmb_demo->add_field( array(
			'name'    => __( 'Overlay color', 'pegasus' ),
			//'desc' => '',
			'id'      => $prefix . '_add_header_overlay_color',
			'type'    => 'colorpicker',
			'default' => '#303543'
		) );
		$cmb_demo->add_field( array(
			'name' => 'Overlay Opacity',
			//'desc' => 'If there is no color on your footer, enable this so that the footer is easily identifiable.',
			'id'   => $prefix . '_add_header_overlay_opacity',
			'type' => 'text',
			'default' => '0.4'
		) );
		$cmb_demo->add_field( array(
			'name' => 'NoSpacer Padding',
			//'desc' => 'If there is no color on your footer, enable this so that the footer is easily identifiable.',
			'id'   => $prefix . '_nospacer_padding',
			'type' => 'text',
			'default' => '25px 0'
		) );

		$cmb_demo->add_field( array(
			'name' => __( 'Disable Parallax', 'pegasus' ),
			'desc' => 'Check this box if you want to disable parallax effect.',
			'id'   => $prefix . '_add_header_disable_parralax_chk',
			'type' => 'checkbox',
		) );

		$cmb_demo->add_field( array(
			'name' => __( 'Disable Overlay', 'pegasus' ),
			'desc' => 'Check this box if you want to disable overlay on small or large header effect.',
			'id'   => $prefix . '_add_header_disable_overlay_chk',
			'type' => 'checkbox',
		) );

		$cmb_demo->add_field( array(
			'name'             => __( 'Image Repeat', 'pegasus' ),
			'desc'             => '<strong>Choose between:
										   1.) No Repeat
										   2.) Repeat
										   3.) Repeat-X
										   3.) Repeat-Y
										   4.) Space
										   5.) Round
										</strong>',
			'id'               => $prefix . '_add_header_bkg_img_repeat',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => 'none',
			'options'          => array(
				'no-repeat' => __( 'No Repeat', 'cmb2' ),
				'repeat' => __( 'Repeat', 'cmb2' ),
				'repeat-x'   => __( 'Repeat X', 'cmb2' ),
				'repeat-y'     => __( 'Repeat Y', 'cmb2' ),
				'space'     => __( 'Space', 'cmb2' ),
				'round'     => __( 'Round', 'cmb2' ),
			),
		) );
		$cmb_demo->add_field( array(
			'name'             => __( 'Image Position', 'pegasus' ),
			'desc'             => '<strong>Choose between:
										   1.) Center Center
										   2.) Top Left
										   3.) Top Center
										   3.) Top Right
										   4.) Bottom Left
										   5.) Bottom Center
											6.) Bottom Right
										</strong>',
			'id'               => $prefix . '_add_header_bkg_img_pos',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => '50-0',
			'options'          => array(
				'50-0' => __( '50% 0', 'cmb2' ),
				'100-100' => __( '100% 100%', 'cmb2' ),
				'center-center' => __( 'Center Center', 'cmb2' ),
				'top-left'   => __( 'Top Left', 'cmb2' ),
				'top-center'     => __( 'Top Center', 'cmb2' ),
				'top-right'     => __( 'Top Right', 'cmb2' ),
				'bottom-left'     => __( 'Bottom Left', 'cmb2' ),
				'bottom-center'     => __( 'Bottom Center', 'cmb2' ),
				'bottom-right'     => __( 'Bottom Right', 'cmb2' ),
			),
		) );
		$cmb_demo->add_field( array(
			'name'             => __( 'Image Size', 'pegasus' ),
			'desc'             => '<strong>Choose between:
									   1.) None
									   2.) Cover
									   3.) 100% 100%
									</strong>',
			'id'               => $prefix . '_add_header_bkg_img_size',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => 'cover',
			'options'          => array(
				'auto' => __( 'None', 'cmb2' ),
				'cover'   => __( 'Cover', 'cmb2' ),
				'100-100'     => __( '100% 100%', 'cmb2' ),
				'contain'   => __( 'Contain', 'cmb2' ),
			),
		) );

		$cmb_demo->add_field( array(
			'name' => __( 'Background Attachment Fixed', 'pegasus' ),
			'desc' => 'Check this box if you want the background image to be fixed / parallax effect.',
			'id'   => $prefix . '_add_header_bkg_img_fixed_chk',
			'type' => 'checkbox',
		) );


		$cmb_demo->add_field( array(
			'name'    => __( 'Header Content wysiwyg', 'cmb2' ),
			'desc'    => __( 'This will show up in the Additional Header select area.', 'cmb2' ),
			'id'      => $prefix . '_page_header_wysiwyg',
			'type'    => 'wysiwyg',
			'options' => array( 'textarea_rows' => 5, ),
		) );

		$cmb_demo->add_field( array(
			'name'    => __( 'Header Content color', 'pegasus' ),
			//'desc' => '',
			'id'      => $prefix . '_page_header_wysiwyg_color',
			'type'    => 'rgba_colorpicker',
			'default' => '#fff'
		) );
	}


?>
