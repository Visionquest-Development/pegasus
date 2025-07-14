<?php
/**
 * Silence is golden; exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * CMB2 Theme Options
 * @version 0.1.0
 */
class Pegasus_Admin {
	/**
 	 * Option key, and option page slug
 	 * @var string
 	 */
	private $key = 'pegasus_options';
	/**
 	 * Options page metabox id
 	 * @var string
 	 */
	private $metabox_id = 'pegasus_option_metabox';
	/**
	 * Options Page title
	 * @var string
	 */
	protected $title = 'pegasus_options_title';
	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = 'pegasus_hook';
	/**
	 * Holds an instance of the object
	 *
	 * @var pegasus_Admin
	 */
	protected static $instance = null;
	/**
	 * Returns the running object
	 *
	 * @return pegasus_Admin
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
			self::$instance->hooks();
		}
		return self::$instance;
	}
	/**
	 * Constructor
	 * @since 0.1.0
	 */
	protected function __construct() {
		// Set our title
		$this->title = __( 'Pegasus Options', 'pegasus' );
	}
	/**
	 * Initiate our hooks
	 * @since 0.1.0
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox' ) );
	}
	/**
	 * Register our setting to WP
	 * @since  0.1.0
	 */
	public function init() {
		register_setting( $this->key, $this->key );
	}
	/**
	 * Add menu options page
	 * @since 0.1.0
	 */
	public function add_options_page() {

		$this->options_page = add_menu_page(
			$this->title,
			$this->title,
			'manage_options',
			$this->key,
			array( $this, 'admin_page_display' )
		);

		//$this->options_page = add_theme_page( $this->title, $this->title, 'manage_options', $this->key, array( $this, 'admin_page_display' ) );

		add_submenu_page(
			$this->key, // Parent slug
			'General Options', // Page title
			'General Options', // Menu title
			'manage_options', // Capability
			$this->key, // Menu slug
			array( $this, 'admin_page_display' ) // Callback function
		);

		// add_submenu_page(
		// 	$this->key, // Parent slug
		// 	'Theme Secondary Options', // Page title
		// 	'Theme Secondary Options', // Menu title
		// 	'manage_options', // Capability
		// 	'theme_secondary_options_slug', // Menu slug
		// 	array( $this, 'submenu_admin_page_display' ) // Callback function
		// );


		// Include CMB CSS in the head to avoid FOUC
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	} //end add options page function

	/*
	public function submenu_admin_page_display() {
		?>
		<div class="wrap cmb2-options-page <?php echo $this->key; ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<h3
		</div>
		<?php
	}
	*/

	/**
	 * Admin page markup. Mostly handled by CMB2
	 * @since  0.1.0
	 */
	public function admin_page_display() {
		?>
		<div class="wrap cmb2-options-page <?php echo $this->key; ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>

		</div>
		<?php
	}

	/**
	 * Add the options metabox to the array of metaboxes
	 * @since  0.1.0
	 */
	function add_options_page_metabox() {
		// hook in our save notices
		add_action( "cmb2_save_options-page_fields_{$this->metabox_id}", array( $this, 'settings_notices' ), 10, 2 );
		$cmb = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );


		/*============================
			START GENERAL OPTIONS
		=============================*/
		$cmb->add_field( array(
			'name' => 'General Theme Options',
			//'desc' => 'Please fill out the fields below to tell us how you want the header formatted.',
			'type' => 'title',
			'id'   => 'general_options',
		) );
		$cmb->add_field( array(
			'name'    => __( 'Logo', 'pegasus-theme' ),
			'desc' => 'Defaults to Site Title under Settings',
			'id'      => 'logo',
			'type'    => 'file'
		) );
		$cmb->add_field( array(
			'name'    => __( 'Favicon', 'pegasus-theme' ),
			//'desc' => 'Defaults to Site Title under Settings',
			'id'      => 'favicon',
			'type'    => 'file',
			'query_args' => array(
				//'type' => 'application/pdf', // Make library only display PDFs.
				// Or only allow gif, jpg, or png images
				'type' => array(
				    'image/gif',
				    'image/jpeg',
				    'image/png',
				    'image/ico',
				),
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Background color', 'pegasus-theme' ),
			'id'      => 'bg_color',
			'type'    => 'colorpicker',
			//'default' => '#404040',
			'options' => array(
				'alpha' => true,
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Background Image', 'pegasus-theme' ),
			'desc' => 'This needs to be customized by the developer for position and mobile rendering. ',
			'id'      => 'bkg_img',
			'type'    => 'file'
		) );
		$cmb->add_field( array(
			'name'             => __( 'Background Image Repeat', 'pegasus-theme' ),
			'desc'             => '<strong>Choose between:
										   1.) No Repeat
										   2.) Repeat
										   3.) Repeat-X
										   3.) Repeat-Y
										   4.) Space
										   5.) Round
										</strong>',
			'id'               => 'bkg_img_repeat',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => 'none',
			'options'          => array(
				'no-repeat' => __( 'No Repeat', 'pegasus-theme' ),
				'repeat' => __( 'Repeat', 'pegasus-theme' ),
				'repeat-x'   => __( 'Repeat X', 'pegasus-theme' ),
				'repeat-y'     => __( 'Repeat Y', 'pegasus-theme' ),
				'space'     => __( 'Space', 'pegasus-theme' ),
				'round'     => __( 'Round', 'pegasus-theme' ),
			),
		) );
		$cmb->add_field( array(
			'name'             => __( 'Background Image Position', 'pegasus-theme' ),
			'desc'             => '<strong>Choose between:
										   1.) Center Center
										   2.) Top Left
										   3.) Top Center
										   3.) Top Right
										   4.) Bottom Left
										   5.) Bottom Center
											6.) Bottom Right
										</strong>',
			'id'               => 'bkg_img_pos',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => '100-100',
			'options'          => array(
				'100-100' => __( '100% 100%', 'pegasus-theme' ),
				'center-center' => __( 'Center Center', 'pegasus-theme' ),
				'top-left'   => __( 'Top Left', 'pegasus-theme' ),
				'top-center'     => __( 'Top Center', 'pegasus-theme' ),
				'top-right'     => __( 'Top Right', 'pegasus-theme' ),
				'bottom-left'     => __( 'Bottom Left', 'pegasus-theme' ),
				'bottom-center'     => __( 'Bottom Center', 'pegasus-theme' ),
				'bottom-right'     => __( 'Bottom Right', 'pegasus-theme' ),
			),
		) );
		$cmb->add_field( array(
			'name'             => __( 'Background Image Size', 'pegasus-theme' ),
			'desc'             => '<strong>Choose between:
									   1.) None
									   2.) Cover
									   3.) 100% 100%
									</strong>',
			'id'               => 'bkg_img_size',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => 'cover',
			'options'          => array(
				'auto' => __( 'None', 'pegasus-theme' ),
				'cover'   => __( 'Cover', 'pegasus-theme' ),
				'100-100'     => __( '100% 100%', 'pegasus-theme' ),
				'contain'   => __( 'Contain', 'pegasus-theme' ),
			),
		) );
		$cmb->add_field( array(
			'name' => __( 'Background Attachment Fixed', 'pegasus-theme' ),
			'desc' => 'Check this box if you want the background image to be fixed / parallax effect.',
			'id'   => 'bkg_img_fixed_chk',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name'    => __( 'Content color (body,p)', 'pegasus-theme' ),
			'id'      => 'content_color',
			'type'    => 'colorpicker',
			//'default' => 'rgba(119, 119, 119, 1)',
			'options' => array(
				'alpha' => true,
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Footer Widget Areas', 'pegasus-theme' ),
			'id'      => 'footer_widget_areas',
			'type'    => 'radio',
			'default' => 0,
			'options' => array(
				0 => __( 'None', 'pegasus-theme' ),
				1 => __( 'One', 'pegasus-theme' ),
				2 => __( 'Two', 'pegasus-theme' ),
				3 => __( 'Three', 'pegasus-theme' ),
				4 => __( 'Four', 'pegasus-theme' ),
			)
		) );
		$cmb->add_field( array(
			'name' => 'Global fullwith container',
			'desc' => 'Check this box if you want the website to have a Full Width Container.',
			'id'   => 'full_container_chk',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name' => 'Boxed Layout ',
			'desc' => 'Check this box if you want the website to appear in a boxed layout.',
			'id'   => 'boxed_layout_chk',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name' => 'Left Align Sidebar',
			'desc' => 'Check this box if you want the sidebar to show up on the left instead of the right.',
			'id'   => 'sidebar_left_chk',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name' => 'Enable Both Sidebars',
			'desc' => 'Make sure Left Align Sidebar option is checked.',
			'id'   => 'both_sidebar_chk',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name' => 'Enable Page Loader?',
			'desc' => 'Check this box if you would like to remove the Page Loader from the webpage.',
			'id'   => 'page_loader_chk',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name' => 'Disable WPADMIN Bar',
			'desc' => 'Check this box if you would like to remove the WP Admin bar from the frontend.',
			'id'   => 'wp_admin_bar_chk',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name' => 'Top Bar Checkbox',
			'desc' => 'Check this box to enable Top Bar',
			'id'   => 'top_header_chk',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name' => 'Enable Breadcrumbs',
			'desc' => 'Check this box if you want breadcrumbs to appear',
			'id'   => 'bread_chk',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name' => 'WooCommerce Theme?',
			'desc' => 'Check this box if you will be selling products using woocommerce',
			'id'   => 'woo_chk',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name' => 'Disable Page Header?',
			'desc' => 'Check this box if you would like to remove the Page Title from the top of each page.',
			'id'   => 'page_header_chk',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name' => 'Disable Comments Globally?',
			'desc' => 'Check this box if you would like to remove comments on all pages.',
			'id'   => 'disable_comment_chk',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name' => 'Enable back to top button',
			'desc' => 'Check this box to enable Back to top',
			'id'   => 'back_to_top',
			'type' => 'checkbox',
		) );

		/*============================
			ECOMMERCE
		=============================*/


		$cmb->add_field( array(
			'name' => 'E-Commerce Options',
			//'desc' => 'Please fill out the fields below to tell us how you want the header formatted.',
			'type' => 'title',
			'id'   => 'ecommerce_options',

		) );
		$cmb->add_field( array(
			'name' => 'Disable Shop Link?',
			'desc' => 'Check this box if you want to disable the shop link in the header',
			'id'   => 'shop_link_chk',
			'type' => 'checkbox',

		) );
		$cmb->add_field( array(
			'name' => 'Keep User and Cart Menu in Top bar',
			'desc' => 'Check this box if you want to keep the User Menu and Cart Menu in the top header',
			'id'   => 'woo_menu_top_chk',
			'type' => 'checkbox',

		) );
		$cmb->add_field( array(
			'name' => 'Disable User Menu?',
			'desc' => 'Check this box if you want to disable the user menu',
			'id'   => 'user_menu_chk',
			'type' => 'checkbox',

		) );
		$cmb->add_field( array(
			'name' => 'Disable Cart Menu?',
			'desc' => 'Check this box if you want to disable cart menu',
			'id'   => 'cart_menu_chk',
			'type' => 'checkbox',

		) );

		/*============================
			TOP HEADER
		=============================*/
		// TOP HEADER OPTIONS
		$cmb->add_field( array(
			'name' => 'Top Bar Options',
			//'desc' => 'Please fill out the fields below to tell us how you want the header formatted.',
			'type' => 'title',
			'id'   => 'top_header_title'
		) );
		$cmb->add_field( array(
			'name'    => __( 'Top Bar Background Color', 'pegasus-theme' ),
			'id'      => 'top_bar_bkg_color',
			'type'    => 'colorpicker',
			//'default' => 'rgba(0,0,0,0)',
			'options' => array(
				'alpha' => true,
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Top Bar Font color', 'pegasus-theme' ),
			'id'      => 'top_bar_font_color',
			'type'    => 'colorpicker',
			//'default' => 'rgba(0,0,0,0)',
			'options' => array(
				'alpha' => true,
			),
		) );
		$cmb->add_field( array(
			'name'             => __( 'Top Column Count', 'pegasus-theme' ),
			//'desc'             => '',
			'id'               => 'top_column_count',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => 2,
			'options'          => array(
				2 => __( 'Two', 'pegasus-theme' ),
				3   => __( 'Three', 'pegasus-theme' ),
			),
		) );
		$cmb->add_field( array(
			'name' => 'Top Header Outer Container',
			'desc' => 'Check this box to make the Top header wrapped with a container.',
			'id'   => 'top_header_container',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name' => __( 'Left Area Content', 'pegasus-theme' ),
			'desc' => __( 'Phone number or email in top bar on left.', 'pegasus-theme' ),
			'default' => '<a href="tel:555-555-5555" class="phone">(555) 555-5555</a> <a href="mailto:user@domain.com" class="mail">user@domain.com</a>',
			'id'   => 'toparea_left_code',
			'type' => 'textarea_code',
		) );
		$cmb->add_field( array(
			'name' => __( 'Center Area Content', 'pegasus-theme' ),
			'desc' => __( 'Middle content for top bar.', 'pegasus-theme' ),
			'default' => 'BUSINESS NAME HERE',
			'id'   => 'toparea_center_code',
			'type' => 'textarea_code',
		) );
		$cmb->add_field( array(
			'name' => __( 'Right Area Content', 'pegasus-theme' ),
			'desc' => __( 'Right content for top bar.', 'pegasus-theme' ),
			'default' => 'Shortcode or Text here',
			'id'   => 'toparea_right_code',
			'type' => 'textarea_code',
		) );
		$cmb->add_field( array(
			'name' => 'Social Icons enable',
			'desc' => 'Check this box if you want social menu to show up on right hand side of Top bar. Make sure you assign the social media menu.',
			'id'   => 'top_social_chk',
			'type' => 'checkbox',
		) );

		/*============================
			GENERAL HEADER OPTIONS
		=============================*/
		// GENERAL HEADER OPTIONS
		$cmb->add_field( array(
			'name' => 'Header Options',
			//'desc' => 'Please fill out the fields below to tell us how you want the header formatted.',
			'type' => 'title',
			'id'   => 'header_title'
		) );
		$cmb->add_field( array(
			'name'             => 'Header Select',
			'desc'             => '<strong>Choose between:<br>
									   1.) Header one - Logo Above Navbar, Navbar opaque, MegaMenu, and social media menu.(IDEAL for large menu systems because of its MEGAMENU)<br>
									   2.) Header two - Logo Inside (left) Navbar, transparent navigation, and with social media menu (good for small logos and simple design)<br>
									   3.) Header three - Fixed Fullwidth Fancy Header, transparent navigation, sidebar mobile nav (not good for a lot of menu items), special page options for small or large header.<br>
									   4.) Header four - Bottom Sticky Fullwidth Fancy Header, transparent navigation, sidebar mobile nav (not good for a lot of menu items)<br>
									   5.) Header five.
									</strong>',
			'id'               => 'header_select',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => 'header-one',
			'options'          => array(
				'header-one' => __( 'Header One', 'pegasus-theme' ),
				'header-two'   => __( 'Header Two', 'pegasus-theme' ),
				'header-three'     => __( 'Header Three', 'pegasus-theme' ),
				'header-four'     => __( 'Header Four', 'pegasus-theme' ),
				'header-five'     => __( 'Header Five', 'pegasus-theme' ),
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Mobile Hamburger Menu Color', 'pegasus-theme' ),
			'id'      => 'mobile_toggle_color',
			'type'    => 'colorpicker',
			//'default' => 'rgba(0,0,0,0)',
			'options' => array(
				'alpha' => true,
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Mobile Hamburger Menu Border Color', 'pegasus-theme' ),
			'id'      => 'mobile_toggle_border_color',
			'type'    => 'colorpicker',
			//'default' => 'rgba(0,0,0,0)',
			'options' => array(
				'alpha' => true,
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Header Bkg color', 'pegasus-theme' ),
			'id'      => 'header_bkg_color',
			'type'    => 'colorpicker',
			'desc' => 'This is for the entire background of the header.',
			//'default' => 'rgba(0,0,0,0)',
			'options' => array(
				'alpha' => true,
			),
		) );

		$cmb->add_field( array(
			'name' => 'Search Box enable',
			'desc' => 'Check this if you want the search to appear in the header.',
			'id'   => 'search_box_chk',
			'type' => 'checkbox',
		) );

		$cmb->add_field( array(
			'name' => 'Fixed Navigation',
			'desc' => 'Check this box to make the the header fixed. This also enables the absolute menu.',
			'id'   => 'header_fixed_checkbox',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name' => 'Sticky Navigation',
			'desc' => 'This only works for Header Two',
			'id'   => 'header_sticky_checkbox',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name' => 'Social Icons enable',
			'desc' => 'Check this if you want the social icons to appear in the header.',
			'id'   => 'nav_social_chk',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name'    => __( 'More Menu', 'pegasus-theme' ),
			'id'      => 'header_more_chk',
			'type'    => 'checkbox',
			'desc' => 'Check this if you need additional menu items in the navigation. Then make sure to add another menu in the Appearence->Menus section and assign it to more menu. ',
			//'default' => 'rgba(0,0,0,0)'
		) );
		$cmb->add_field( array(
			'name'    => __( 'More Menu Widget Areas', 'pegasus-theme' ),
			'id'      => 'more_menu_widget_areas',
			'type'    => 'radio',
			'default' => 2,
			'options' => array(
				0 => __( 'None', 'pegasus-theme' ),
				1 => __( 'One', 'pegasus-theme' ),
				2 => __( 'Two', 'pegasus-theme' ),
				3 => __( 'Three', 'pegasus-theme' ),
				4 => __( 'Four', 'pegasus-theme' ),
			)
		) );
		$cmb->add_field( array(
			'name'             => 'Mega Menu: Navs or Widgets ',
			'desc'             => '<strong></strong>',
			'id'               => 'menus_vs_widgets_select',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => 'navs',
			'options'          => array(
				'navs' => __( 'Navigation Menus', 'pegasus-theme' ),
				'widgets'   => __( 'Widgets', 'pegasus-theme' ),
			),
		) );

		/*============================
			HEADER ONE AND TWO
		=============================*/


		// HEADER ONE AND HEADER TWO OPTIONS
		$cmb->add_field( array(
			'name' => 'Header One and Two Options',
			//'desc' => 'Please fill out the fields below to tell us how you want the header formatted.',
			'type' => 'title',
			'id'   => 'header_one_title',
		) );
		$cmb->add_field( array(
			'name' => 'Center Logo',
			'desc' => 'Check this box to make the logo centered. This only works on Header One.',
			'id'   => 'logo_centered',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name' => 'Justify Nav Menu',
			'desc' => 'Check this box to make the links in the navigation centered.',
			'id'   => 'nav_justify',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name' => 'Right Align Nav Items',
			'desc' => 'Check this box to make the links in the navigation show up on the right while in desktop mode.',
			'id'   => 'nav_right',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name' => 'Header Outer Container',
			'desc' => 'Check this box to make the header wrapped with a container.',
			'id'   => 'header_container',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name' => 'Enable Nav Inner Fullwidth Container',
			'desc' => 'Enable the Fullwidth container inside the header. This overrides the Global Setting.',
			'id'   => 'nav_inner_container_checkbox',
			'type' => 'checkbox',
		) );


		/*============================
			HEADER THREE AND FOUR
		=============================*/

		// HEADER THREE
		$cmb->add_field( array(
			'name' => 'Header Three and Four Options',
			//'desc' => 'Please fill out the fields below to tell us how you want the header formatted.',
			'type' => 'title',
			'id'   => 'header_three_title'
		) );
		$cmb->add_field( array(
			'name' => 'Right align nav menu items',
			'desc' => 'Check this box to make the navigation items float right',
			'id'   => 'header_three_right_checkbox',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name' => 'Disable fixed header',
			'desc' => 'By default this header has a fixed top navigation bar and sidebar menu for mobile. Check this box to make the navigation no longer remain fixed at the top.',
			'id'   => 'header_three_disable_fixed_checkbox',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name'    => __( 'Mobile Background color', 'pegasus-theme' ),
			'id'      => 'header_three_mobile_bg_color',
			'type'    => 'colorpicker',
			'desc' => 'This is the background of the sidebar nav on mobile.',
			//'default' => 'rgba(0,0,0,0)',
			'options' => array(
				'alpha' => true,
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Scroll Bkg color', 'pegasus-theme' ),
			'id'      => 'header_three_scroll_bg_color',
			'type'    => 'colorpicker',
			'desc' => 'The color of the background after the user has scrolled down 200 pixels.',
			//'default' => 'rgba(0,0,0,0.8)',
			'options' => array(
				'alpha' => true,
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Scroll Nav Item Color', 'pegasus-theme' ),
			'id'      => 'header_three_scroll_item_color',
			'type'    => 'colorpicker',
			//'default' => 'rgba(0,0,0,0)',
			'options' => array(
				'alpha' => true,
			),
		) );

		/*============================
			NAVIGATION
		=============================*/
		// NAVIGATION OPTIONS
		$cmb->add_field( array(
			'name' => 'Navigation Options',
			//'desc' => 'Make sure you have CMB2 RGBa Colorpicker plugin installed.',
			'type' => 'title',
			'id'   => 'nav_title'
		) );

		$cmb->add_field( array(
			'name'             => 'Bootstrap Nav Color Scheme',
			'desc'             => 'none, navbar-light, navbar-dark',
			'id'               => 'nav_color_scheme',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => 'none',
			'options'          => array(
				'none' => __( 'None', 'pegasus-theme' ),
				'navbar-light'   => __( 'Navbar Light', 'pegasus-theme' ),
				'navbar-dark'     => __( 'Navbar Dark', 'pegasus-theme' ),
			),
		) );

		// $cmb->add_field( array(
		// 	'name'             => 'Global Bootstrap Nav Type',
		// 	'desc'             => 'This adjusts the breakpoint at which the menu changes to a mobile menu. navbar-expand, navbar-expand-sm, navbar-expand-md, navbar-expand-lg, navbar-expand-xl',
		// 	'id'               => 'global_nav_viewport_break',
		// 	'type'             => 'select',
		// 	'show_option_none' => false,
		// 	'default'          => 'navbar-expand-md',
		// 	'options'          => array(
		// 		'none' => __( 'None', 'pegasus-theme' ),
		// 		'navbar-expand'   => __( 'Navbar Expand', 'pegasus-theme' ),
		// 		'navbar-expand-sm'     => __( 'Expand Small', 'pegasus-theme' ),
		// 		'navbar-expand-md'     => __( 'Expand Medium', 'pegasus-theme' ),
		// 		'navbar-expand-lg'     => __( 'Expand Large', 'pegasus-theme' ),
		// 		'navbar-expand-xl'     => __( 'Expand X-Large', 'pegasus-theme' ),
		// 	),
		// ) );

		$cmb->add_field( array(
			'name'             => 'Bootstrap Nav Utility Class',
			'desc'             => 'bg-light, bg-dark, bg-faded, bg-primary',
			'id'               => 'nav_color_utility',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => 'none',
			'options'          => array(
				'none' => __( 'None', 'pegasus-theme' ),
				'bg-light'   => __( 'Background Light', 'pegasus-theme' ),
				'bg-dark'     => __( 'Background Dark', 'pegasus-theme' ),
				'bg-faded'     => __( 'Background Faded', 'pegasus-theme' ),
				'bg-primary'     => __( 'Background Primary', 'pegasus-theme' ),
			),
		) );

		$cmb->add_field( array(
			'name'    => __( 'Nav Background color', 'pegasus-theme' ),
			'desc' => 'Make sure select "None" for the option above ( Boostrap Nav Utility Class ).',
			'id'      => 'nav_bg_color',
			'type'    => 'colorpicker',
			//'default' => 'rgba(0,0,0,0)',
			'options' => array(
				'alpha' => true,
			),
		) );
		// $cmb->add_field( array(
		// 	'name'    => __( 'Nav Background Hover color', 'pegasus-theme' ),
		// 	//'desc' => 'Make sure select "None" for the option above ( Boostrap Nav Utility Class ).',
		// 	'id'      => 'nav_bg_hover_color',
		// 	'type'    => 'colorpicker',
		// 	//'default' => 'rgba(0,0,0,0)',
		// 'options' => array(
		// 		'alpha' => true,
		// 	),
		// ) );
		$cmb->add_field( array(
			'name'    => __( 'Nav Item color', 'pegasus-theme' ),
			'id'      => 'nav_item_color',
			'type'    => 'colorpicker',
			'default' => 'rgba(0,0,0,0.65)',
			'options' => array(
				'alpha' => true,
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Nav Item Hover color', 'pegasus-theme' ),
			'id'      => 'nav_item_hover_color',
			'type'    => 'colorpicker',
			'default' => 'rgba(0,0,0,0.45)',
			'options' => array(
				'alpha' => true,
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Nav Item Background color', 'pegasus-theme' ),
			'id'      => 'nav_item_bkg_color',
			'type'    => 'colorpicker',
			//'default' => '#dedede',
			'options' => array(
				'alpha' => true,
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Nav Item Background Hover color', 'pegasus-theme' ),
			'id'      => 'nav_item_bkg_hover_color',
			'type'    => 'colorpicker',
			//'default' => '#dedede',
			'options' => array(
				'alpha' => true,
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Sub-Menu Item color for Desktop', 'pegasus-theme' ),
			'id'      => 'sub_nav_item_color',
			'type'    => 'colorpicker',
			//'default' => 'rgba(0,0,0,0.65)',
			'options' => array(
				'alpha' => true,
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Sub-Menu Item Hover color for Desktop', 'pegasus-theme' ),
			'id'      => 'sub_nav_item_hover_color',
			'type'    => 'colorpicker',
			'default' => 'rgba(0,0,0,0.45)',
			'options' => array(
				'alpha' => true,
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Sub-Menu Background color', 'pegasus-theme' ),
			'id'      => 'sub_nav_bg_color',
			'type'    => 'colorpicker',
			//'default' => 'rgba(222,222,222,0.8)',
			'options' => array(
				'alpha' => true,
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Sub-Menu Background Hover color', 'pegasus-theme' ),
			'id'      => 'sub_nav_bg_hover_color',
			'type'    => 'colorpicker',
			//'default' => 'rgba(222,222,222,0.6)',
			'options' => array(
				'alpha' => true,
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Active/Current Menu Item color', 'pegasus-theme' ),
			'id'      => 'current_item_color',
			'type'    => 'colorpicker',
			//'default' => 'rgba(0,0,0,0.80)',
			'options' => array(
				'alpha' => true,
			),
		) );

		$cmb->add_field( array(
			'name' => __( 'Mobile Submenu Always Visible', 'pegasus-theme' ),
			'desc' => __( 'Check this box to make all submenus always visible on mobile devices instead of requiring clicks to expand them.', 'pegasus-theme' ),
			'id'   => 'mobile_submenu_always_visible',
			'type' => 'checkbox',
		) );

		/*============================
			ADDITIONAL HEADER OPTIONS
		=============================*/
		$cmb->add_field( array(
			'name' => 'Additional Header Options',
			//'desc' => 'Please fill out the fields below to tell us how you want the header formatted.',
			'type' => 'title',
			'id'   => 'additional_header_title'
		) );
		$cmb->add_field( array(
			'name'             => 'Global Page Additional Header Choice',
			'desc'             => 'no-header, spacer, sml-header, lrg-header ',
			'id'               => 'global_additional_header_option',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => 'none',
			'options'          => array(
				'no-header' => __( 'No Header - No Spacing', 'pegasus-theme' ),
				'space' => __( 'No Header - Just Spacing', 'pegasus-theme' ),
				'sml-header'   => __( 'Small Header - With Parallax', 'pegasus-theme' ),
				'lrg-header'     => __( 'Large Header - Full Width and Height', 'pegasus-theme' ),
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Additional Header Background color', 'pegasus-theme' ),
			'desc' => 'This shows by default when no header option is selected on the backend of a page. You must select short or large header on the page options to disable this.',
			'id'      => 'global_add_header_bg_color',
			'type'    => 'colorpicker',
			//'default' => 'rgba(0,0,0,0)',
			'options' => array(
				'alpha' => true,
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Overlay color', 'pegasus-theme' ),
			//'desc' => '',
			'id'      => 'global_add_header_overlay_color',
			'type'    => 'colorpicker',
			'default' => 'rgba(48, 53, 67, 1)',
			'options' => array(
				'alpha' => true,
			),
		) );
		$cmb->add_field( array(
			'name' => 'Overlay Opacity',
			//'desc' => 'If there is no color on your footer, enable this so that the footer is easily identifiable.',
			'id'   => 'global_add_header_overlay_opacity',
			'type' => 'text',
			'default' => '0.4'
		) );

		$cmb->add_field( array(
			'name' => 'NoSpacer Padding',
			//'desc' => 'If there is no color on your footer, enable this so that the footer is easily identifiable.',
			'id'   => 'global_nospacer_padding',
			'type' => 'text',
			'default' => '55px 0'
		) );
		$cmb->add_field( array(
			'name'    => __( 'Additional Header Image', 'pegasus-theme' ),
			//'desc' => 'Defaults to Site Title under Settings',
			'id'      => 'global_add_header_image',
			'type'    => 'file'
		) );

		$cmb->add_field( array(
			'name' => __( 'Disable Parallax', 'pegasus-theme' ),
			'desc' => 'Check this box if you want to disable parallax effect.',
			'id'   => 'global_add_header_disable_parralax_chk',
			'type' => 'checkbox',
		) );

		$cmb->add_field( array(
			'name' => __( 'Disable Overlay', 'pegasus-theme' ),
			'desc' => 'Check this box if you want to disable overlay effect.',
			'id'   => 'global_add_header_disable_overlay_chk',
			'type' => 'checkbox',
		) );

		$cmb->add_field( array(
			'name'             => __( 'Background Image Repeat', 'pegasus-theme' ),
			'desc'             => '<strong>Choose between:
										   1.) No Repeat
										   2.) Repeat
										   3.) Repeat-X
										   3.) Repeat-Y
										   4.) Space
										   5.) Round
										</strong>',
			'id'               => 'global_add_header_bkg_img_repeat',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => 'none',
			'options'          => array(
				'no-repeat' => __( 'No Repeat', 'pegasus-theme' ),
				'repeat' => __( 'Repeat', 'pegasus-theme' ),
				'repeat-x'   => __( 'Repeat X', 'pegasus-theme' ),
				'repeat-y'     => __( 'Repeat Y', 'pegasus-theme' ),
				'space'     => __( 'Space', 'pegasus-theme' ),
				'round'     => __( 'Round', 'pegasus-theme' ),
			),
		) );
		$cmb->add_field( array(
			'name'             => __( 'Background Image Position', 'pegasus-theme' ),
			'desc'             => '<strong>Choose between:
										   1.) Center Center
										   2.) Top Left
										   3.) Top Center
										   3.) Top Right
										   4.) Bottom Left
										   5.) Bottom Center
											6.) Bottom Right
										</strong>',
			'id'               => 'global_add_header_bkg_img_pos',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => '50-0',
			'options'          => array(
				'50-0' => __( '50% 0', 'pegasus-theme' ),
				'100-100' => __( '100% 100%', 'pegasus-theme' ),
				'center-center' => __( 'Center Center', 'pegasus-theme' ),
				'top-left'   => __( 'Top Left', 'pegasus-theme' ),
				'top-center'     => __( 'Top Center', 'pegasus-theme' ),
				'top-right'     => __( 'Top Right', 'pegasus-theme' ),
				'bottom-left'     => __( 'Bottom Left', 'pegasus-theme' ),
				'bottom-center'     => __( 'Bottom Center', 'pegasus-theme' ),
				'bottom-right'     => __( 'Bottom Right', 'pegasus-theme' ),
			),
		) );
		$cmb->add_field( array(
			'name'             => __( 'Background Image Size', 'pegasus-theme' ),
			'desc'             => '<strong>Choose between:
									   1.) None
									   2.) Cover
									   3.) 100% 100%
									</strong>',
			'id'               => 'global_add_header_bkg_img_size',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => 'cover',
			'options'          => array(
				'auto' => __( 'None', 'pegasus-theme' ),
				'cover'   => __( 'Cover', 'pegasus-theme' ),
				'100-100'     => __( '100% 100%', 'pegasus-theme' ),
				'contain'   => __( 'Contain', 'pegasus-theme' ),
			),
		) );
		$cmb->add_field( array(
			'name' => __( 'Background Attachment Fixed', 'pegasus-theme' ),
			'desc' => 'Check this box if you want the background image to be fixed / parallax effect.',
			'id'   => 'global_add_header_bkg_img_fixed_chk',
			'type' => 'checkbox',
		) );

		$cmb->add_field( array(
			'name'    => __( 'Header Content wysiwyg', 'pegasus-theme' ),
			//'desc'    => __( 'This will show up in the Additional Header select area.', 'pegasus-theme' ),
			'id'      => 'global_page_header_wysiwyg',
			'type'    => 'wysiwyg',
			'options' => array( 'textarea_rows' => 5, ),
		) );

		$cmb->add_field( array(
			'name'    => __( 'Header Content color', 'pegasus-theme' ),
			//'desc' => '',
			'id'      => 'global_page_header_wysiwyg_color',
			'type'    => 'colorpicker',
			'default' => '#fff',
			'options' => array(
				'alpha' => true,
			),
		) );


		/*============================
			FOOTER
		=============================*/
		// FOOTER
		$cmb->add_field( array(
			'name' => 'Footer Options',
			//'desc' => 'Please fill out the fields below to tell us how you want the header formatted.',
			'type' => 'title',
			'id'   => 'footer_title'
		) );
		$cmb->add_field( array(
			'name' => 'Enable top border',
			'desc' => 'If there is no color on your footer, enable this so that the footer is easily identifiable.',
			'id'   => 'footer_hr_checkbox',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name'    => __( 'Footer Text color', 'pegasus-theme' ),
			'id'      => 'footer_text_color',
			'type'    => 'colorpicker',
			'default' => 'rgba(0,0,0,0.8)',
			'options' => array(
				'alpha' => true,
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Footer Bkg color', 'pegasus-theme' ),
			'id'      => 'footer_bkg_color',
			'type'    => 'colorpicker',
			'default' => 'rgba(0,0,0,0.02)',
			'options' => array(
				'alpha' => true,
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Bottom Footer Background color', 'pegasus-theme' ),
			'id'      => 'bottom_footer_bg_color',
			'type'    => 'colorpicker',
			'default' => 'rgba(0,0,0,0.04)',
			'options' => array(
				'alpha' => true,
			),
		) );
		$cmb->add_field( array(
			'name' => 'Fullwidth Bottom Bar',
			//'desc' => 'Check this box to make the logo centered',
			'id'   => 'footer_fullwidth_checkbox',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name' => 'Custom Footer Copywrite',
			//'desc' => 'field description (optional)',
			//'default' => '.selector { property: attribute; }',
			'id' => 'footer_copy_textareacode',
			'type' => 'textarea_code'
		) );


		/*============================
			ADDITIONAL OPTIONS
		=============================*/
		// ADDITIONAL
		$cmb->add_field( array(
			'name' => 'Additional Options',
			//'desc' => 'Please fill out the fields below to tell us how you want the header formatted.',
			'type' => 'title',
			'id'   => 'additional_title'
		) );
		$cmb->add_field( array(
			'name' => 'Custom CSS Code',
			'desc' => '.selector { property: attribute; }',
			//'default' => '.selector { property: attribute; }',
			'id' => 'custom_css_textareacode',
			'type' => 'textarea_code'
		) );
		$cmb->add_field( array(
			'name' => 'Header Custom Code',
			'desc' => 'This will show up right after the logo before the menu.',
			//'default' => '.selector { property: attribute; }',
			'id' => 'custom_top_textareacode',
			'type' => 'textarea_code'
		) );
		$cmb->add_field( array(
			'name' => 'Bottom Custom Code',
			'desc' => 'This will show up right before the footer widgets under the content.',
			//'default' => '.selector { property: attribute; }',
			'id' => 'custom_bottom_textareacode',
			'type' => 'textarea_code'
		) );

		$cmb->add_field( array(
			'name' => 'Enable Portfolio Custom Post Type',
			//'desc' => 'If there is no color on your footer, enable this so that the footer is easily identifiable.',
			'id'   => 'cpt_portfolio_checkbox',
			'type' => 'checkbox',
		) );

		$cmb->add_field( array(
			'name' => 'Enable Staff Custom Post Type',
			//'desc' => 'If there is no color on your footer, enable this so that the footer is easily identifiable.',
			'id'   => 'cpt_staff_checkbox',
			'type' => 'checkbox',
		) );

		$cmb->add_field( array(
			'name' => 'Enable Testimonial Custom Post Type',
			//'desc' => 'If there is no color on your footer, enable this so that the footer is easily identifiable.',
			'id'   => 'cpt_testimonial_checkbox',
			'type' => 'checkbox',
		) );

		$cmb->add_field( array(
			'name' => 'Enable Logo Slider Custom Post Type',
			//'desc' => 'If there is no color on your footer, enable this so that the footer is easily identifiable.',
			'id'   => 'cpt_logo_slider_checkbox',
			'type' => 'checkbox',
		) );

	}











	/*==========================================
			END THEME OPTIONS
	===========================================*/



	/**
	 * Register settings notices for display
	 *
	 * @since  0.1.0
	 * @param  int   $object_id Option key
	 * @param  array $updated   Array of updated fields
	 * @return void
	 */
	public function settings_notices( $object_id, $updated ) {
		if ( $object_id !== $this->key || empty( $updated ) ) {
			return;
		}
		add_settings_error( $this->key . '-notices', '', __( 'Settings updated.', 'pegasus' ), 'updated' );
		settings_errors( $this->key . '-notices' );
	}
	/**
	 * Public getter method for retrieving protected/private variables
	 * @since  0.1.0
	 * @param  string  $field Field to retrieve
	 * @return mixed          Field value or exception is thrown
	 */
	public function __get( $field ) {
		// Allowed fields to retrieve
		if ( in_array( $field, array( 'key', 'metabox_id', 'title', 'options_page' ), true ) ) {
			return $this->{$field};
		}
		throw new Exception( 'Invalid property: ' . $field );
	}
}
/*==========================================
		END OF CLASS
===========================================*/




/**
 * Helper function to get/return the pegasus_Admin object
 * @since  0.1.0
 * @return pegasus_Admin object
 */
function pegasus_admin() {
	return Pegasus_Admin::get_instance();
}
/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string $key     Options array key
 * @param  mixed  $default Optional default value
 * @return mixed           Option value
 */
function pegasus_get_option( $key = '', $default = false ) {
	if ( function_exists( 'cmb2_get_option' ) ) {
		// Use cmb2_get_option as it passes through some key filters.
		return cmb2_get_option( pegasus_admin()->key, $key, $default );
	}
	// Fallback to get_option if CMB2 is not loaded yet.
	$opts = get_option( pegasus_admin()->key, $key, $default );
	$val = $default;
	if ( 'all' == $key ) {
		$val = $opts;
	} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}
	return $val;
}
// Get it started
pegasus_admin();
