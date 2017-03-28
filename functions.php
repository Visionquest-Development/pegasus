<?php
	/**
	 * Silence is golden; exit if accessed directly
	 */
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}
	
	/**
	 * Plugin requirements (TGMPA) & Bootstrap CMB2
	 */
	require_once 'inc/class-tgm-plugin-activation.php';
	
	/**
	 * Bootstrap CMB2
	 */
	require_once 'inc/cmb2/init.php';
	
	/**
	 * Load the CMB2 powered theme options page
	 */
	require_once 'inc/theme-options.php';
	
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
			 * Let WordPress manage the document title.
			 * By adding theme support, we declare that this theme does not use a
			 * hard-coded <title> tag in the document head, and expect WordPress to
			 * provide it for us.
			 */
			add_theme_support( 'title-tag' );
			add_theme_support( 'menus');
			add_theme_support( 'post-thumbnails' );
		
			/**
			 * Register our primary menu
			 */
			register_nav_menu( 'primary', __( 'Primary Menu', 'pegasus-bootstrap' ) );
			register_nav_menu( 'social-icons', __( 'Social Icon Menu', 'pegasus-bootstrap' ) );
			register_nav_menu( 'user-menu', __( 'User Account Menu', 'pegasus-bootstrap' ) );
			$more_menu_widgets = absint(pegasus_theme_get_option( 'more_menu_widget_areas' ));
		    switch($more_menu_widgets) {
		    	case "1":
					register_nav_menu( 'mega-one', __( 'Mega Menu One', 'pegasus-bootstrap' ) );
					break;
				case "2":
					register_nav_menus( array(
						'mega-one' => __( 'Mega Menu One' ),
						'mega-two' => __( 'Mega Menu Two' )
					));
					break;
				case "3":
					register_nav_menus( array(
						'mega-one' => __( 'Mega Menu One' ),
						'mega-two' => __( 'Mega Menu Two' ),
						'mega-three' => __( 'Mega Menu Three' ),
					));
					break;
				case "4":
					register_nav_menus( array(
						'mega-one' => __( 'Mega Menu One' ),
						'mega-two' => __( 'Mega Menu Two' ),
						'mega-three' => __( 'Mega Menu Three' ),
						'mega-four' => __( 'Mega Menu Four' ),
					));
					break;
				default:
					register_nav_menu( 'mega-one', __( 'Mega Menu One', 'pegasus-bootstrap' ) );
		    }
			    
			/**
			 * Register sidebar widget area
			 */
			register_sidebar( array(
				'name'          => __( 'Sidebar', 'pegasus-theme' ),
				'id'            => 'sidebar-1',
				'description'   => __( 'Add widgets here to appear in your sidebar.', 'pegasus-bootstrap' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
			/* Shop Sidebar widget */
			register_sidebar( array(
				'name' => __( 'Shop Sidebar Widget', 'pegasus-bootstrap' ),
				'id' => 'shop-sidebar',
				'description' => __( 'Displays on the shop page where the sidebar should go.', 'pegasus-bootstrap' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widgettitle">',
				'after_title'   => '</h3>',
			));
			/* Shop Cart widget */
			register_sidebar( array(
				'name' => __( 'Cart Widget', 'pegasus-bootstrap' ),
				'id' => 'shop-cart',
				'description' => __( 'Displays on sub menu of cart in header.', 'pegasus-bootstrap' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widgettitle">',
				'after_title'   => '</h3>',
			));
			/* FOOTER SOCIAL widget */
			register_sidebar( array(
				'name' => __( 'Footer Social Widget', 'pegasus-bootstrap' ),
				'id' => 'footer-social',
				'description' => __( 'Displays on the footer right before the copyright.', 'pegasus-bootstrap' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widgettitle">',
				'after_title'   => '</h3>',
			));

			/**
			 * Register however many footer widgets our options say to
			 */
			$footer_widgets = absint( pegasus_theme_get_option( 'footer_widget_areas' ) );
			register_sidebars( $footer_widgets, array(
				'name'          => __( 'Footer %d', 'pegasus-bootstrap' ),
				'id'            => 'footer',
				'description'   => __( 'Add widgets here to appear in your sidebar.', 'pegasus-bootstrap' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
		
		}
	endif;
	add_action( 'after_setup_theme', 'pegasus_theme_setup' );
	
	/*=========================================

		TGMPA - wordpress theme plugin requirements

	===========================================*/
	add_action( 'tgmpa_register', 'pegasus__register_required_plugins' );

	function pegasus__register_required_plugins() {
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(

			// CMB2 Colorpicker
			array(
				'name'      => 'CMB2 RGBa Colorpicker',
				'slug'      => 'CMB2_RGBa_Picker-master',
				'source'    => 'https://github.com/JayWood/CMB2_RGBa_Picker/archive/master.zip',
				'required'  => true,
				'force_activation'   => true,
			),

			// CMB2 Conditionals
			array(
				'name'      => 'CMB2 Conditionals',
				'slug'      => 'cmb2-conditionals',
				'source'    => 'https://github.com/jcchavezs/cmb2-conditionals/archive/master.zip',
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

			// This is an example of how to include a plugin from an arbitrary external source in your theme. THIS WILL BE USED FOR OCTANE BOOSTER
			/*array(
				'name'         => 'TGM New Media Plugin', // The plugin name.
				'slug'         => 'tgm-new-media-plugin', // The plugin slug (typically the folder name).
				'source'       => 'https://s3.amazonaws.com/tgm/tgm-new-media-plugin.zip', // The plugin source.
				'required'     => true, // If false, the plugin is only 'recommended' instead of required.
				'external_url' => 'https://github.com/thomasgriffin/New-Media-Image-Uploader', // If set, overrides default API URL and points to an external URL.
			),*/
			

		);

		
		$config = array(
			'id'           => 'pegasus-bootstrap',                 // Unique ID for hashing notices for multiple instances of TGMPA.
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
	
	/*
	add_action( 'shutdown', 'print_them_globals' );

	function print_them_globals() {

		ksort( $GLOBALS );
		echo '<ol>';
		echo '<li>'. implode( '</li><li>', array_keys( $GLOBALS ) ) . '</li>';
		echo '</ol>';
	}
	*/
	
	
	/* remove admin bar for all users when logged in */
	//add_filter( 'show_admin_bar', '__return_false' );
	/**
	 * Enqueue scripts and styles.
	 *
	 * @since 1.0
	 */
	function pegasus_theme_scripts() {
		global $content_width;
		wp_enqueue_style( 'pegasus', get_stylesheet_uri() );
		/**
		 * Add theme custom CSS from theme options
		 */
		//$site_width = 0 < absint( pegasus_theme_get_option( 'width' ) ) ? absint( pegasus_theme_get_option( 'width' ) ) : 960;
		//$content_width = $content_width;
		//$sidebar_float = pegasus_theme_get_option( 'sidebar_position' );
		//$content_float = 'right' == $sidebar_float ? 'left' : 'right';
		$bg_color_var = pegasus_theme_get_option( 'bg_color' );
		$bg_color = ! empty( $bg_color_var ) ?  $bg_color_var : '#fff';
		
		$content_color_var = pegasus_theme_get_option( 'content_color' );
		$content_color = ! empty(  $content_color_var ) ?  $content_color_var : '#777';
		
		$nav_bg_color_var = pegasus_theme_get_option( 'nav_bg_color' );
		$nav_bg_color = ! empty(  $nav_bg_color_var ) ?  $nav_bg_color_var : 'rgba(0,0,0,0)';
		
		$nav_item_color_var = pegasus_theme_get_option( 'nav_item_color' );
		$nav_item_color = ! empty(  $nav_item_color_var ) ? $nav_item_color_var : '#777';
		
		$sub_nav_bg_color_var = pegasus_theme_get_option( 'sub_nav_bg_color' ); 
		$sub_nav_bg_color = ! empty(  $sub_nav_bg_color_var ) ?  $sub_nav_bg_color_var : '#dedede';
		
		$sub_nav_item_color_var = pegasus_theme_get_option( 'sub_nav_item_color' );
		$sub_nav_item_color = ! empty(  $sub_nav_item_color_var ) ?  $sub_nav_item_color_var : '#777';
		
		$hover_bg_color_var = pegasus_theme_get_option( 'hover_bg_color' );
		$hover_bg_color = ! empty(  $hover_bg_color_var ) ?  $hover_bg_color_var : '#ccc';
		
		$current_item_color_var = pegasus_theme_get_option( 'current_item_color' );
		$current_item_color = ! empty(  $current_item_color_var ) ?  $current_item_color_var : '#337ab7';
		
		$mobile_color_var = pegasus_theme_get_option( 'mobile_toggle_color' );
		$mobile_color = ! empty(  $mobile_color_var ) ?  $mobile_color_var : '#000';
		
		$header_three_color_var = pegasus_theme_get_option( 'header_three_bg_color' );
		$header_three_color = ! empty(  $header_three_color_var ) ?  $header_three_color_var : '#fff';
		
		$header_three_mobile_color_var = pegasus_theme_get_option( 'header_three_mobile_bg_color' );
		$header_three_mobile_color = ! empty(  $header_three_mobile_color_var ) ?  $header_three_mobile_color_var : '#fff';
		
		$header_three_menu_position_var = pegasus_theme_get_option( 'header_three_right_checkbox' );
		$header_three_menu_position = ! empty(  $header_three_menu_position_var ) ?  $header_three_menu_position_var : 'left';
		
		$header_three_scroll_bg_color_var =  pegasus_theme_get_option( 'header_three_scroll_bg_color' );
		$header_three_scroll_bg_color = ! empty(  $header_three_scroll_bg_color_var ) ?  $header_three_scroll_bg_color_var : '#fff';
		
		$header_three_scroll_item_color_var = pegasus_theme_get_option( 'header_three_scroll_item_color' );
		$header_three_scroll_item_color = ! empty(  $header_three_scroll_item_color_var ) ?  $header_three_scroll_item_color_var : '#fff';
		
		$top_bar_bkg_color_var = pegasus_theme_get_option( 'top_bar_bkg_color' );
		$top_bar_bkg_color = ! empty(  $top_bar_bkg_color_var ) ?  $top_bar_bkg_color_var : '#fff';
		
		$top_bar_content_color_var = pegasus_theme_get_option( 'top_bar_font_color' );
		$top_bar_content_color = ! empty(  $top_bar_content_color_var ) ?  $top_bar_content_color_var : '#777';
		
		$header_bkg_color_var = pegasus_theme_get_option( 'header_bkg_color' );
		$header_bkg_color = ! empty(  $header_bkg_color_var ) ?  $header_bkg_color_var : 'rgba(0,0,0,0)';
		
		$header_fixed_checkbox =  pegasus_theme_get_option('header_one_fixed_checkbox');
		$top_header_checkbox =  pegasus_theme_get_option('top_header_chk');
		$header_three_disable_fixed_checkbox =  pegasus_theme_get_option('header_three_disable_fixed_checkbox');
		$header_choice =  pegasus_theme_get_option( 'header_select' );
		
		$footer_bkg_color_var = pegasus_theme_get_option( 'footer_bkg_color' );
		$footer_bkg_color = ! empty(  $footer_bkg_color_var ) ?  $footer_bkg_color_var : 'rgba(0,0,0,0)';
		
		$bottom_footer_bkg_color_var = pegasus_theme_get_option( 'bottom_footer_bg_color' );
		$bottom_footer_bkg_color = ! empty(  $bottom_footer_bkg_color_var ) ?  $bottom_footer_bkg_color_var : 'rgba(0,0,0,0)';
		
		
		$custom_css_var =  pegasus_theme_get_option( 'custom_css_textareacode' );
		$custom_css =  ! empty(  $custom_css_var ) ?  $custom_css_var : 'text';
 	
	
		
		ob_start();
		?>
			
			body {
				background-color: <?php echo $bg_color; ?>;
				color: <?php echo $content_color; ?>;
			}
			
			<?php 
				/* ==================
					boxed layout
				===================*/ 
				$boxedornot =  pegasus_theme_get_option( 'boxed_layout_chk' ); 
				if($boxedornot === 'on') {
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

			<?php } ?>
			
			<?php /*===== Top bar =====*/ ?>
			#top-bar {	background-color: <?php echo $top_bar_bkg_color; ?>; }
			#top-bar a { color: <?php echo $top_bar_content_color; ?>; }
			
			<?php /*===== Header =====*/ ?>
			#header { background: <?php echo $header_bkg_color; ?>; }
			
			<?php /*===== the navs =====*/ ?>
			.the-default-nav, .the-default-second-nav, .the-default-third-nav, .the-default-fourth-nav { background-color: <?php echo $nav_bg_color; ?>; }
			.the-default-fourth-nav { border-bottom: 5px solid <?php echo $mobile_color; ?> !important; }

			<?php 
				/* ==================
					second header
				===================*/ 
				$header_choice =  pegasus_theme_get_option( 'header_select' ); 
				if( $header_choice === 'header-two' ) {
			?>
				@media only screen and (max-width: 1050px) {
					#header {padding: 0 20px; }
				}
			<?php } 

			/*===== 
				Nav Item Color Bkg/Txt color 
			=====*/ ?>
			header .nav ul li a, header .nav > li > a, #menu-social-icons li:before, .the-nav-cart .sub-menu { color: <?php echo $nav_item_color; ?>; }
			.navbar-default .navbar-nav > li > a {  color: <?php echo $nav_item_color; ?>; }
			
			<?php 
				/* ==================
					hover color 
				===================*/ 
				$hoverbkgortext =  pegasus_theme_get_option( 'hover_chk_decision' ); 
				if($hoverbkgortext === 'on') {
			?>
				header .nav > li > a:hover, header .nav > li > a:focus, header .sub-menu a:hover, header .nav ul li a:hover, #top-bar .sub-menu li a:hover { color: <?php echo $hover_bg_color; ?> !important; }
			<?php }else{ ?>
				header .nav > li > a:hover, header .nav > li > a:focus, header .sub-menu a:hover, header .nav ul li a:hover, #top-bar .sub-menu li a:hover { background-color: <?php echo $hover_bg_color; ?> !important; }
			<?php } ?>
			

			<?php /*===== MegaFish =====*/ ?>
			@media only screen and ( min-width: 981px ) {
				.sf-mega, .sub-menu { background: <?php echo $sub_nav_bg_color; ?>; }
				.sub-menu li a { color: <?php echo $sub_nav_item_color; ?> !important; }
				.sf-mega .sub-menu li a { color: <?php echo $nav_item_color; ?> !important; }
			}

			<?php /*===== submenu nav bkg color  =====*/ ?>
			.the-nav-cart .sub-menu { background: <?php echo $sub_nav_bg_color; ?>; }
			
			<?php /*===== current menu item color =====*/ ?>
			.current-menu-item > a, .current-menu-parent > a {  color: <?php echo $current_item_color; ?> !important; }
			
			<?php /*===== MOBILE COLORING =====*/ ?>
			.navbar-toggle .icon-bar, .default-skin .navbar-default .navbar-toggle .icon-bar, .default-skin .nav .open>a,.default-skin .nav .open>a:focus,.default-skin .nav .open>a:hover, #header .navi-btn a i { background: <?php echo $mobile_color; ?>; } 
			.mobile-menu-close .fa-times-circle:before { color: <?php echo $mobile_color; ?>; } 
			.navbar-toggle { border: 1px solid <?php echo $mobile_color; ?> !important; }
			
			
			<?php /*===== additional header stuff =====*/ ?>
			.noheader-spacer { background: <?php echo $header_three_color; ?>; }
			<?php /*===== header three mobile color =====*/ ?>
			#mobile-menu-wrap { background: <?php echo $header_three_mobile_color; ?>; }
			
			<?php /*===== header three and four stuff =====*/ ?>
			.align-right .navbar-nav { text-align: <?php if($header_three_menu_position == "on") { echo 'right'; }else{ echo 'left'; } ?> !important; }
			.default-skin.header.on { background: <?php echo $header_three_scroll_bg_color; ?>; }
			.default-skin.header.on .navbar-default .navbar-nav>.open>a, .default-skin.header.on .navbar-default .navbar-nav>.open>a:hover, .default-skin.header.on .navbar-default .navbar-nav>li>a, .default-skin.header.on li.dropdown.open a span, .navbar-default .navbar-nav>.open>a:focus { color: <?php echo $header_three_scroll_item_color; ?>; }
			
			<?php /*===== footer =====*/ ?>
			footer { background: <?php echo $footer_bkg_color; ?>; }
			#colophon { background: <?php echo $bottom_footer_bkg_color; ?>; }
			
			<?php echo $custom_css; ?>
			
		<?php
		wp_add_inline_style( 'pegasus', ob_get_clean() );
	}
	add_action( 'wp_enqueue_scripts', 'pegasus_theme_scripts' );
	
	//REMOVE WPADMIN BAR CSS FROM INLIINE CSS
	add_action('get_header', 'remove_admin_login_header');
	function remove_admin_login_header() {
		remove_action('wp_head', '_admin_bar_bump_cb');
	}
	
	
	function pegasus_admin_scripts() {
		wp_enqueue_style('admin-styles', get_template_directory_uri().'/admin/admin.css');
		wp_enqueue_script( 'admin-js', get_template_directory_uri() . '/admin/admin.js', array( 'jquery', 'inline-edit-post' ), '', true );
	}
	add_action('admin_enqueue_scripts', 'pegasus_admin_scripts');
	
		
	/**
	* Proper way to enqueue JS and IE fixes as of Mar 2015
	*/
	function pegasus_scripts() {
	
		wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/inc/css/bootstrap.css' );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css' );

		/* get this ready to actually be added */
		wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/inc/js/bootstrap.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'pegasus_custom_js', get_template_directory_uri() . '/js/pegasus-custom.js', array(), '', true );
		
		$header_choice =  pegasus_theme_get_option( 'header_select' );
		switch ($header_choice) {
			case "header-one":
				$page_header_choice = get_post_meta( get_the_ID(), 'pegasus_header_three_select', true );
				if($page_header_choice === 'sml-header') { wp_enqueue_script( 'parallax_js', get_template_directory_uri() . '/js/parallax.js', array(), '', true ); }
				//if($page_header_choice === 'lrg-header') { wp_enqueue_script( 'animheader_custom_js', get_template_directory_uri() . '/js/animheader.js', array(), '', true ); }	
				/* $moremenuchk =  pegasus_theme_get_option( 'header_more_chk' ); 
				if($moremenuchk === 'on') {
					wp_enqueue_style( 'megafish', get_template_directory_uri() . '/css/megafish.css' );	
					wp_enqueue_script('superfish_js', get_template_directory_uri() .'/js/superfish.js', array('jquery'), false, true);
					wp_enqueue_script('hover_intent_js', get_template_directory_uri() .'/js/hoverIntent.js', array('jquery'), false, true);
				} */
				break;
			case "header-two":
				$page_header_choice = get_post_meta( get_the_ID(), 'pegasus_header_three_select', true );
				if($page_header_choice === 'sml-header') { wp_enqueue_script( 'parallax_js', get_template_directory_uri() . '/js/parallax.js', array(), '', true ); }
				//if($page_header_choice === 'lrg-header') { wp_enqueue_script( 'animheader_custom_js', get_template_directory_uri() . '/js/animheader.js', array(), '', true ); }

				break;
			case "header-three":
				
				$page_header_choice = get_post_meta( get_the_ID(), 'pegasus_header_three_select', true );
				if($page_header_choice === 'sml-header') { wp_enqueue_script( 'parallax_js', get_template_directory_uri() . '/js/parallax.js', array(), '', true ); }
				//if($page_header_choice === 'lrg-header') { wp_enqueue_script( 'animheader_custom_js', get_template_directory_uri() . '/js/animheader.js', array(), '', true ); }	
				wp_enqueue_script( 'header_three_js', get_template_directory_uri() . '/js/header-three.js', array(), '', true );
				wp_enqueue_style( 'header_three_style', get_template_directory_uri() . '/css/header-three.css' );	
				
				break;
			case "header-four":
				
				$page_header_choice = get_post_meta( get_the_ID(), 'pegasus_header_three_select', true );
				if($page_header_choice === 'sml-header') { wp_enqueue_script( 'parallax_js', get_template_directory_uri() . '/js/parallax.js', array(), '', true ); }
				//if($page_header_choice === 'lrg-header') { wp_enqueue_script( 'animheader_four_custom_js', get_template_directory_uri() . '/js/animheader-four.js', array(), '', true ); }	
				//wp_enqueue_script( 'header_three_js', get_template_directory_uri() . '/js/header-three.js', array(), '', true );
				wp_enqueue_script( 'header_four_js', get_template_directory_uri() . '/js/header-four.js', array(), '', true );
				wp_enqueue_style( 'header_three_style', get_template_directory_uri() . '/css/header-four.css' );	
				
				break;
			case "header-five":
				
				$page_header_choice = get_post_meta( get_the_ID(), 'pegasus_header_three_select', true );
				if($page_header_choice === 'sml-header') { wp_enqueue_script( 'parallax_js', get_template_directory_uri() . '/js/parallax.js', array(), '', true ); }
				//if($page_header_choice === 'lrg-header') { wp_enqueue_script( 'animheader_custom_js', get_template_directory_uri() . '/js/animheader.js', array(), '', true ); }	
				//wp_enqueue_script( 'header_three_js', get_template_directory_uri() . '/js/header-three.js', array(), '', true );
				wp_enqueue_script( 'header_five_js', get_template_directory_uri() . '/js/header-five.js', array(), '', true );
				wp_enqueue_style( 'header_five_style', get_template_directory_uri() . '/css/header-five.css' );	
				
				break;
			default:
				
		}
		
		
	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_scripts' );
	


	$fixed_header_choice = pegasus_theme_get_option( 'header_one_fixed_checkbox' );
	if($fixed_header_choice == 'on') { 
		add_filter( 'body_class', function( $classes ) {
		    return array_merge( $classes, array( 'navbar-fixed-top-is-active' ) );
		} );
	} //end fixed chk


	/*add_action('wp_enqueue_scripts', 'fixed_header_js_in_footer');
	function fixed_header_js_in_footer() {
		add_action( 'print_footer_scripts', 'fixed_header_js' );
	}
	 
	//* Add JavaScript before </body>
	function fixed_header_js() { ?>
		<script type="text/javascript">
			


		</script>
	<?php } */

	
	$moremenuchk =  pegasus_theme_get_option( 'header_more_chk' ); 
	if($moremenuchk === 'on') {
		
		$header_choice =  pegasus_theme_get_option( 'header_select' );
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
	
	$adminbarchk =  pegasus_theme_get_option( 'wp_admin_bar_chk' ); 
	if($adminbarchk === 'on') {
		/* remove admin bar for all users when logged in */
		add_filter( 'show_admin_bar', '__return_false' );
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
	/* Make sure that the markup matches that of your theme. If you’re unsure of which classes or IDs to use, take a look at your theme’s page.php for a guide */
	
	/* Declare WooCommerce support */
	add_action( 'after_setup_theme', 'woocommerce_support' );
	function woocommerce_support() {
		add_theme_support( 'woocommerce' );
	}
	
	if ( class_exists( 'WooCommerce' ) ) {
		
		//$woo_check =  pegasus_theme_get_option( 'woo_chk' );
		//if ( $woo_check === 'on' ) {
			// code that requires WooCommerce
			// this should only ever fire on non-cached pages (so it SHOULD fire
			// whenever we add to cart / update cart / etc
			/*function pegasus_update_cart_total_cookie()
			{
				global $woocommerce;		
				$cart_total = $woocommerce->cart->cart_contents_count;
				setcookie('woocommerce_cart_total', $cart_total, 0, '/');
			}
			add_action('init', 'pegasus_update_cart_total_cookie'); */
			add_filter('add_to_cart_fragments', 'pegasus_woocommerce_header_add_to_cart_fragment');
			function pegasus_woocommerce_header_add_to_cart_fragment( $fragments ) {
				global $woocommerce;
				
				ob_start();
				?>
				<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" ><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></a>
				<?php
				$fragments['a.cart-contents'] = ob_get_clean();
				return $fragments;		
				
			}
		//}
	} else {
		// you don't appear to have WooCommerce activated
		//echo 'Enable WooCommerce';
	}
	/*=============== END WOOCOMMERCE =================*/
	
	
	
	
	
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
			'title'         => __( 'Pegsus Page Options', 'cmb2' ),
			'object_types'  => array( 'page', 'post', 'course_unit' ), // Post type
		) );

		$cmb_demo2->add_field( array(
			'name' => __( 'Fullwidth Container Checkbox', 'cmb2' ),
			'desc' => __( 'Check this box to make the page fullwidth, this shuold override the theme option for global fullwidth.', 'cmb2' ),
			'id'   => $prefix . '-page-container-checkbox',
			'type' => 'checkbox',
		) ); 	
		
		
		/**
		 * Sample metabox to demonstrate each field type included
		 */
		$cmb_demo = new_cmb2_box( array(
			'id'            => $prefix . 'metabox',
			'title'         => __( 'Additional Page Header Options', 'cmb2' ),
			'object_types'  => array( 'page',  'course_unit' ), // Post type
			
		) );

		$cmb_demo->add_field( array(
			'name'             => __( 'Additional Header Select', 'cmb2' ),
			'desc'             => __( 'This is used if you need additional header spacing. Select Header Type (no hdr, sml hdr, lrg hdr)', 'cmb2' ),
			'id'               => $prefix . '_header_three_select',
			'type'             => 'select',
			//'show_option_none' => false,
			'default'          => 'no-header',
			'options'          => array(
				'no-header' => __( 'No Header - No Spacing', 'cmb2' ),
				'space' => __( 'No Header - Just Spacing', 'cmb2' ),
				'sml-header'   => __( 'Small Header - With Parallax', 'cmb2' ),
				'lrg-header'     => __( 'Large Header - Full Width and Height', 'cmb2' ),
			),
		) );

		$cmb_demo->add_field( array(
			'name'    => __( 'Header Content wysiwyg', 'cmb2' ),
			'desc'    => __( 'This will show up in the Additional Header select area.', 'cmb2' ),
			'id'      => $prefix . '-header-three-wysiwyg',
			'type'    => 'wysiwyg',
			'options' => array( 'textarea_rows' => 5, ),
		) );
		
	}
		
		
	
	
	/*==========================
		CUSTOM COLUMNS ON PAGES
	==========================*/
	
	function pegasus_custom_pages_columns( $columns ) {
		
		$myCustomColumns = array(
			'header_type' => __( 'Header Type', 'Aternus' )
		);
		$columns = array_merge( $columns, $myCustomColumns );
		return $columns;
	}
	add_filter( 'manage_pages_columns', 'pegasus_custom_pages_columns' );
	
	
	
	add_action( 'manage_pages_custom_column', 'pegasus_header_choice_columns', 10, 2 );
	function pegasus_header_choice_columns( $column_name, $post_id ) {
	   switch( $column_name ) {
		  case 'header_type':
			 echo '<div id="post-' . $post_id . '">' . get_post_meta( $post_id, 'pegasus_header_three_select', true ) . '</div>';
			 break;
	   }
	}
	
	add_action( 'bulk_edit_custom_box', 'pegasus_add_to_bulk_quick_edit_custom_box', 10, 2 );
	add_action( 'quick_edit_custom_box', 'pegasus_add_to_bulk_quick_edit_custom_box', 10, 2 );
	function pegasus_add_to_bulk_quick_edit_custom_box( $column_name, $post_type ) {
	   switch ( $post_type ) {
		  case 'page':
			 switch( $column_name ) {
				case 'header_type':
				   ?>
					<fieldset class="inline-edit-col-left">
						<div class="inline-edit-col">
							<label>
								<span class="title">Header Select</span>
								<select name="header_type">
									<option value="no-header">No Header (Spacer)</option>
									<option value="sml-header">Small Header</option>
									<option value="lrg-header">Large Header</option>
								</select>
							</label>
						</div>
					</fieldset>
				   <?php
				   break;
			 }
			 break;
	   }
	} 
	
	/**
	 * Saving your 'Quick Edit' data is exactly like saving custom data
	 * when editing a post, using the 'save_post' hook. With that said,
	 * you may have already set this up. If you're not sure, and your
	 * 'Quick Edit' data is not saving, odds are you need to hook into
	 * the 'save_post' action.
	 *
	 * The 'save_post' action passes 2 arguments: the $post_id (an integer)
	 * and the $post information (an object).
	 */
	add_action( 'save_post', 'manage_wp_posts_be_qe_save_post', 10, 2 );
	function manage_wp_posts_be_qe_save_post( $post_id, $post ) {
		// pointless if $_POST is empty (this happens on bulk edit)
		if ( empty( $_POST ) )
			return $post_id;
			
		// verify quick edit nonce
		if ( isset( $_POST[ '_inline_edit' ] ) && ! wp_verify_nonce( $_POST[ '_inline_edit' ], 'inlineeditnonce' ) )
			return $post_id;
				
		// don't save for autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
			
		// dont save for revisions
		if ( isset( $post->post_type ) && $post->post_type == 'revision' )
			return $post_id;
			
		//switch( $post->post_type ) {
		
			//case 'page':
			
				/**
				 * Because this action is run in several places, checking for the array key
				 * keeps WordPress from editing data that wasn't in the form, i.e. if you had
				 * this post meta on your "Quick Edit" but didn't have it on the "Edit Post" screen.
				 */
				$custom_fields = array(  'pegasus_header_three_select' );
				
				foreach( $custom_fields as $field ) {
				
					if ( array_key_exists( $field, $_POST ) )
						update_post_meta( $post_id, $field, $_POST[ $field ] );
						
				}
					
				//break;
				
		//}
		
	}
	/**
	 * Saving the 'Bulk Edit' data is a little trickier because we have
	 * to get JavaScript involved. WordPress saves their bulk edit data
	 * via AJAX so, guess what, so do we.
	 *
	 * Your javascript will run an AJAX function to save your data.
	 * This is the WordPress AJAX function that will handle and save your data.
	 */
	add_action( 'wp_ajax_manage_wp_posts_using_bulk_quick_save_bulk_edit', 'manage_wp_posts_using_bulk_quick_save_bulk_edit' );
	function manage_wp_posts_using_bulk_quick_save_bulk_edit() {
		// we need the post IDs
		$post_ids = ( isset( $_POST[ 'post_ids' ] ) && !empty( $_POST[ 'post_ids' ] ) ) ? $_POST[ 'post_ids' ] : NULL;
			
		// if we have post IDs
		if ( ! empty( $post_ids ) && is_array( $post_ids ) ) {
		
			// get the custom fields
			$custom_fields = array( 'header_type' );
			
			foreach( $custom_fields as $field ) {
				
				// if it has a value, doesn't update if empty on bulk
				if ( isset( $_POST[ $field ] ) && !empty( $_POST[ $field ] ) ) {
				
					// update for each post ID
					foreach( $post_ids as $post_id ) {
						update_post_meta( $post_id, $field, $_POST[ $field ] );
					}
					
				}
				
			}
			
		}
		
	}
	
	
		
?>

