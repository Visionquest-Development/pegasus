<?php
/**
 * Silence is golden; exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Example theme options page powered by CMB2
 */
class Pegasus_Theme_Options {

	/**
	 * Option key, and option page slug
	 * @var string
	 */
	private $key = 'pegasus_theme_options';

	/**
	 * Array of metaboxes/fields
	 * @var array
	 */
	protected $option_metabox = array();

	/**
	 * Options Page title
	 * @var string
	 */
	protected $title = 'Pegasus Theme Options';

	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = 'pegasus_theme_options_page';

	/**
	 * Constructor
	 * @since 0.1.0
	 */
	public function __construct() {
		// Set our title
		$this->title = __( 'Pegasus Options', 'cmb2-example-theme' );

		// Set our CMB2 fields, wrap them in a filter so others can easily tap in and add their own as well.
		$this->fields = apply_filters( 'pegasus_theme_options', array(
			// GENERAL THEME OPTIONS
			array(
				'name' => 'Theme Options',
				//'desc' => 'Please fill out the fields below to tell us how you want the header formatted.',
				'type' => 'title',
				'id'   => 'theme_options'
			),
			array(
				'name'    => __( 'Logo', 'cmb2-example-theme' ),
				'desc' => 'Defaults to Site Title under Settings',
				'id'      => 'logo',
				'type'    => 'file'
			),		
			array(
				'name'    => __( 'Background Color', 'cmb2-example-theme' ),
				'id'      => 'bg_color',
				'type'    => 'rgba_colorpicker',
				//'default' => '#404040'
			),
			array(
				'name'    => __( 'Content Color (body,p)', 'cmb2-example-theme' ),
				'id'      => 'content_color',
				'type'    => 'colorpicker',
				//'default' => '#ffffff'
			),
			
			array(
				'name'    => __( 'Footer Widget Areas', 'cmb2-example-theme' ),
				'id'      => 'footer_widget_areas',
				'type'    => 'radio',
				'default' => 'two',
				'options' => array(
					0 => __( 'None', 'cmb2-example-theme' ),
					1 => __( 'One', 'cmb2-example-theme' ),
					2 => __( 'Two', 'cmb2-example-theme' ),
					3 => __( 'Three', 'cmb2-example-theme' ),
					4 => __( 'Four', 'cmb2-example-theme' ),
				)
			),
			array(
				'name' => 'Global fullwith pages',
				'desc' => 'Check this box if you want the website to have a Full Width Container. Please make sure you enable Fullwidth Header in Header Options as well. ',
				'id'   => 'full_container_chk',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Enable Breadcrumbs',
				'desc' => 'Check this box if you want breadcrumbs to appear',
				'id'   => 'bread_chk',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Disable Page Header?',
				'desc' => 'Check this box if you would like to remove the Page Title from the top of each page.',
				'id'   => 'page_header_chk',
				'type' => 'checkbox',
			),
			
			
			
			array(
				'name' => 'E-Commerce Options',
				//'desc' => 'Please fill out the fields below to tell us how you want the header formatted.',
				'type' => 'title',
				'id'   => 'ecommerce_options'
			),
			array(
				'name' => 'WooCommerce Theme?',
				'desc' => 'Check this box if you will be selling products using woocommerce',
				'id'   => 'woo_chk',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Disable Shop Link?',
				'desc' => 'Check this box if you want to disable the shop link in the header',
				'id'   => 'shop_link_chk',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Disable User Menu?',
				'desc' => 'Check this box if you want to disable the user menu',
				'id'   => 'user_menu_chk',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Disable Cart Menu?',
				'desc' => 'Check this box if you want to disable cart menu',
				'id'   => 'cart_menu_chk',
				'type' => 'checkbox',
			),
			
			
			// TOP HEADER OPTIONS
			array(
				'name' => 'Top Bar Options',
				//'desc' => 'Please fill out the fields below to tell us how you want the header formatted.',
				'type' => 'title',
				'id'   => 'top_header_title'
			),
			array(
				'name' => 'Top Bar Checkbox',
				'desc' => 'Check this box to enable Top Bar',
				'id'   => 'top_header_chk',
				'type' => 'checkbox',
			),
			array(
				'name'    => __( 'Top Bar Background Color', 'cmb2-example-theme' ),
				'id'      => 'top_bar_bkg_color',
				'type'    => 'rgba_colorpicker',
				//'default' => 'rgba(0,0,0,0)'
			),
			array(
				'name'    => __( 'Top Bar Font Color', 'cmb2-example-theme' ),
				'id'      => 'top_bar_font_color',
				'type'    => 'rgba_colorpicker',
				//'default' => 'rgba(0,0,0,0)'
			),
			array(
				'name' => __( 'Left Area Content', 'cmb2' ),
				'desc' => __( 'Phone number or email in top bar on left.', 'cmb2' ),
				'default' => '<a href="tel:555-555-5555" class="phone">(555) 555-5555</a> <a href="mailto:user@domain.com" class="mail">user@domain.com</a>',
				'id'   => 'toparea_code',
				'type' => 'textarea_code',
			),
			array(
				'name' => 'Social Icons enable',
				'desc' => 'Check this box if you want social menu to show up on right hand side of Top bar',
				'id'   => 'top_social_chk',
				'type' => 'checkbox',
			),
			
		
			// GENERAL HEADER OPTIONS
			array(
				'name' => 'General Header Options',
				//'desc' => 'Please fill out the fields below to tell us how you want the header formatted.',
				'type' => 'title',
				'id'   => 'header_title'
			),
			array(
				'name'             => 'Header Select',
				'desc'             => '<strong>Choose between:<br>
										   1.) Header one - Logo Above Navbar, Navbar opaque, MegaMenu, and social media menu.(IDEAL for large menu systems because of its MEGAMENU)<br>
										   2.) Header two - Logo Inside (left) Navbar, transparent navigation, and with social media menu (good for small logos and simple design)<br>
										   3.) Header three - Fixed Fullwidth Fancy Header, transparent navigation, sidebar mobile nav (not good for a lot of menu items), special page options for small or large header.<br>
										   4.) Header four - Bottom Sticky Fullwidth Fancy Header, transparent navigation, sidebar mobile nav (not good for a lot of menu items)<br>
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
				),
			),
			array(
				'name' => 'Header Fullwidth',
				'desc' => 'Check this box to make the header fullwidth',
				'id'   => 'header_container',
				'type' => 'checkbox',
			),
			array(
				'name'    => __( 'Mobile Hamberger Menu Color', 'cmb2-example-theme' ),
				'id'      => 'mobile_toggle_color',
				'type'    => 'colorpicker',
				//'default' => 'rgba(0,0,0,0)'
			),
			array(
				'name'    => __( 'Header Bkg Color', 'cmb2-example-theme' ),
				'id'      => 'header_bkg_color',
				'type'    => 'rgba_colorpicker',
				'desc' => 'This is for the entire background of the header.',
				//'default' => 'rgba(0,0,0,0)'
			),
		
			// HEADER ONE
			array(
				'name' => 'Header One Options',
				//'desc' => 'Please fill out the fields below to tell us how you want the header formatted.',
				'type' => 'title',
				'id'   => 'header_one_title'
			),
			array(
				'name' => 'Center Logo',
				'desc' => 'Check this box to make the logo centered',
				'id'   => 'logo_centered',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Social Icons enable',
				'desc' => 'Check this if you want the social icons to appear in the regular menu navbar.',
				'id'   => 'nav_social_chk',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Fixed Nav Checkbox',
				'desc' => 'Check this box to make the the header fixed. ',
				'id'   => 'header_one_fixed_checkbox',
				'type' => 'checkbox',
			),
			
			// HEADER TWO
			array(
				'name' => 'Header Two Options',
				//'desc' => 'Please fill out the fields below to tell us how you want the header formatted.',
				'type' => 'title',
				'id'   => 'header_two_title'
			),
			array(
				'name' => 'Checkbox 2',
				//'desc' => 'Check this box to make the logo centered',
				'id'   => 'header_two_checkbox',
				'type' => 'checkbox',
			), 
			// HEADER THREE
			array(
				'name' => 'Header Three Options',
				//'desc' => 'Please fill out the fields below to tell us how you want the header formatted.',
				'type' => 'title',
				'id'   => 'header_three_title'
			),
			array(
				'name' => 'Right align nav menu',
				'desc' => 'Check this box to make the navigation items float right',
				'id'   => 'header_three_right_checkbox',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Disable fixed header',
				'desc' => 'Check this box to make the navigation no longer remain fixed at the top.',
				'id'   => 'header_three_disable_fixed_checkbox',
				'type' => 'checkbox',
			),
			array(
				'name'    => __( 'Spacer Background Color', 'cmb2-example-theme' ),
				'desc' => 'This shows by dfault when short or large header is not selected.',
				'id'      => 'header_three_bg_color',
				'type'    => 'rgba_colorpicker',
				//'default' => 'rgba(0,0,0,0)'
			),
			array(
				'name'    => __( 'Mobile Background Color', 'cmb2-example-theme' ),
				'id'      => 'header_three_mobile_bg_color',
				'type'    => 'rgba_colorpicker',
				'desc' => 'This is the background of the sidebar nav on mobile.',
				//'default' => 'rgba(0,0,0,0)'
			),
			array(
				'name'    => __( 'Scroll Bkg Color', 'cmb2-example-theme' ),
				'id'      => 'header_three_scroll_bg_color',
				'type'    => 'rgba_colorpicker',
				'desc' => 'The color of the background after the user has scrolled down 200 pixels.',
				//'default' => 'rgba(0,0,0,0)'
			),
			array(
				'name'    => __( 'Scroll Nav Item Color', 'cmb2-example-theme' ),
				'id'      => 'header_three_scroll_item_color',
				'type'    => 'rgba_colorpicker',
				//'default' => 'rgba(0,0,0,0)'
			),
			
			// HEADER FOUR
			array(
				'name' => 'Header Four Options',
				//'desc' => 'Please fill out the fields below to tell us how you want the header formatted.',
				'type' => 'title',
				'id'   => 'header_four_title'
			),
			array(
				'name' => 'Checkbox 4',
				//'desc' => 'Check this box to make the logo centered',
				'id'   => 'header_four_checkbox',
				'type' => 'checkbox',
			), 
			
			
			// NAVIGATION OPTIONS
			array(
				'name' => 'Navigation Options',
				//'desc' => 'Make sure you have CMB2 RGBa Colorpicker plugin installed.',
				'type' => 'title',
				'id'   => 'nav_title'
			),
			array(
				'name'    => __( 'Nav Background Color', 'cmb2-example-theme' ),
				'desc' => 'Make sure you have CMB2 RGBa Colorpicker plugin installed.',
				'id'      => 'nav_bg_color',
				'type'    => 'rgba_colorpicker',
				//'default' => 'rgba(0,0,0,0)'
			),
			array(
				'name'    => __( 'Nav Item color', 'cmb2-example-theme' ),
				'id'      => 'nav_item_color',
				'type'    => 'colorpicker',
				//'default' => '#dedede'
			),
			array(
				'name'    => __( 'Sub-Menu Background Color', 'cmb2-example-theme' ),
				'id'      => 'sub_nav_bg_color',
				'type'    => 'rgba_colorpicker',
				//'default' => 'rgba(0,0,0,0)'
			),
			array(
				'name'    => __( 'Sub-Menu Item color', 'cmb2-example-theme' ),
				'id'      => 'sub_nav_item_color',
				'type'    => 'colorpicker',
				//'default' => '#dedede'
			),
			array(
				'name'    => __( 'Hover Background color', 'cmb2-example-theme' ),
				'id'      => 'hover_bg_color',
				'type'    => 'colorpicker',
				//'default' => '#dedede'
			),
			array(
				'name'    => __( 'Current Menu Item color', 'cmb2-example-theme' ),
				'id'      => 'current_item_color',
				'type'    => 'colorpicker',
				//'default' => 'blue'
			),
			
			// FOOTER
			array(
				'name' => 'Footer Options',
				//'desc' => 'Please fill out the fields below to tell us how you want the header formatted.',
				'type' => 'title',
				'id'   => 'footer_title'
			),
			array(
				'name' => 'Remove top border',
				//'desc' => 'Check this box to make the logo centered',
				'id'   => 'footer_hr_checkbox',
				'type' => 'checkbox',
			),
			array(
				'name'    => __( 'Footer Bkg color', 'cmb2-example-theme' ),
				'id'      => 'footer_bkg_color',
				'type'    => 'rgba_colorpicker',
				//'default' => 'blue'
			),
			array(
				'name'    => __( 'Bottom Footer Background color', 'cmb2-example-theme' ),
				'id'      => 'bottom_footer_bg_color',
				'type'    => 'rgba_colorpicker',
				//'default' => 'blue'
			),
			array(
				'name' => 'Fullwidth Bottom Bar',
				//'desc' => 'Check this box to make the logo centered',
				'id'   => 'footer_fullwidth_checkbox',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Custom Footer Copywrite',
				//'desc' => 'field description (optional)',
				//'default' => '.selector { property: attribute; }',
				'id' => 'footer_copy_textareacode',
				'type' => 'textarea_code'
			),
			
			
			
			// ADDITIONAL
			array(
				'name' => 'Additional Options',
				//'desc' => 'Please fill out the fields below to tell us how you want the header formatted.',
				'type' => 'title',
				'id'   => 'additional_title'
			),
			array(
				'name' => 'Custom CSS Code',
				//'desc' => 'field description (optional)',
				'default' => '.selector { property: attribute; }',
				'id' => 'custom_css_textareacode',
				'type' => 'textarea_code'
			),
			array(
				'name' => 'Bottom Custom Code',
				'desc' => 'This will show up right before the footer widgets under the content.',
				//'default' => '.selector { property: attribute; }',
				'id' => 'custom_bottom_textareacode',
				'type' => 'textarea_code'
			)
			
			
			
			
		) );
	}

	/**
	 * Initiate our hooks
	 * @since 0.1.0
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
	}

	/**
	 * Register our setting to WP
	 * @since  1.0
	 */
	public function init() {
		register_setting( $this->key, $this->key );
	}

	/**
	 * Add menu options page
	 * @since 0.1.0
	 */
	public function add_options_page() {
		$this->options_page = add_theme_page( $this->title, $this->title, 'manage_options', $this->key, array( $this, 'admin_page_display' ) );
	}

	/**
	 * Admin page markup. Mostly handled by CMB2
	 * @since  1.0
	 */
	public function admin_page_display() {
		?>
		<div class="wrap pegasus_theme_options_page <?php echo $this->key; ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<strong>It is recommended you install these plugins:</strong>
			<ul>
				<li>1.) CMB2 RGBa Colorpicker - <a href="https://github.com/JayWood/CMB2_RGBa_Picker" target="_blank">Link</a></li>
				<li>2.) Page Builder by SiteOrigin - <a href="https://wordpress.org/plugins/siteorigin-panels/" target="_blank">Link</a></li>
				<li>3.) SiteOrigin Widgets Bundle - <a href="https://wordpress.org/plugins/so-widgets-bundle/" target="_blank">Link</a></li>
				<li>4.) Octane Booster - This can be provided by <a href="https://theoctaneagency.com" target="_blank">Link</a></li>
			</ul>
			<p><i><strong>NOTE:</strong> <b>If you cannot select a color</b> make sure you have the RGBa plugin installed. It is #1 above.</i></p>
			<?php cmb2_metabox_form( $this->option_metabox(), $this->key ); ?>
		</div>
		<?php
	}

	/**
	 * Defines the theme option metabox and field configuration
	 * @since  1.0
	 * @return array
	 */
	public function option_metabox() {
		return array(
			'id'         => 'option_metabox',
			'show_on'    => array( 'key' => 'options-page', 'value' => array( $this->key, ), ),
			'show_names' => true,
			'fields'     => $this->fields,
		);
	}

	/**
	 * Public getter method for retrieving protected/private variables
	 * @since  1.0
	 * @param  string  $field Field to retrieve
	 * @return mixed          Field value or exception is thrown
	 */
	public function __get( $field ) {
		// Allowed fields to retrieve
		if ( in_array( $field, array( 'key', 'fields', 'title', 'options_page' ), true ) ) {
			return $this->{$field};
		}

		if ( 'option_metabox' === $field ) {
			return $this->option_metabox();
		}

		throw new Exception( 'Invalid property: ' . $field );
	}

}

$pegasus_theme_options = new Pegasus_Theme_Options();
$pegasus_theme_options->hooks();

/**
 * Wrapper function around cmb2_get_option
 * @since  1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function pegasus_theme_get_option( $key = '' ) {
	global $pegasus_theme_options;

	if( function_exists( 'cmb2_get_option' ) ) {
		return cmb2_get_option( $pegasus_theme_options->key, $key );
	} else {
		$options = get_option( $pegasus_theme_options->key );
		return isset( $options[ $key ] ) ? $options[ $key ] : false;
	}

}