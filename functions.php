<?php
	/**
	 * Silence is golden; exit if accessed directly
	 */
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}


	/**
	 * Enqueue RTL stylesheet if needed
	 */
	function pegasus_rtl_support() {
		if ( is_rtl() ) {
			wp_enqueue_style( 'pegasus-rtl', get_template_directory_uri() . '/rtl.css', array(), '1.0.0' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'pegasus_rtl_support' );

	/**
	 * Theme error logging helper function
	 * Only logs errors when WP_DEBUG is enabled
	 */
	function pegasus_log_error( $message, $context = '' ) {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG && defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG ) {
			$log_message = 'Pegasus Theme';
			if ( ! empty( $context ) ) {
				$log_message .= ' [' . $context . ']';
			}
			$log_message .= ': ' . $message;
			error_log( $log_message );
		}
	}

	/**
	 * Plugin requirements (TGMPA) & Bootstrap CMB2
	 */
	$tgm_file = get_template_directory() . '/inc/class-tgm-plugin-activation.php';
	if ( file_exists( $tgm_file ) ) {
		require_once $tgm_file;
	} else {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			error_log( 'Pegasus Theme: TGMPA file not found: ' . $tgm_file );
		}
	}

	/**
	 * Bootstrap CMB2
	 */
	$cmb2_file = get_template_directory() . '/inc/cmb2/init.php';
	if ( file_exists( $cmb2_file ) ) {
		require_once $cmb2_file;
	} else {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			error_log( 'Pegasus Theme: CMB2 file not found: ' . $cmb2_file );
		}
	}

	/**
	 * Load the CMB2 powered theme options page
	 */
	$theme_options_file = get_template_directory() . '/inc/theme-options.php';
	if ( file_exists( $theme_options_file ) ) {
		require_once $theme_options_file;
	} else {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			error_log( 'Pegasus Theme: Theme options file not found: ' . $theme_options_file );
		}
	}

	/**
	 * Load WP_BOOTSTRAP_HOOKS
	 * https://github.com/benignware/wp-bootstrap-hooks
	 */

	//comments - THIS HAS BEEN MODIFIED as of 2018
	// require_once 'inc/wp-bootstrap-hooks-master/bootstrap-comments.php';
	// //content
	// require_once 'inc/wp-bootstrap-hooks-master/bootstrap-content.php';
	// //forms
	// //require_once 'inc/wp-bootstrap-hooks-master/bootstrap-forms.php';
	// //gallery
	// require_once 'inc/wp-bootstrap-hooks-master/bootstrap-gallery.php';

	// //all
	// //require_once 'inc/wp-bootstrap-hooks-master/bootstrap-hooks.php';

	// //menu
	// require_once 'inc/wp-bootstrap-hooks-master/bootstrap-menu.php';
	// //pagination
	// require_once 'inc/wp-bootstrap-hooks-master/bootstrap-pagination.php';
	// //widgets
	// require_once 'inc/wp-bootstrap-hooks-master/bootstrap-widgets.php';

	add_theme_support( 'bootstrap' );

	//require_once 'inc/wp-bootstrap-hooks-master/bootstrap-hooks.php';

	/*=========================================

		TGMPA - wordpress theme plugin requirements

	===========================================*/
	add_action( 'tgmpa_register', 'pegasus_register_required_plugins' );

	function pegasus_register_required_plugins() {
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(

			// BreadcrumbNavXT
			array(
				'name'      => 'Breadcrumb NavXT',
				'slug'      => 'breadcrumb-navxt',
				'required'  => false,
			),

			//CMB2 Colorpicker
			// array(
			// 	'name'      => 'WP-Colorpicker-alpha',
			// 	'slug'      => 'WP_ColorPicker_Alpha',
			// 	'source'    => 'https://github.com/kallookoo/wp-color-picker-alpha/archive/master.zip',
			// 	'required'  => true,
			// 	'force_activation'   => true,
			// ),

			// CMB2 Colorpicker
			// array(
			// 	'name'      => 'CMB2 RGBa Colorpicker',
			// 	'slug'      => 'CMB2_RGBa_Picker-master',
			// 	'source'    => 'https://github.com/JayWood/CMB2_RGBa_Picker/archive/master.zip',
			// 	'required'  => true,
			// 	'force_activation'   => true,
			// ),

			// CMB2 Conditionals
			// array(
			// 	'name'      => 'CMB2 Conditionals',
			// 	'slug'      => 'cmb2-conditionals',
			// 	'source'    => 'https://github.com/jcchavezs/cmb2-conditionals/archive/master.zip',
			// 	'required'  => true,
			// 	'force_activation'   => true,
			// ),

			// WP BOOTSTRAP HOOKS
			array(
				'name'      => 'WP BOOTSTRAP HOOKS',
				'slug'      => 'wp-bootstrap-hooks',
				'source'    => 'https://github.com/benignware/wp-bootstrap-hooks/archive/master.zip',
				'required'  => true,
				'force_activation'   => true,
			),

			// Page Builder from SiteOrgin
			array(
				'name'      => 'Page Builder by SiteOrigin',
				'slug'      => 'siteorigin-panels',
				'required'  => false,
			),

			//Page Builder addditional modules
			array(
				'name'      => 'SiteOrigin Widgets Bundle',
				'slug'      => 'so-widgets-bundle',
				'required'  => false,
			),

			//Page Builder addditional modules
			array(
				'name'      => 'Yoast SEO',
				'slug'      => 'wordpress-seo',
				'required'  => false,
			),

			//Page Builder addditional modules
			array(
				'name'      => 'WooCommerce',
				'slug'      => 'woocommerce',
				'required'  => false,
			),

			// This is an example of how to include a plugin from an arbitrary external source in your theme. THIS WILL BE USED FOR BOOSTER PLUGIN
			/*array(
				'name'         => 'TGM New Media Plugin', // The plugin name.
				'slug'         => 'tgm-new-media-plugin', // The plugin slug (typically the folder name).
				'source'       => 'https://s3.amazonaws.com/tgm/tgm-new-media-plugin.zip', // The plugin source.
				'required'     => true, // If false, the plugin is only 'recommended' instead of required.
				'external_url' => 'https://github.com/thomasgriffin/New-Media-Image-Uploader', // If set, overrides default API URL and points to an external URL.
			),*/


		);


		$config = array(
			'id'           => 'pegasus',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			//'message'      => 'Thanks for using Pegsus Theme! Please refer to http://visionquestdevelopment.com or https://github.com/jimboobrien/pegasus for support',                      // Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );
	}


	if ( ! function_exists( 'pegasus_theme_setup' ) ) :
		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 *
		 * @since 1.0
		 */
		function pegasus_theme_setup() {

			/*
			 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 * Note: Text domain loading moved to init hook via pegasus_load_textdomain()
			 */

			/*
			 * Let WordPress manage the document title.
			 * By adding theme support, we declare that this theme does not use a
			 * hard-coded <title> tag in the document head, and expect WordPress to
			 * provide it for us.
			 */
			add_theme_support( 'title-tag' );
			add_theme_support( 'menus' );
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style'
			) );

			/**
			 * Register our primary menu
			 */
			register_nav_menu( 'primary', __( 'Primary Menu', 'pegasus' ) );
			register_nav_menu( 'social-icons', __( 'Social Icon Menu', 'pegasus' ) );
			register_nav_menu( 'user-menu', __( 'User Account Menu', 'pegasus' ) );

			$mega_menu_widget_choice = absint( pegasus_get_option( 'more_menu_widget_areas' ) );
			$more_menu_widgets       = $mega_menu_widget_choice ? $mega_menu_widget_choice : 1;
			$mega_menus_nav_vs_widgets_select = pegasus_get_option('menus_vs_widgets_select');
			switch ( $more_menu_widgets ) {
				case 1:
					if ( 'widgets' !== $mega_menus_nav_vs_widgets_select ) {
						register_nav_menu( 'mega-menu-1', __( 'Mega Menu Column One', 'pegasus' ) );
					} else {
						register_sidebar( array(
							'name'          => __( 'Mega Menu 1', 'pegasus' ),
							'id' => 'mega_one',
							//'description' => __( 'Displays on the footer right before the copyright.', 'pegasus' ),
							'before_widget' => '<div id="%1$s" class="widget %2$s">',
							'after_widget'  => '</div>',
							'before_title'  => '<h3 class="widgettitle">',
							'after_title'   => '</h3>',
						));
					}
					break;
				case 2:
					if ( 'widgets' !== $mega_menus_nav_vs_widgets_select ) {
						register_nav_menus( array(
							'mega-menu-1' => __( 'Mega Menu Column One', 'pegasus' ),
							'mega-menu-2' => __( 'Mega Menu Column Two', 'pegasus' )
						) );
					} else {
						register_sidebars( $more_menu_widgets, array(
							'name'          => __( 'Mega Menu %d', 'pegasus' ),
							'id'            => 'mega_menu_%d',
							'description'   => __( 'Add widgets here to appear in your sidebar.', 'pegasus' ),
							'before_widget' => '<div id="%1$s" class="widget %2$s">',
							'after_widget'  => '</div>',
							'before_title'  => '<h2 class="widget-title">',
							'after_title'   => '</h2>',
						) );
					}
					break;
				case 3:
					if ( 'widgets' !== $mega_menus_nav_vs_widgets_select ) {
						register_nav_menus( array(
							'mega-menu-1'   => __( 'Mega Menu Column One' ),
							'mega-menu-2'   => __( 'Mega Menu Column Two' ),
							'mega-menu-3' => __( 'Mega Menu Column Three' ),
						) );
					} else {
						register_sidebars( $more_menu_widgets, array(
							'name'          => __( 'Mega Menu %d', 'pegasus' ),
							'id'            => 'mega_menu_%d',
							'description'   => __( 'Add widgets here to appear in your sidebar.', 'pegasus' ),
							'before_widget' => '<div id="%1$s" class="widget %2$s">',
							'after_widget'  => '</div>',
							'before_title'  => '<h2 class="widget-title">',
							'after_title'   => '</h2>',
						) );
					}
					break;
					break;
				case 4:
					if ( 'widgets' !== $mega_menus_nav_vs_widgets_select ) {
						register_nav_menus( array(
							'mega-menu-1'   => __( 'Mega Menu Column One' ),
							'mega-menu-2'   => __( 'Mega Menu Column Two' ),
							'mega-menu-3' => __( 'Mega Menu Column Three' ),
							'mega-menu-4'  => __( 'Mega Menu Column Four' ),
						) );
					} else {
						register_sidebars( $more_menu_widgets, array(
							'name'          => __( 'Mega Menu %d', 'pegasus' ),
							'id'            => 'mega_menu_%d',
							'description'   => __( 'Add widgets here to appear in your sidebar.', 'pegasus' ),
							'before_widget' => '<div id="%1$s" class="widget %2$s">',
							'after_widget'  => '</div>',
							'before_title'  => '<h2 class="widget-title">',
							'after_title'   => '</h2>',
						) );
					}
					break;
				default:
					register_nav_menu( 'mega_one', __( 'Mega Menu Column One', 'pegasus' ) );
			}

			/**
			 * Register sidebar widget area
			 */
			register_sidebar( array(
				'name'          => __( 'Sidebar', 'pegasus-theme' ),
				'id'            => 'sidebar-right',
				'description'   => __( 'Add widgets here to appear in your sidebar.', 'pegasus' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
			/* Right Sidebar */
			$pegasus_left_sidebar_option = ( 'on' === pegasus_get_option( 'both_sidebar_chk' ) ) ? pegasus_get_option( 'both_sidebar_chk' ) : 'off';
			if( 'on' === $pegasus_left_sidebar_option ) {
				register_sidebar( array(
					'name'          => __( 'Sidebar Left', 'pegasus-theme' ),
					'id'            => 'sidebar-left',
					'description'   => __( 'Add widgets here to appear in your sidebar.', 'pegasus' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				) );
			}
			/* Shop Sidebar widget */
			register_sidebar( array(
				'name' => __( 'Shop Sidebar', 'pegasus' ),
				'id' => 'shop-sidebar',
				'description' => __( 'Displays on the shop page where the sidebar should go.', 'pegasus' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widgettitle">',
				'after_title'   => '</h3>',
			));
			/* Shop Cart widget */
			register_sidebar( array(
				'name' => __( 'Cart Widget', 'pegasus' ),
				'id' => 'shop-cart',
				'description' => __( 'Displays on sub menu of cart in header.', 'pegasus' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widgettitle">',
				'after_title'   => '</h3>',
			));
			/* FOOTER SOCIAL widget */
			register_sidebar( array(
				'name' => __( 'Footer Social Widget', 'pegasus' ),
				'id' => 'footer-social',
				'description' => __( 'Displays on the footer right before the copyright.', 'pegasus' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widgettitle">',
				'after_title'   => '</h3>',
			));

			/**
			 * Register however many footer widgets our options say to
			 */
			$footer_widget_option = absint( pegasus_get_option( 'footer_widget_areas' ) );
			$footer_widgets = $footer_widget_option ? $footer_widget_option : 1;
			if ( 1 === $footer_widgets ) {
				register_sidebar( array(
					'name'          => __( 'Footer 1', 'pegasus' ),
					'id' => 'footer-1',
					//'description' => __( 'Displays on the footer right before the copyright.', 'pegasus' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="widgettitle">',
					'after_title'   => '</h3>',
				));
			} elseif ( $footer_widgets > 1 ) {
				register_sidebars( $footer_widgets, array(
					'name'          => __( 'Footer %d', 'pegasus' ),
					'id'            => 'footer',
					'description'   => __( 'Add widgets here to appear in your sidebar.', 'pegasus' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h5 class="widget-title">',
					'after_title'   => '</h5>',
				) );
			}

		}
	endif;
	add_action( 'after_setup_theme', 'pegasus_theme_setup' );

	/**
	 * Load theme textdomain for translations
	 * Moved to init hook to comply with WordPress 6.7.0+ requirements
	 */
	function pegasus_load_textdomain() {
		load_theme_textdomain( 'pegasus', get_template_directory() . '/languages' );
	}
	add_action( 'init', 'pegasus_load_textdomain' );

	/* remove admin bar for all users when logged in */
	//add_filter( 'show_admin_bar', '__return_false' );

	$pegasus_admin_choice = ( 'on' === pegasus_get_option( 'wp_admin_bar_chk' ) ) ? true : false;
	if ( true === $pegasus_admin_choice ) {
		add_filter( 'show_admin_bar', '__return_false' );
	}


	//REMOVE WPADMIN BAR CSS FROM INLIINE CSS
	// add_action('get_header', 'remove_admin_login_header');
	// function remove_admin_login_header() {
	// 	remove_action('wp_head', '_admin_bar_bump_cb');
	// }

	function colorToRgb($color) {
		// Check if the input is a hex code
		if (preg_match('/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/', $color)) {
			// Remove the '#' if present
			$hex = ltrim($color, '#');

			// If the hex code is in shorthand (e.g., #abc), expand it to full length (e.g., #aabbcc)
			if (strlen($hex) === 3) {
				$hex = str_repeat($hex[0], 2) . str_repeat($hex[1], 2) . str_repeat($hex[2], 2);
			}

			// Convert hex to RGB values
			$r = hexdec(substr($hex, 0, 2));
			$g = hexdec(substr($hex, 2, 2));
			$b = hexdec(substr($hex, 4, 2));

			// Return the rgb() string
			return "rgb($r, $g, $b)";
		}

		// Check if the input is an rgba color
		if (preg_match('/rgba\s*\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(0|1|0?\.\d+)\s*\)/', $color, $matches)) {
			$r = $matches[1];
			$g = $matches[2];
			$b = $matches[3];

			// Return the rgb() string
			return "rgb($r, $g, $b)";
		}

		return 'Invalid color format';
	}

	function hexToRgba($color, $alpha = 1.0) {
		// Check if the input is a hex code
		if (preg_match('/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/', $color)) {
			// Remove the '#' if present
			$hex = ltrim($color, '#');

			// If the hex code is in shorthand (e.g., #abc), expand it to full length (e.g., #aabbcc)
			if (strlen($hex) === 3) {
				$hex = str_repeat($hex[0], 2) . str_repeat($hex[1], 2) . str_repeat($hex[2], 2);
			}

			// Convert hex to RGB values
			$r = hexdec(substr($hex, 0, 2));
			$g = hexdec(substr($hex, 2, 2));
			$b = hexdec(substr($hex, 4, 2));

			// Return the rgba() string
			return "rgba($r, $g, $b, $alpha)";
		}

		// Check if the input is an rgba color
		if (preg_match('/rgba\s*\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(0|1|0?\.\d+)\s*\)/', $color, $matches)) {
			$r = $matches[1];
			$g = $matches[2];
			$b = $matches[3];
			$alpha = $matches[4];

			return "rgba($r, $g, $b, $alpha)";
		}

		return 'Invalid color format';
	}

	function hoverColorCalc($color) {
		// Check if the input is a hex code
		if (preg_match('/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/', $color)) {
			// Convert hex to RGB
			$hex = ltrim($color, '#');

			if (strlen($hex) === 3) {
				$hex = str_repeat($hex[0], 2) . str_repeat($hex[1], 2) . str_repeat($hex[2], 2);
			}

			$r = hexdec(substr($hex, 0, 2));
			$g = hexdec(substr($hex, 2, 2));
			$b = hexdec(substr($hex, 4, 2));

			// Return rgba with reduced opacity (initial opacity assumed as 1.0)
			return "rgba($r, $g, $b, 0.8)";
		}

		// Check if the input is an rgba color
		if (preg_match('/rgba\s*\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(0|1|0?\.\d+)\s*\)/', $color, $matches)) {
			$r = $matches[1];
			$g = $matches[2];
			$b = $matches[3];
			$alpha = $matches[4];

			// Reduce opacity by 0.2, ensuring it doesn't go below 0
			$newAlpha = max(0, $alpha - 0.2);

			return "rgba($r, $g, $b, $newAlpha)";
		}

		return 'Invalid color format';
	}

	/**
	 * Enqueue scripts and styles.
	 *
	 * @since 1.0
	 */
	function pegasus_theme_scripts() {

		wp_enqueue_style( 'pegasus', get_stylesheet_uri() );
		/**
		 * Add theme custom CSS from theme options
		 */

		$bg_color = ! empty( pegasus_get_option( 'bg_color' ) ) ? pegasus_get_option( 'bg_color' ) : '#fff';
		$bg_img = ! empty( pegasus_get_option( 'bkg_img' ) ) ? pegasus_get_option( 'bkg_img' ) : '';

		$bg_img_repeat = pegasus_get_option( 'bkg_img_repeat' );
		$bg_img_pos = pegasus_get_option( 'bkg_img_pos' );
		$bg_img_size = pegasus_get_option( 'bkg_img_size' );
		$bg_img_attached = ( 'on' === pegasus_get_option( 'bkg_img_fixed_chk' ) ) ? 'on' : 'off';

		$content_color = ! empty( pegasus_get_option( 'content_color' ) ) ? pegasus_get_option( 'content_color' ) : '#777';

		$boxedOrNot = pegasus_get_option( 'boxed_layout_chk' );

		$top_bar_bkg_color = ! empty( pegasus_get_option( 'top_bar_bkg_color' ) ) ? pegasus_get_option( 'top_bar_bkg_color' ) : '#fff';

		$top_bar_content_color = ! empty( pegasus_get_option( 'top_bar_font_color' ) ) ? pegasus_get_option( 'top_bar_font_color' ) : '#777';



		$header_bkg_color = ! empty( pegasus_get_option( 'header_bkg_color' ) ) ? pegasus_get_option( 'header_bkg_color' ) : 'rgba(0,0,0,0)';
		//$header_bkg_color = hexToRgba($header_bkg_color);

		$mobile_color = ! empty( pegasus_get_option( 'mobile_toggle_color' ) ) ? hexToRgba( pegasus_get_option( 'mobile_toggle_color' ) ) : '#000';
		$mobile_border_color = ! empty( pegasus_get_option( 'mobile_toggle_border_color' ) ) ? pegasus_get_option( 'mobile_toggle_border_color' ) : '#000';

		$nav_bg_color = ! empty( pegasus_get_option( 'nav_bg_color' ) ) ? pegasus_get_option( 'nav_bg_color' ) : 'rgba(0,0,0,0)';
		//$nav_bg_hover_color = ! empty( pegasus_get_option( 'nav_bg_hover_color' ) ) ? pegasus_get_option( 'nav_bg_hover_color' ) : 'rgba(0,0,0,0.0)';

		$nav_item_color = ! empty( pegasus_get_option( 'nav_item_color' ) ) ? pegasus_get_option( 'nav_item_color' ) : '';
		$nav_item_hover_color = ! empty( pegasus_get_option( 'nav_item_hover_color' ) ) ? pegasus_get_option( 'nav_item_hover_color' ) : 'rgba(0,0,0,0.45)';

		$nav_item_bkg_color = ! empty( pegasus_get_option( 'nav_item_bkg_color' ) ) ? pegasus_get_option( 'nav_item_bkg_color' ) : '';
		$nav_item_bkg_hover_color = ! empty( pegasus_get_option( 'nav_item_bkg_hover_color' ) ) ? pegasus_get_option( 'nav_item_bkg_hover_color' ) : '';

		$sub_nav_bg_color = ! empty( pegasus_get_option( 'sub_nav_bg_color' ) ) ? pegasus_get_option( 'sub_nav_bg_color' ) : 'rgba(222,222,222,0.8)';
		$sub_nav_bg_hover_color = ! empty( pegasus_get_option( 'sub_nav_bg_hover_color' ) ) ? pegasus_get_option( 'sub_nav_bg_hover_color' ) : 'rgba(222,222,222,0.6)';

		$sub_nav_item_color = ! empty( pegasus_get_option( 'sub_nav_item_color' ) ) ? pegasus_get_option( 'sub_nav_item_color' ) : '#777';
		$sub_nav_item_hover_color = ! empty( pegasus_get_option( 'sub_nav_item_hover_color' ) ) ? pegasus_get_option( 'sub_nav_item_hover_color' ) : 'rgba(0,0,0,0.45)';

		$hoverBkgOrText =  pegasus_get_option( 'hover_chk_decision' );
		$hover_bg_color = ! empty( pegasus_get_option( 'hover_bg_color' ) ) ? pegasus_get_option( 'hover_bg_color' ) : 'rgba(0,0,0,.7)';


		$current_item_color = ! empty( pegasus_get_option( 'current_item_color' ) ) ? pegasus_get_option( 'current_item_color' ) : 'rgba(0,0,0,.9)';



		$header_three_mobile_color = ! empty( pegasus_get_option( 'header_three_mobile_bg_color' ) ) ? pegasus_get_option( 'header_three_mobile_bg_color' ) : '#fff';

		$header_three_menu_position = ! empty( pegasus_get_option( 'header_three_right_checkbox' ) ) ? pegasus_get_option( 'header_three_right_checkbox' ) : 'left';

		$header_three_scroll_bg_color = ! empty( pegasus_get_option( 'header_three_scroll_bg_color' ) ) ? pegasus_get_option( 'header_three_scroll_bg_color' ) : 'rgba(0,0,0,0.8)';

		$header_three_scroll_item_color = ! empty( pegasus_get_option( 'header_three_scroll_item_color' ) ) ? pegasus_get_option( 'header_three_scroll_item_color' ) : '#fff';



		$additional_header_spacer_color = ! empty( pegasus_get_option( 'global_add_header_bg_color' ) ) ? pegasus_get_option( 'global_add_header_bg_color' ) : '#fff';

		//padding for spacer
		$global_additional_header_spacer_padding = ! empty( pegasus_get_option( 'global_nospacer_padding' ) ) ? pegasus_get_option( 'global_nospacer_padding' ) : '55px 0';
		$post_additional_header_spacer_padding = ! empty( get_post_meta( get_the_ID(), 'pegasus_nospacer_padding', true ) ) ? get_post_meta( get_the_ID(), 'pegasus_nospacer_padding', true ) : '55px 0';
		$additional_header_spacer_padding = ( '55px 0' !== $post_additional_header_spacer_padding ) ? $post_additional_header_spacer_padding : $global_additional_header_spacer_padding;

		//add header img
		$global_additional_bkg_image = pegasus_get_option( 'global_add_header_image' );
		$post_additional_bkg_image = pegasus_image_display( '', get_stylesheet_directory_uri() . '/images/banner.png', true );
		$additional_header_bkg_img = ( '' === $post_additional_bkg_image ) ? $global_additional_bkg_image : $post_additional_bkg_image;

		//add header repeat
		$global_additional_header_bg_img_repeat = pegasus_get_option( 'global_add_header_bkg_img_repeat' );
		$post_additional_header_bg_img_repeat = get_post_meta( get_the_ID(), 'pegasus_add_header_bkg_img_repeat', true );
		$additional_header_bg_img_repeat = ( 'no-repeat' === $post_additional_header_bg_img_repeat ) ? $global_additional_header_bg_img_repeat : $post_additional_header_bg_img_repeat;

		//position
		$global_additional_header_bg_img_pos = pegasus_get_option( 'global_add_header_bkg_img_pos' );
		$post_additional_header_bg_img_pos = ( '' !== get_post_meta( get_the_ID(), 'pegasus_add_header_bkg_img_pos', true ) ) ? get_post_meta( get_the_ID(), 'pegasus_add_header_bkg_img_pos', true ) : 'center-center';
		$additional_header_bg_img_pos = ( 'center-center' === $post_additional_header_bg_img_pos ) ? $global_additional_header_bg_img_pos : $post_additional_header_bg_img_pos;

		//add header size
		$global_additional_header_bg_img_size = pegasus_get_option( 'global_add_header_bkg_img_size' );
		$post_additional_header_bg_img_size = ( '' !== get_post_meta( get_the_ID(), 'pegasus_add_header_bkg_img_size', true ) ) ? get_post_meta( get_the_ID(), 'pegasus_add_header_bkg_img_size', true ) : 'cover';
		$additional_header_bg_img_size = ( 'cover' === $post_additional_header_bg_img_size ) ? $global_additional_header_bg_img_size : $post_additional_header_bg_img_size;

		//add header img attached
		$global_additional_header_bg_img_attached = ( 'on' === pegasus_get_option( 'global_add_header_bkg_img_fixed_chk' ) ) ? 'on' : 'off';
		$post_additional_header_bg_img_attached = get_post_meta( get_the_ID(), 'pegasus_add_header_bkg_img_fixed_chk', true ) ? 'on' : 'off';
		$additional_header_bg_img_attached = ( 'on' === $post_additional_header_bg_img_attached ) ? $post_additional_header_bg_img_attached : $global_additional_header_bg_img_attached;

		//overlay color
		$global_additional_header_overlay_color = pegasus_get_option( 'global_add_header_overlay_color' ) ? pegasus_get_option( 'global_add_header_overlay_color' ) : 'rgba(48, 53, 67, 1)';
		$post_additional_header_overlay_color = get_post_meta( get_the_ID(), 'pegasus_add_header_overlay_color', true ) ? get_post_meta( get_the_ID(), 'pegasus_add_header_overlay_color', true ) : 'rgba(48, 53, 67, 1)';
		//overlay opacity
		$global_additional_header_overlay_opacity = pegasus_get_option( 'global_add_header_overlay_opacity' ) ? pegasus_get_option( 'global_add_header_overlay_opacity' ) : '0.4';
		$post_additional_header_overlay_opacity = get_post_meta( get_the_ID(), 'pegasus_add_header_overlay_opacity', true ) ? get_post_meta( get_the_ID(), 'pegasus_add_header_overlay_opacity', true ) : '0.4';

		$additional_header_overlay_color = colorToRgb( $post_additional_header_overlay_color );
		if ( 'rgba(48, 53, 67, 1)' !== $post_additional_header_overlay_color ) {
			$additional_header_overlay_color = colorToRgb( $post_additional_header_overlay_color );
		} else {
			$additional_header_overlay_color = colorToRgb( $global_additional_header_overlay_color );
		}
		//$additional_header_overlay_color =
		//( '#303543' !== $post_additional_header_overlay_color ) ?
		//hexToRgba( $post_additional_header_overlay_color ) :
		//hexToRgba( $global_additional_header_overlay_color );

		//opacity

		$additional_header_overlay_opacity = $post_additional_header_overlay_opacity;
		if ( '0.4' !== $post_additional_header_overlay_opacity ) {
			$additional_header_overlay_opacity = $post_additional_header_overlay_opacity;
		} else {
			$additional_header_overlay_opacity = $global_additional_header_overlay_opacity;
		}
		//$additional_header_overlay_opacity = ( '0.4' === $post_additional_header_overlay_opacity ) ? $post_additional_header_overlay_opacity : $global_additional_header_overlay_opacity;

		$global_additional_header_overlay_disable = ( "on" === pegasus_get_option( 'global_add_header_overlay_disable_chk' ) ) ? true : false;
		$post_additional_header_overlay_disable = ( "on" === get_post_meta( get_the_ID(), 'pegasus_add_header_disable_overlay_chk', true ) ) ? true : false;

		$additional_header_overlay_disable = ( true === $post_additional_header_overlay_disable ) ? $post_additional_header_overlay_disable : $global_additional_header_overlay_disable;

		//color
		$global_page_header_wysiwyg_color = pegasus_get_option( 'global_page_header_wysiwyg_color' ) ? pegasus_get_option( 'global_page_header_wysiwyg_color' ) : '#fff';
		$post_page_header_wysiwyg_color = get_post_meta( get_the_ID(), 'pegasus_page_header_wysiwyg_color', true ) ? get_post_meta( get_the_ID(), 'pegasus_page_header_wysiwyg_color', true ) : '#fff';
		$page_header_wysiwyg_color = ( '#fff' !== $post_page_header_wysiwyg_color ) ? $post_page_header_wysiwyg_color : $global_page_header_wysiwyg_color;


		//$header_fixed_checkbox =  pegasus_get_option('header_fixed_checkbox');
		//$top_header_checkbox =  pegasus_get_option('top_header_chk');
		//$header_three_disable_fixed_checkbox =  pegasus_get_option('header_three_disable_fixed_checkbox');
		//$header_choice =  pegasus_get_option( 'header_select' );

		$footer_txt_color = ! empty( pegasus_get_option( 'footer_text_color' ) ) ? pegasus_get_option( 'footer_text_color' ) : 'rgba(0,0,0,0.8)';
		$footer_bkg_color = ! empty( pegasus_get_option( 'footer_bkg_color' ) ) ? pegasus_get_option( 'footer_bkg_color' ) : 'rgba(0,0,0,0.02)';
		$bottom_footer_bkg_color = ! empty( pegasus_get_option( 'bottom_footer_bg_color' ) ) ? pegasus_get_option( 'bottom_footer_bg_color' ) : 'rgba(0,0,0,0.04)';

		$custom_css =  ! empty( pegasus_get_option( 'custom_css_textareacode' ) ) ?  pegasus_get_option( 'custom_css_textareacode' ) : 'text';

		ob_start();
		?>

			body {
				<?php /*if( $bg_color ) : ?>
				background-color: <?php echo esc_attr( $bg_color ); ?>;
				<?php endif;*/ ?>

				<?php if( $bg_img ) : ?>
					background-image: url(<?php echo esc_url( $bg_img ); ?>);

					<?php if( $bg_img_repeat ) : ?>
						background-repeat: <?php echo esc_attr( $bg_img_repeat ); ?>;
					<?php endif; ?>

					<?php if( '100-100' === $bg_img_pos ) : ?>
						background-position: 100% 100%;
					<?php elseif ( '50-0' === $bg_img_pos ) : ?>
						background-position: 50% 0;
					<?php else: ?>
						<?php $bg_img_pos = str_replace( '-', ' ', $bg_img_pos ); ?>
						background-position: <?php echo esc_attr( $bg_img_pos ); ?>;
					<?php endif; ?>

					<?php if( '100-100' === $bg_img_size ) : ?>
						background-size: 100% 100%;
					<?php else: ?>
						background-size: <?php echo esc_attr( $bg_img_size ); ?>;
					<?php endif; ?>

					<?php if( 'on' === $bg_img_attached ) : ?>
						background-attachment: fixed;
					<?php endif; ?>
				<?php endif; ?>
			}

			<?php if ( true === $additional_header_overlay_disable ) { ?>
				#large-header::before { display: none !important; }
			<?php } ?>


			:root {
				--pegasus-background-color: <?php echo esc_attr( $bg_color ); ?>;
				--pegasus-body-color: <?php echo esc_attr( $content_color ); ?>;
				--pegasus-top-header-bkg-color: <?php echo esc_attr( $top_bar_bkg_color ); ?>;
				--pegasus-top-header-content-color: <?php echo esc_attr( $top_bar_content_color ); ?>;



				--pegasus-header-bkg-color: <?php echo esc_attr( $header_bkg_color ); ?>;

				--pegasus-navbar-toggler-icon-color: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='<?php echo hexToRgba($mobile_color); ?>' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
				--pegasus-navbar-toggler-border-color: <?php echo esc_attr( $mobile_border_color ); ?>;

				--pegasus-nav-bg-color: <?php echo esc_attr( $nav_bg_color ); ?>;


				--pegasus-nav-item-color: <?php echo esc_attr( $nav_item_color ); ?>;
				--pegasus-nav-item-hover-color: <?php echo esc_attr( $nav_item_hover_color ); ?>;

				--pegasus-nav-item-bkg-color: <?php echo esc_attr( $nav_item_bkg_color ); ?>;
				--pegasus-nav-item-bkg-hover-color: <?php echo esc_attr( $nav_item_bkg_hover_color ); ?>;

				--pegasus-sub-nav-item-color: <?php echo esc_attr( $sub_nav_item_color ); ?>;
				--pegasus-sub-nav-item-hover-color: <?php echo esc_attr( $sub_nav_item_hover_color ); ?>;

				--pegasus-sub-nav-bkg-color: <?php echo esc_attr( $sub_nav_bg_color ); ?>;
				--pegasus-sub-nav-bkg-hover-color: <?php echo esc_attr( $sub_nav_bg_hover_color ); ?>;

				--pegasus-current-item-color: <?php echo esc_attr( $current_item_color ); ?>;


				--pegasus-header-three-mobile-color: <?php echo esc_attr( $header_three_mobile_color ); ?>;
				--pegasus-header-three-scroll-bg-color: <?php echo esc_attr( $header_three_scroll_bg_color ); ?>;
				--pegasus-header-three-scroll-item-color: <?php echo esc_attr( $header_three_scroll_item_color ); ?>;

				--pegasus-additional-header-spacer-color: <?php echo esc_attr( $additional_header_spacer_color ); ?>;
				--pegasus-additional-header-overlay-color: <?php echo esc_attr( $additional_header_overlay_color ); ?>;
				--pegasus-additional-header-overlay-opacity: <?php echo esc_attr( $additional_header_overlay_opacity ); ?>;

				--pegasus-page-header-wysiwyg-color: <?php echo esc_attr( $page_header_wysiwyg_color ); ?>;
				--pegasus-footer-bkg-color: <?php echo esc_attr( $footer_bkg_color ); ?>;
				--pegasus-footer-txt-color: <?php echo esc_attr( $footer_txt_color ); ?>;
				--pegasus-bottom-footer-bkg-color: <?php echo esc_attr( $bottom_footer_bkg_color ); ?>;
			}

			<?php
				/* ==================
					boxed layout
				===================*/

				if($boxedOrNot === 'on') {
			?>
				#wrapper {
					-webkit-box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
					-moz-box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
					box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
					background: white;
				}



				@media only screen and ( min-width: 981px ) {
					#wrapper { max-width: 1200px; margin: 0 auto; }
				}

				@media only screen and ( max-width: 1200px ) {
					#wrapper { margin: 0 20px; }
				}

			<?php
				}
			?>



			<?php /*===== additional header stuff =====*/ ?>
			.noheader-spacer {
				background: <?php echo esc_attr( $additional_header_spacer_color ); ?>;
				padding: <?php echo esc_attr( $additional_header_spacer_padding ); ?>;
			}
			.parallax-image {
				background-image: url(<?php echo esc_url( $additional_header_bkg_img ); ?>);

				<?php if( $additional_header_bg_img_repeat ) : ?>
					background-repeat: <?php echo esc_attr( $additional_header_bg_img_repeat ); ?>;
				<?php else: ?>
					background-repeat: no-repeat;
				<?php endif; ?>


				<?php if( 'center-center' === $additional_header_bg_img_pos ) : ?>
					background-position: center center;
				<?php else: ?>
					background-position: center center; <?php //echo $additional_header_bg_img_pos; ?>
				<?php endif; ?>

				<?php if( '100-100' === $additional_header_bg_img_size ) : ?>
					background-size: 100% 100%;
				<?php else: ?>
					background-size: cover; <?php //echo $additional_header_bg_img_size; ?>
				<?php endif; ?>

				<?php if( 'on' === $additional_header_bg_img_attached ) : ?>
					background-attachment: fixed;
				<?php endif; ?>

			}

			<?php //echo $custom_css; ?>

			<?php
			if ( '' === $custom_css || null === $custom_css ) {
				echo '';
			} else {
				echo wp_strip_all_tags( $custom_css );
			}
			?>

		<?php
		wp_add_inline_style( 'pegasus', ob_get_clean() );
	}
	add_action( 'wp_enqueue_scripts', 'pegasus_theme_scripts' );


	/*
	add_action( 'shutdown', 'print_them_globals' );

	function print_them_globals() {

		ksort( $GLOBALS );
		echo '<ol>';
		echo '<li>'. implode( '</li><li>', array_keys( $GLOBALS ) ) . '</li>';
		echo '</ol>';
	}
	*/



	function pegasus_admin_scripts($hook) {
		wp_enqueue_style('admin-styles', get_template_directory_uri().'/admin/admin.css', array(), '1.0.0');
		wp_enqueue_script( 'admin-js', get_template_directory_uri() . '/admin/admin.js', array( 'jquery', 'inline-edit-post' ), '1.0.0', true );
		wp_enqueue_script( 'cookie-js', get_template_directory_uri() . '/admin/cookie.js', array( 'jquery' ), '1.0.0', true );

		//wp_enqueue_script('cmb2-conditionals-for-admin', plugins_url('/cmb2-conditionals.js', '/cmb2-conditionals/cmb2-conditionals.js'), array('jquery'), '', true);

		//wp_enqueue_style('pegasus-styles', get_template_directory_uri() . 'style.css');
		// if ( $hook !== 'pegasus-plugins-slug' ) {
		// 	return;
		// }

		wp_enqueue_script('clipboard-js', get_template_directory_uri() . '/inc/js/clipboard/clipboard.min.js', [], '2.0.11', true);

		// wp_enqueue_style( 'wp-color-picker' );
		// $url_to_script = get_template_directory_uri() . '/admin/wp-color-picker-alpha.min.js';
		// wp_register_script( 'wp-color-picker-alpha', $url_to_script, array( 'wp-color-picker' ), '', true );

		// wp_add_inline_script(
		// 	'wp-color-picker-alpha',
		// 	'jQuery( function() { jQuery( ".color-picker" ).wpColorPicker(); } );'
		// );

		//wp_enqueue_script( 'wp-color-picker-alpha' );

		/*
		if ( is_admin() ) {
			add_action( 'wp_default_scripts', 'wpmm_custom_scripts' );

			function wpmm_custom_scripts( $scripts ) {
				$scripts->add( 'wp-color-picker', "/wp-admin/js/color-picker-suffix.js", array( 'iris' ), false, 1 );

				if ( did_action( 'init' ) ) {
					$scripts->localize( 'wp-color-picker', 'wpColorPickerL10n', array(
						'clear'            => __( 'Clear' ),
						'clearAriaLabel'   => __( 'Clear color' ),
						'defaultString'    => __( 'Default' ),
						'defaultAriaLabel' => __( 'Select default color' ),
						'pick'             => __( 'Select Color' ),
						'defaultLabel'     => __( 'Color value' ),
					));
				}
			}
		} //end if
		*/

	}
	add_action('admin_enqueue_scripts', 'pegasus_admin_scripts');


	/**
	* Proper way to enqueue JS and IE fixes as of Mar 2015
	* Performance optimizations: all scripts include version numbers for proper caching
	*/
	function pegasus_scripts() {

		//wp_enqueue_style( 'animate-css', get_template_directory_uri() . '/inc/css/animate.min.css' );
		wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/dist/css/main.css', array(), '1.0.0', 'all' );
		//wp_enqueue_script( 'popper_js', get_template_directory_uri() . '/inc/bootstrap/js/popper.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/inc/bootstrap/js/5.3.3/bootstrap.bundle.min.js', array('jquery'), '5.3.3', true );
		wp_enqueue_style( 'pegasus_font_awesome', get_template_directory_uri() . '/inc/css/font-awesome.min.css', array(), '4.7.0', 'all' );
		//wp_enqueue_script( 'modernizer_js', get_template_directory_uri() . '/inc/modernizer/modernizer.custom.js', array('jquery'), '', true );

		//wp_enqueue_style( 'pegasus-style', get_template_directory_uri() . '/style.css' );


		/* get this ready to actually be added */

		wp_enqueue_script( 'pegasus_custom_js', get_template_directory_uri() . '/dist/js/main.js', array(), '1.0.0', true );

		$header_choice = pegasus_get_option( 'header_select' );
		$moremenuchk = pegasus_get_option( 'header_more_chk' );

		$post_additional_header_choice = get_post_meta( get_the_ID(), 'pegasus_page_header_select', true );
		$global_additional_header_choice = pegasus_get_option( 'global_additional_header_option' );

		$post_additional_header_disable_parallax = get_post_meta( get_the_ID(), 'pegasus_add_header_disable_parralax_chk', true ) ? 'on' : 'off';
		$global_additional_header_disable_parallax = pegasus_get_option( 'global_add_header_disable_parralax_chk' ) ? 'on' : 'off';

		if( 'sml-header' === $post_additional_header_choice || 'sml-header' === $global_additional_header_choice ) {
			if ( 'on' === $post_additional_header_disable_parallax || 'on' === $global_additional_header_disable_parallax ) {

			} else {
				wp_enqueue_script( 'parallax_js', get_template_directory_uri() . '/js/parallax.js', array(), '1.0.0', true );
			}
		}
		if( 'lrg-header' === $post_additional_header_choice || 'lrg-header' === $global_additional_header_choice  ) {
			wp_enqueue_script( 'animheader_custom_js', get_template_directory_uri() . '/js/animheader.js', array(), '1.0.0', true );
		}

		switch ($header_choice) {
			case "header-one":
			case "header-two":
				if( 'on' === $moremenuchk ) {
					wp_enqueue_style( 'megafish', get_template_directory_uri() . '/inc/css/megafish.css', array(), '1.0.0', 'all' );
					wp_enqueue_script('superfish_js', get_template_directory_uri() .'/inc/js/superfish.js', array('jquery'), '1.0.0', true);
					wp_enqueue_script('hover_intent_js', get_template_directory_uri() .'/inc/js/hoverIntent.js', array('jquery'), '1.0.0', true);
				}

				break;
			case "header-three":
				wp_enqueue_script( 'header_three_js', get_template_directory_uri() . '/js/header_three.js', array(), '1.0.0', true );
				wp_enqueue_style( 'header_three_style', get_template_directory_uri() . '/css/header_three.css', array(), '1.0.0', 'all' );

				break;
			case "header-four":
				wp_enqueue_script( 'header_four_js', get_template_directory_uri() . '/js/header_four.js', array(), '1.0.0', true );
				wp_enqueue_style( 'header_four_style', get_template_directory_uri() . '/css/header_four.css', array(), '1.0.0', 'all' );

				break;
			case "header-five":
				wp_enqueue_script( 'header_five_js', get_template_directory_uri() . '/js/header_five.js', array(), '1.0.0', true );
				wp_enqueue_style( 'header_five_style', get_template_directory_uri() . '/css/header_five.css', array(), '1.0.0', 'all' );
				wp_enqueue_script( 'cookie_js', get_template_directory_uri() . '/admin/cookie.js', array('jquery'), '1.0.0', true );


				break;
			default:

		}

		// Conditionally load mobile submenu always visible CSS
		$mobile_submenu_always_visible = pegasus_get_option( 'mobile_submenu_always_visible' );
		if ( 'on' === $mobile_submenu_always_visible ) {
			wp_enqueue_style( 'pegasus-mobile-submenu-always-visible', get_template_directory_uri() . '/css/mobile-submenu-always-visible.css', array(), '1.0.0', 'all' );
		}

	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_scripts' );

	/*=======================
	 ADD BODY CLASSES
	 ========================*/
	 /* ===== FIXED HEADER CHOICE =====*/
	$fixed_header_choice = pegasus_get_option( 'header_fixed_checkbox' );
	if( 'on' === $fixed_header_choice ) {
		add_filter( 'body_class', function( $classes ) {
		    return array_merge( $classes, array( 'navbar-fixed-top-is-active' ) );
		} );
	} //end fixed chk

	/* ===== HEADER CHOICE ===== */
	add_filter( 'body_class', function( $classes ) {
		$header_choice = pegasus_get_option('header_select');
		return array_merge( $classes, array( $header_choice ) );
	} );

	/*  ===== ADDITIONAL HEADER CHOICE ===== */
	add_filter( 'body_class', function( $classes ) {
		$global_additional_header_choice = pegasus_get_option( 'global_additional_header_option' );
		$post_additional_header_choice =
			get_post_meta( get_the_ID(), 'pegasus_page_header_select', true ) ?
			get_post_meta( get_the_ID(), 'pegasus_page_header_select', true ) :
			'no-header';

		$additional_header_choice = $global_additional_header_choice;

		if ( 'no-header' !== $post_additional_header_choice ) {
			$additional_header_choice = $post_additional_header_choice;
		}
		return array_merge( $classes, array( $additional_header_choice ) );
	} );

	/*  ===== TOP HEADER CHOICE ===== */
	add_filter( 'body_class', function( $classes ) {
		$top_header_choice = ( 'on' === pegasus_get_option( 'top_header_chk' ) ) ? pegasus_get_option( 'top_header_chk' ) : 'top-header-off';
		if ( 'on' === $top_header_choice) {
			$top_header_choice = 'top-header-is-active';
		}
		return array_merge( $classes, array( $top_header_choice ) );
	} );


	/*add_action('wp_enqueue_scripts', 'fixed_header_js_in_footer');
	function fixed_header_js_in_footer() {
		add_action( 'print_footer_scripts', 'fixed_header_js' );
	}

	//* Add JavaScript before </body>
	function fixed_header_js() { ?>
		<script type="text/javascript">



		</script>
	<?php } */


	$moremenuchk =  pegasus_get_option( 'header_more_chk' );
	if($moremenuchk === 'on') {

		$header_choice =  pegasus_get_option( 'header_select' );
		if( $header_choice === 'header-three' || $header_choice === 'header-four' ){
			add_filter('wp_nav_menu_items','add_header_three_link_to_menu', 10, 2);
			function add_header_three_link_to_menu( $items, $args ) {
				if( $args->theme_location == 'primary' ) {
					//return $items."<li class=' '><a class='btn btn-default btn-outline btn-circle collapsed'  data-toggle='collapse' href='#nav-collapse1' aria-expanded='false' aria-controls='nav-collapse1'>Categories</a></li>";
					$items .= "<li class='the-more-link'><a class=' collapsed'  data-toggle='collapse' href='#nav-collapse1' aria-expanded='false' aria-controls='nav-collapse1'>More</a></li>";
				}
				return $items;
			}
		}
	}

	/*=======================
	 SHOW THE EXCERPT
	 ========================*/
	function my_custom_init() {
		add_post_type_support( 'page', 'excerpt' );
	}
	add_action('init', 'my_custom_init');

	function mytheme_enqueue_comment_reply() {
		// on single blog post pages with comments open and threaded comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			// enqueue the javascript that performs in-link comment reply fanciness
			wp_enqueue_script( 'comment-reply' );
		}
	}
	// Hook into wp_enqueue_scripts
	add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_comment_reply' );

	/* PAGINATION */
	if ( ! function_exists( 'my_pagination' ) ) :
		function my_pagination() {
			global $wp_query;
			$big = 999999999; // need an unlikely integer
			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages
			) );
		}
	endif;





	/*
	 * Display Image from the_post_thumbnail or the first image of a post else display a default Image
	 * Chose the size from "thumbnail", "medium", "large", "full" or your own defined size using filters.
	 * USAGE: <?php echo pegasus_image_display(); ?>
	 */

	function pegasus_image_display( $size = 'full', $override_default_image = '', $skip_default = false ) {
		$base_default_image = get_template_directory_uri() . '/images/not-available.jpg';
		$default_image = ( '' !== $override_default_image ) ? $override_default_image : $base_default_image;

		// Try to get post thumbnail first
		if ( has_post_thumbnail() ) {
			$image_id = get_post_thumbnail_id();
			if ( $image_id ) {
				$image_data = wp_get_attachment_image_src( $image_id, $size );
				// Validate that we got valid image data
				if ( $image_data && is_array( $image_data ) && isset( $image_data[0] ) && ! empty( $image_data[0] ) ) {
					return $image_data[0];
				}
			}
		}

		// Fallback: Try to get first image from post content
		global $post;
		if ( $post && ! empty( $post->post_content ) ) {
			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
			if ( $output && isset( $matches[1] ) && isset( $matches[1][0] ) && ! empty( $matches[1][0] ) ) {
				// Validate that the found image URL is not empty
				$found_image = trim( $matches[1][0] );
				if ( ! empty( $found_image ) ) {
					return $found_image;
				}
			}
		}

		// Return default image or empty string based on skip_default flag
		if ( true === $skip_default ) {
			return '';
		}

		return $default_image;
	}


	function pegasus_get_menu( $name, $menu_classes, $depth, $fallback_menu ) {
		// Validate input parameters
		if ( empty( $name ) || ! is_string( $name ) ) {
			return ! empty( $fallback_menu ) ? $fallback_menu : '<ul class="navbar-nav"><li class="nav-item"><span class="nav-link">Menu not configured</span></li></ul>';
		}

		$check_for_theme_location = '';

		// Check if the theme location exists
		if ( ! has_nav_menu( $name ) ) {
			return ! empty( $fallback_menu ) ? $fallback_menu : '<ul class="navbar-nav"><li class="nav-item"><span class="nav-link">Menu location "' . esc_html( $name ) . '" not assigned</span></li></ul>';
		}

		try {
			$check_for_theme_location = wp_nav_menu(
				array(
					'theme_location' => $name,
					'menu_class'	=> $menu_classes,
					'container'		=> false,
					'echo' => false,
					'depth'				=> $depth,
					'fallback_cb'		=> '__return_false', // Return false if no menu found
				)
			);
		} catch ( Exception $e ) {
			if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
				error_log( 'Pegasus Theme: Error rendering menu ' . $name . ': ' . $e->getMessage() );
			}
			return ! empty( $fallback_menu ) ? $fallback_menu : '<ul class="navbar-nav"><li class="nav-item"><span class="nav-link">Menu error</span></li></ul>';
		}

		// Validate the menu output
		if ( empty( $check_for_theme_location ) || '</ul>' === $check_for_theme_location ) {
			return ! empty( $fallback_menu ) ? $fallback_menu : '<ul class="navbar-nav"><li class="nav-item"><span class="nav-link">Menu empty</span></li></ul>';
		}

		return $check_for_theme_location;
	}




	/* ========================================================================
	=========== WOOCOMMERCE INTEGRATION WITH HOOKS AND FUNCTIONS ===========
	=========================================================================*/

	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	/* hook in your own functions to display the wrappers your theme requires */
	add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);
	function my_theme_wrapper_start() {
	  echo '<section id="main">';
	}
	function my_theme_wrapper_end() {
	  echo '</section>';
	}
	/* Make sure that the markup matches that of your theme. If you?re unsure of which classes or IDs to use, take a look at your theme?s page.php for a guide */

	/* Declare WooCommerce support */
	add_action( 'after_setup_theme', 'woocommerce_support' );
	function woocommerce_support() {
		add_theme_support( 'woocommerce' );
	}

	if ( class_exists( 'WooCommerce' ) ) {
		$woo_check =  pegasus_get_option( 'woo_chk' );
		if ( $woo_check === 'on' ) {
			// code that requires WooCommerce
			// this should only ever fire on non-cached pages (so it SHOULD fire
			// whenever we add to cart / update cart / etc

			// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
			add_filter( 'woocommerce_add_to_cart_fragments', 'pegasus_woocommerce_header_add_to_cart_fragment' );
			function pegasus_woocommerce_header_add_to_cart_fragment( $fragments ) {
				// Check if WooCommerce cart is available
				if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
					return $fragments;
				}

				try {
					$cart_count = WC()->cart->get_cart_contents_count();
					$cart_url = wc_get_cart_url();

					ob_start();
					?>
					<a class="cart-contents" href="<?php echo esc_url( $cart_url ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'pegasus' ); ?>">
						<?php echo sprintf( _n( '%d item', '%d items', $cart_count, 'pegasus' ), $cart_count ); ?>
					</a>
					<?php
				} catch ( Exception $e ) {
					pegasus_log_error( 'WooCommerce cart fragment error: ' . $e->getMessage(), 'WooCommerce' );
					ob_start();
					?>
					<a class="cart-contents" href="#" title="<?php esc_attr_e( 'Cart unavailable', 'pegasus' ); ?>">
						<?php esc_html_e( 'Cart', 'pegasus' ); ?>
					</a>
					<?php
				}

				$fragments['a.cart-contents'] = ob_get_clean();

				return $fragments;
			}
		}
	}
	/*=============== END WOOCOMMERCE =================*/


	include_once( 'theme/page_options.php' );

	include_once( 'theme/cpt.php' );

	include_once( 'theme/bootstrap_config.php' );

	include_once( 'theme/pegasus_plugins_suite_admin_menu.php' );

	function pegasus_settings_table($atts) {

		$atts = shortcode_atts(
			array(
				'plugin_slug' => '', // Default to an empty string
				'shortcode_name' => ''
			),
			$atts,
			'pegasus_settings_table'
		);

		// Get the plugin slug from the shortcode attributes
		$plugin_slug = $atts['plugin_slug'];

		// Check if the plugin slug is in the allowed array
		$allowed_plugins = array(
			'pegasus-blog',
			'pegasus-callout',
			'pegasus-carousel',
			'pegasus-countup',
			'pegasus-circle-progress',
			'pegasus-masonry',
			'pegasus-navmenu',
			'pegasus-onepage',
			'pegasus-packery',
			'pegasus-popup',
			'pegasus-posts-filter',
			'pegasus-post-grid',
			'pegasus-slider',
			'pegasus-tabs',
			'pegasus-toggleslide',
			'pegasus-wow'
		);

		if (!in_array($plugin_slug, $allowed_plugins)) {
			return '<p style="color: red;">Error: Invalid plugin slug provided.</p>';
		}

		// Load the settings.json file from the specified plugin
		$file_path = plugins_url() . '/'. $plugin_slug . '/settings.json';
		// echo '<pre>';
		// var_dump( $file_path ); //plugins_url
		// echo '</pre>';
		// if (!file_exists($file_path)) {
		// 	return '<p style="color: red;">Error: settings.json file not found for the specified plugin.</p>';
		// }

		$data = json_decode(file_get_contents($file_path), true);

		if (json_last_error() !== JSON_ERROR_NONE) {
			return '<p style="color: red;">Error: Invalid JSON provided.</p>';
		}

		// Start building the HTML
		$html = '<table border="0" cellpadding="1" class="table responsive pegasus-table" align="left">
		<thead>
		<tr>
		<td><span><strong>Name</strong></span></td>
		<td><span><strong>Attribute</strong></span></td>
		<td><span><strong>Options</strong></span></td>
		<td><span><strong>Description</strong></span></td>
		<td><span><strong>Example</strong></span></td>
		</tr>
		</thead>
		<tbody>';

		if ( $atts['shortcode_name'] ) {
			// $html .= '<tr >';
			// 	$html .= '<td colspan="5">';
			// 		$html .= '<span>';
			// 			$html .= '<strong>' . htmlspecialchars($atts['shortcode_name']) . '</strong>';
			// 		$html .= '</span>';
			// 	$html .= '</td>';
			// $html .= '</tr>';
			$html .= '<caption><strong>' . htmlspecialchars(str_replace('_', ' ', $atts['shortcode_name'])) . '</strong></caption>';

			foreach ($data['rows'] as $key => $value) {
				// echo '<pre>';
				// var_dump($value);
				// echo '</pre>';
				foreach ($value[$atts['shortcode_name']] as $single) {
					$html .= '<tr>
						<td>' . htmlspecialchars($single['name']) . '</td>
						<td>' . htmlspecialchars($single['attribute']) . '</td>
						<td>' . nl2br(htmlspecialchars($single['options'])) . '</td>
						<td>' . nl2br(htmlspecialchars($single['description'])) . '</td>
						<td><code>' . htmlspecialchars($single['example']) . '</code></td>
					</tr>';
				}
			}

			$html .= '</tbody></table>';
			return $html;
		}


		// Iterate over the data to populate rows
		if (!empty($data['rows'])) {
			foreach ($data['rows'] as $section) {
				if ( "pegasus-carousel" !== $plugin_slug ) {
					// Add section header
					// $html .= '<tr >';
					// 	$html .= '<td colspan="5">';
					// 		$html .= '<span>';
					// 			$html .= '<strong>' . htmlspecialchars($section['section_name']) . '</strong>';
					// 		$html .= '</span>';
					// 	$html .= '</td>';
					// $html .= '</tr>';
					$html .= '<caption><strong>' . htmlspecialchars(str_replace('_', ' ', $section['section_name'])) . '</strong></caption>';

				}

				if ( "pegasus-carousel" === $plugin_slug || "pegasus-slider" === $plugin_slug || "pegasus-post-grid" === $plugin_slug ) {
					// Iterate over each setting group within the section
					foreach ($section as $key => $settings) {
						if ($key !== 'section_name') {
							// Add group header
							$html .= '<tr>';
							$html .= '<td colspan="5">';
							$html .= '<span>';
							$html .= '<strong>' . htmlspecialchars(ucwords(str_replace('_', ' ', $key))) . '</strong>';
							$html .= '</span>';
							$html .= '</td>';
							$html .= '</tr>';

							// Add rows in the group
							foreach ($settings as $row) {
								$html .= '<tr>
									<td>' . htmlspecialchars($row['name']) . '</td>
									<td>' . htmlspecialchars($row['attribute']) . '</td>
									<td>' . nl2br(htmlspecialchars($row['options'])) . '</td>
									<td>' . nl2br(htmlspecialchars($row['description'])) . '</td>
									<td><code>' . htmlspecialchars($row['example']) . '</code></td>
								</tr>';
							}
						}
					} //end foreach
				} else {
					// Add rows in the section
					foreach ($section['rows'] as $row) {
						$html .= '<tr>
							<td >' . htmlspecialchars($row['name']) . '</td>
							<td >' . htmlspecialchars($row['attribute']) . '</td>
							<td >' . nl2br(htmlspecialchars($row['options'])) . '</td>
							<td >' . nl2br(htmlspecialchars($row['description'])) . '</td>
							<td ><code>' . htmlspecialchars($row['example']) . '</code></td>
						</tr>';
					}
				} //end if carousel or slider

			} //end foreach for section in json
		} //end if

		$html .= '</tbody></table>';

		// Return the generated HTML
		return $html;
	}
	add_shortcode('pegasus_settings_table', 'pegasus_settings_table');
