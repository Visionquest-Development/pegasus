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
		$this->options_page = add_menu_page( $this->title, $this->title, 'manage_options', $this->key, array( $this, 'admin_page_display' ) );
		//$this->options_page = add_theme_page( $this->title, $this->title, 'manage_options', $this->key, array( $this, 'admin_page_display' ) );
		// Include CMB CSS in the head to avoid FOUC
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	}
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
			'name'    => __( 'Logo', 'cmb2-example-theme' ),
			'desc' => 'Defaults to Site Title under Settings',
			'id'      => 'logo',
			'type'    => 'file'
		) );
		$cmb->add_field( array(
			'name'    => __( 'Favicon', 'cmb2-example-theme' ),
			//'desc' => 'Defaults to Site Title under Settings',
			'id'      => 'favicon',
			'type'    => 'file'
		) );
		$cmb->add_field( array(
			'name'    => __( 'Background color', 'cmb2-example-theme' ),
			'id'      => 'bg_color',
			'type'    => 'rgba_colorpicker',
			//'default' => '#404040'
		) ); 
		$cmb->add_field( array(
			'name'    => __( 'Background Image', 'cmb2-example-theme' ),
			'desc' => 'This needs to be customized by the developer for position and mobile rendering. ',
			'id'      => 'bkg_img',
			'type'    => 'file'
		) );
		$cmb->add_field( array(
			'name'             => __( 'Background Image Repeat', 'cmb2-example-theme' ),
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
				'no-repeat' => __( 'No Repeat', 'cmb2' ),
				'repeat' => __( 'Repeat', 'cmb2' ),
				'repeat-x'   => __( 'Repeat X', 'cmb2' ),
				'repeat-y'     => __( 'Repeat Y', 'cmb2' ),
				'space'     => __( 'Space', 'cmb2' ),
				'round'     => __( 'Round', 'cmb2' ),
			),
		) );
		$cmb->add_field( array(
			'name'             => __( 'Background Image Position', 'cmb2-example-theme' ),
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
		$cmb->add_field( array(
			'name'             => __( 'Background Image Size', 'cmb2-example-theme' ),
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
				'auto' => __( 'None', 'cmb2' ),
				'cover'   => __( 'Cover', 'cmb2' ),
				'100-100'     => __( '100% 100%', 'cmb2' ),
				'contain'   => __( 'Contain', 'cmb2' ),
			),
		) );
		$cmb->add_field( array(
			'name' => __( 'Background Attachment Fixed', 'cmb2-example-theme' ),
			'desc' => 'Check this box if you want the background image to be fixed / parallax effect.',
			'id'   => 'bkg_img_fixed_chk',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name'    => __( 'Content color (body,p)', 'cmb2-example-theme' ),
			'id'      => 'content_color',
			'type'    => 'colorpicker',
			//'default' => '#ffffff'
		) );
		$cmb->add_field( array(
			'name'    => __( 'Footer Widget Areas', 'cmb2-example-theme' ),
			'id'      => 'footer_widget_areas',
			'type'    => 'radio',
			'default' => 0,
			'options' => array(
				0 => __( 'None', 'cmb2-example-theme' ),
				1 => __( 'One', 'cmb2-example-theme' ),
				2 => __( 'Two', 'cmb2-example-theme' ),
				3 => __( 'Three', 'cmb2-example-theme' ),
				4 => __( 'Four', 'cmb2-example-theme' ),
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
			'name'    => __( 'Top Bar Background Color', 'cmb2-example-theme' ),
			'id'      => 'top_bar_bkg_color',
			'type'    => 'rgba_colorpicker',
			//'default' => 'rgba(0,0,0,0)'
		) ); 
		$cmb->add_field( array(
			'name'    => __( 'Top Bar Font color', 'cmb2-example-theme' ),
			'id'      => 'top_bar_font_color',
			'type'    => 'rgba_colorpicker',
			//'default' => 'rgba(0,0,0,0)'
		) );
		$cmb->add_field( array(
			'name'             => __( 'Top Column Count', 'cmb2-example-theme' ),
			//'desc'             => '',
			'id'               => 'top_column_count',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => 2,
			'options'          => array(
				2 => __( 'Two', 'cmb2' ),
				3   => __( 'Three', 'cmb2' ),
			),
		) );
		$cmb->add_field( array(
			'name' => 'Top Header Outer Container',
			'desc' => 'Check this box to make the Top header wrapped with a container.',
			'id'   => 'top_header_container',
			'type' => 'checkbox',
		) );
		$cmb->add_field( array(
			'name' => __( 'Left Area Content', 'cmb2' ),
			'desc' => __( 'Phone number or email in top bar on left.', 'cmb2' ),
			'default' => '<a href="tel:555-555-5555" class="phone">(555) 555-5555</a> <a href="mailto:user@domain.com" class="mail">user@domain.com</a>',
			'id'   => 'toparea_left_code',
			'type' => 'textarea_code',
		) );
		$cmb->add_field( array(
			'name' => __( 'Center Area Content', 'cmb2' ),
			'desc' => __( 'Middle content for top bar.', 'cmb2' ),
			'default' => 'BUSINESS NAME HERE',
			'id'   => 'toparea_center_code',
			'type' => 'textarea_code',
		) );
		$cmb->add_field( array(
			'name' => __( 'Right Area Content', 'cmb2' ),
			'desc' => __( 'Right content for top bar.', 'cmb2' ),
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
				'header-one' => __( 'Header One', 'cmb2' ),
				'header-two'   => __( 'Header Two', 'cmb2' ),
				'header-three'     => __( 'Header Three', 'cmb2' ),
				'header-four'     => __( 'Header Four', 'cmb2' ),
				'header-five'     => __( 'Header Five', 'cmb2' ),
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Mobile Hamberger Menu Color', 'cmb2-example-theme' ),
			'id'      => 'mobile_toggle_color',
			'type'    => 'colorpicker',
			//'default' => 'rgba(0,0,0,0)'
		) ); 
		$cmb->add_field( array(
			'name'    => __( 'Header Bkg color', 'cmb2-example-theme' ),
			'id'      => 'header_bkg_color',
			'type'    => 'rgba_colorpicker',
			'desc' => 'This is for the entire background of the header.',
			//'default' => 'rgba(0,0,0,0)'
		) );
		$cmb->add_field( array(
			'name' => 'Social Icons enable',
			'desc' => 'Check this if you want the social icons to appear in the header.',
			'id'   => 'nav_social_chk',
			'type' => 'checkbox',
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
			'name'    => __( 'More Menu', 'cmb2-example-theme' ),
			'id'      => 'header_more_chk',
			'type'    => 'checkbox',
			'desc' => 'Check this if you need additional menu items in the navigation. Then make sure to add another menu in the Appearence->Menus section and assign it to more menu. ',
			//'default' => 'rgba(0,0,0,0)'
		) );
		$cmb->add_field( array(
			'name'    => __( 'More Menu Widget Areas', 'cmb2-example-theme' ),
			'id'      => 'more_menu_widget_areas',
			'type'    => 'radio',
			'default' => 'two',
			'options' => array(
				0 => __( 'None', 'cmb2-example-theme' ),
				1 => __( 'One', 'cmb2-example-theme' ),
				2 => __( 'Two', 'cmb2-example-theme' ),
				3 => __( 'Three', 'cmb2-example-theme' ),
				4 => __( 'Four', 'cmb2-example-theme' ),
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
				'navs' => __( 'Navigation Menus', 'cmb2' ),
				'widgets'   => __( 'Widgets', 'cmb2' ),
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
			'name'    => __( 'Mobile Background color', 'cmb2-example-theme' ),
			'id'      => 'header_three_mobile_bg_color',
			'type'    => 'rgba_colorpicker',
			'desc' => 'This is the background of the sidebar nav on mobile.',
			//'default' => 'rgba(0,0,0,0)'
		) ); 
		$cmb->add_field( array(
			'name'    => __( 'Scroll Bkg color', 'cmb2-example-theme' ),
			'id'      => 'header_three_scroll_bg_color',
			'type'    => 'rgba_colorpicker',
			'desc' => 'The color of the background after the user has scrolled down 200 pixels.',
			//'default' => 'rgba(0,0,0,0)'
		) ); 
		$cmb->add_field( array(
			'name'    => __( 'Scroll Nav Item Color', 'cmb2-example-theme' ),
			'id'      => 'header_three_scroll_item_color',
			'type'    => 'rgba_colorpicker',
			//'default' => 'rgba(0,0,0,0)'
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
				'none' => __( 'None', 'cmb2' ),
				'navbar-light'   => __( 'Navbar Light', 'cmb2' ),
				'navbar-dark'     => __( 'Navbar Dark', 'cmb2' ),
			),
		) );

		$cmb->add_field( array(
			'name'             => 'Global Bootstrap Nav Type',
			'desc'             => 'This adjusts the breakpoint at which the menu changes to a mobile menu. navbar-expand, navbar-expand-sm, navbar-expand-md, navbar-expand-lg, navbar-expand-xl',
			'id'               => 'global_nav_viewport_break',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => 'navbar-expand-md',
			'options'          => array(
				'none' => __( 'None', 'cmb2' ),
				'navbar-expand'   => __( 'Navbar Expand', 'cmb2' ),
				'navbar-expand-sm'     => __( 'Expand Small', 'cmb2' ),
				'navbar-expand-md'     => __( 'Expand Medium', 'cmb2' ),
				'navbar-expand-lg'     => __( 'Expand Large', 'cmb2' ),
				'navbar-expand-xl'     => __( 'Expand X-Large', 'cmb2' ),
			),
		) );

		$cmb->add_field( array(
			'name'             => 'Bootstrap Nav Utility Class',
			'desc'             => 'bg-light, bg-dark, bg-faded, bg-primary',
			'id'               => 'nav_color_utility',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => 'bg-light',
			'options'          => array(
				'none' => __( 'None', 'cmb2' ),
				'bg-light'   => __( 'Background Light', 'cmb2' ),
				'bg-dark'     => __( 'Background Dark', 'cmb2' ),
				'bg-faded'     => __( 'Background Faded', 'cmb2' ),
				'bg-primary'     => __( 'Background Primary', 'cmb2' ),
			),
		) );

		$cmb->add_field( array(
			'name'    => __( 'Nav Background color', 'cmb2-example-theme' ),
			'desc' => 'Make sure select "None" for the option above ( Boostrap Nav Utility Class ).',
			'id'      => 'nav_bg_color',
			'type'    => 'rgba_colorpicker',
			//'default' => 'rgba(0,0,0,0)'
		) ); 
		$cmb->add_field( array(
			'name'    => __( 'Nav Item color', 'cmb2-example-theme' ),
			'id'      => 'nav_item_color',
			'type'    => 'colorpicker',
			//'default' => '#dedede'
		) ); 
		$cmb->add_field( array(
			'name'    => __( 'Sub-Menu Background color', 'cmb2-example-theme' ),
			'id'      => 'sub_nav_bg_color',
			'type'    => 'rgba_colorpicker',
			//'default' => 'rgba(0,0,0,0)'
		) ); 
		$cmb->add_field( array(
			'name'    => __( 'Sub-Menu Item color', 'cmb2-example-theme' ),
			'id'      => 'sub_nav_item_color',
			'type'    => 'colorpicker',
			//'default' => '#dedede'
		) );
		$cmb->add_field( array(
			'name'    => __( 'Hover Background/Text Decision', 'cmb2-example-theme' ),
			'id'      => 'hover_chk_decision',
			'type'    => 'checkbox',
			'desc'	=> 'This decides whether to use the default option of background color, or if you want the text to show up a different color on hover you would check this box.',
			//'default' => '#dedede'
		) );
		$cmb->add_field( array(
			'name'    => __( 'Hover Background/Text color', 'cmb2-example-theme' ),
			'id'      => 'hover_bg_color',
			'type'    => 'colorpicker',
			//'default' => '#dedede'
		) );
		$cmb->add_field( array(
			'name'    => __( 'Active/Current Menu Item color', 'cmb2-example-theme' ),
			'id'      => 'current_item_color',
			'type'    => 'colorpicker',
			//'default' => 'blue'
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
				'no-header' => __( 'No Header - No Spacing', 'cmb2' ),
				'space' => __( 'No Header - Just Spacing', 'cmb2' ),
				'sml-header'   => __( 'Small Header - With Parallax', 'cmb2' ),
				'lrg-header'     => __( 'Large Header - Full Width and Height', 'cmb2' ),
			),
		) );
		$cmb->add_field( array(
			'name'    => __( 'Additional Header Background color', 'cmb2-example-theme' ),
			'desc' => 'This shows by default when no header option is selected on the backend of a page. You must select short or large header on the page options to disable this.',
			'id'      => 'global_add_header_bg_color',
			'type'    => 'rgba_colorpicker',
			//'default' => 'rgba(0,0,0,0)'
		) );
		$cmb->add_field( array(
			'name'    => __( 'Overlay color', 'cmb2-example-theme' ),
			//'desc' => '',
			'id'      => 'global_add_header_overlay_color',
			'type'    => 'colorpicker',
			'default' => '#303543'
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
			'name'    => __( 'Additional Header Image', 'cmb2-example-theme' ),
			//'desc' => 'Defaults to Site Title under Settings',
			'id'      => 'global_add_header_image',
			'type'    => 'file'
		) );

		$cmb->add_field( array(
			'name' => __( 'Disable Parallax', 'cmb2-example-theme' ),
			'desc' => 'Check this box if you want to disable parallax effect.',
			'id'   => 'global_add_header_disable_parralax_chk',
			'type' => 'checkbox',
		) );

		$cmb->add_field( array(
			'name'             => __( 'Background Image Repeat', 'cmb2-example-theme' ),
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
				'no-repeat' => __( 'No Repeat', 'cmb2' ),
				'repeat' => __( 'Repeat', 'cmb2' ),
				'repeat-x'   => __( 'Repeat X', 'cmb2' ),
				'repeat-y'     => __( 'Repeat Y', 'cmb2' ),
				'space'     => __( 'Space', 'cmb2' ),
				'round'     => __( 'Round', 'cmb2' ),
			),
		) );
		$cmb->add_field( array(
			'name'             => __( 'Background Image Position', 'cmb2-example-theme' ),
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
		$cmb->add_field( array(
			'name'             => __( 'Background Image Size', 'cmb2-example-theme' ),
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
				'auto' => __( 'None', 'cmb2' ),
				'cover'   => __( 'Cover', 'cmb2' ),
				'100-100'     => __( '100% 100%', 'cmb2' ),
				'contain'   => __( 'Contain', 'cmb2' ),
			),
		) );
		$cmb->add_field( array(
			'name' => __( 'Background Attachment Fixed', 'cmb2-example-theme' ),
			'desc' => 'Check this box if you want the background image to be fixed / parallax effect.',
			'id'   => 'global_add_header_bkg_img_fixed_chk',
			'type' => 'checkbox',
		) );

		$cmb->add_field( array(
			'name'    => __( 'Header Content wysiwyg', 'cmb2' ),
			//'desc'    => __( 'This will show up in the Additional Header select area.', 'cmb2' ),
			'id'      => 'global_page_header_wysiwyg',
			'type'    => 'wysiwyg',
			'options' => array( 'textarea_rows' => 5, ),
		) );

		$cmb->add_field( array(
			'name'    => __( 'Header Content color', 'cmb2' ),
			//'desc' => '',
			'id'      => 'global_page_header_wysiwyg_color',
			'type'    => 'rgba_colorpicker',
			'default' => '#fff'
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
			'name'    => __( 'Footer Bkg color', 'cmb2-example-theme' ),
			'id'      => 'footer_bkg_color',
			'type'    => 'rgba_colorpicker',
			//'default' => 'blue'
		) ); 
		$cmb->add_field( array(
			'name'    => __( 'Bottom Footer Background color', 'cmb2-example-theme' ),
			'id'      => 'bottom_footer_bg_color',
			'type'    => 'rgba_colorpicker',
			//'default' => 'blue'
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
