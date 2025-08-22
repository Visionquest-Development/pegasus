<?php

	$json_data = '{
		"pegasus-accordion/pegasus-accordions.php": {
			"title": "Accordion Usage",
			"callback": "pegasus_accordion_submenu_page"
		},
		"pegasus-blog/pegasus-blog.php": {
			"title": "Blog Usage",
			"callback": "pegasus_blog_submenu_page"
		},
		"pegasus-blurb/pegasus-blurb.php": {
			"title": "Blurb Usage",
			"callback": "pegasus_blurb_submenu_page"
		},
		"pegasus-callout/pegasus-callout.php": {
			"title": "Callout Usage",
			"callback": "pegasus_callout_submenu_page"
		},
		"pegasus-carousel/pegasus-carousel.php": {
			"title": "Carousel Usage",
			"callback": "pegasus_carousel_submenu_page"
		},
		"pegasus-circle-progress/pegasus-circle-progress.php": {
			"title": "Circle Progress Usage",
			"callback": "pegasus_circle_progress_submenu_page"
		},
		"pegasus-countup/pegasus-countup.php": {
			"title": "Countup Usage",
			"callback": "pegasus_countup_submenu_page"
		},
		"pegasus-lightbox/pegasus-lightbox.php": {
			"title": "Lightbox Usage",
			"callback": "pegasus_lightbox_submenu_page"
		},
		"pegasus-masonry/pegasus-masonry.php": {
			"title": "Masonry Usage",
			"callback": "pegasus_masonry_submenu_page"
		},
		"pegasus-navmenu/pegasus-menu.php": {
			"title": "Navmenu Usage",
			"callback": "pegasus_navmenu_submenu_page"
		},
		"pegasus-onepage/pegasus-onepage.php": {
			"title": "One Page Usage",
			"callback": "pegasus_onepage_submenu_page"
		},
		"pegasus-packery/pegasus-packery.php": {
			"title": "Packery Usage",
			"callback": "pegasus_packery_submenu_page"
		},
		"pegasus-popup/pegasus-popup.php": {
			"title": "Popup Usage",
			"callback": "pegasus_popup_submenu_page"
		},
		"pegasus-post-grid/pegasus-postgrid.php": {
			"title": "Post Grid Usage",
			"callback": "pegasus_postgrid_submenu_page"
		},
		"pegasus-posts-filter/pegasus-posts-filter.php": {
			"title": "Posts Filter Usage",
			"callback": "pegasus_posts_filter_submenu_page"
		},
		"pegasus-slider/pegasus-slider.php": {
			"title": "Slider Usage",
			"callback": "pegasus_slider_submenu_page"
		},
		"pegasus-tabs/pegasus-tabs.php": {
			"title": "Tabs Usage",
			"callback": "pegasus_tabs_submenu_page"
		},
		"pegasus-tooldrawer/pegasus-tooldrawer.php": {
			"title": "Tooldrawer Usage",
			"callback": "tooldrawer_submenu_page"
		},
		"pegasus-toggleslide/pegasus-toggleslide.php": {
			"title": "Toggleslide Usage",
			"callback": "pegasus_toggleslide_submenu_page"
		},
		"pegasus-wow/pegasus-wow.php": {
			"title": "Wow Usage",
			"callback": "pegasus_wow_submenu_page"
		}
	}';

	$plugin_submenus = json_decode($json_data, true);

	function pegasus_plugins_admin_menu() {
		global $plugin_submenus;

		add_menu_page(
			'Pegasus Plugins',  // Page title
			'Pegasus Plugins Suite',        // Menu title
			'manage_options',     // Capability required to view
			'pegasus-plugins-slug',   // Menu slug (unique identifier)
			'pegasus_plugins_menu_page', // Callback function to display page content
			'dashicons-admin-generic', // Icon URL or Dashicon class
			200                     // Position in menu
		);

		add_submenu_page(
			'pegasus-plugins-slug',   // Parent slug
			'General',      // Page title
			'Pegaus Plugins Suite',            // Menu title
			'manage_options',     // Capability required to view
			'pegasus-plugins-slug',       // Menu slug (unique identifier)
			'pegasus_plugins_menu_page' // Callback function to display page content
		);

		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}

		// Loop through the array and add submenu pages for active plugins
		foreach ( $plugin_submenus as $plugin_path => $submenu ) {
			if ( is_plugin_active( $plugin_path ) ) {
				add_submenu_page(
					'pegasus-plugins-slug',   // Parent slug
					$submenu['title'],      // Page title
					$submenu['title'],            // Menu title
					'manage_options',     // Capability required to view
					'pegasus-plugins-' . sanitize_title( $submenu['title'] ), // Menu slug (unique identifier)
					$submenu['callback'] // Callback function to display page content
				);
			}
		}
	}

	$allowed_plugins = array(
		'pegasus-accordion',
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


	function pegasus_check_for_plugin_suite($allowed_plugins) {
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}

		foreach ($allowed_plugins as $plugin_slug) {
			$plugin_path = $plugin_slug . '/' . $plugin_slug . '.php';
			if (is_plugin_active($plugin_path)) {
				return true;
			}
		}
		return false;
	}

	if (pegasus_check_for_plugin_suite($allowed_plugins)) {
		add_action('admin_menu', 'pegasus_plugins_admin_menu');
	}


	function output_shortcode_pre($shortcode, $format = 'html') {
		switch ($format) {
			case 'html':
				echo '<pre>' . esc_html($shortcode) . '</pre>';
				break;
			case 'wp':
				?>

				<div class="wrap">
					<h1>Copy Shortcode Here</h1>
					<p>Click below to select the Shortcode example and <span class="red-text">Ctrl + C</span> on your keyboard to copy:</p>
					<input
						type="text"
						readonly
						value="<?php echo esc_html($shortcode); ?>"
						class="regular-text code"
						id="my-shortcode"
						onClick="this.select();"
					>

				</div>
				<hr>
				<p>====================================================================</p>
				<hr>
				<?php
				break;
			default:
				echo '<pre>' . esc_html($shortcode) . '</pre>';
				break;
		}
	}

	function pegasus_accordion_submenu_page() {
		?>
		<div class="pegasus-wrap">
			<h1>Accordion Usage</h1>
			<?php output_shortcode_pre('[accordions][accordion class="first" title="Home"]Vivamus suscipit tortor eget felis porttitor volutpat. [/accordion][accordion class="second" title="Profile"]Pellentesque in ipsum id orci porta dapibus. [/accordion][/accordions]'); ?>
			<?php output_shortcode_pre('[accordions][accordion class="first" title="Home"]Vivamus suscipit tortor eget felis porttitor volutpat. [/accordion][accordion class="second" title="Profile"]Pellentesque in ipsum id orci porta dapibus. [/accordion][/accordions]', 'wp'); ?>
			<?php echo do_shortcode('[pegasus_settings_table plugin_slug="pegasus-accordion"]'); ?>
		</div>
		<?php
	}

	// Callback function for submenu page content for Blog Usage
	function pegasus_blog_submenu_page() {
		?>
		<div class="pegasus-wrap">
			<h1>Blog Usage</h1>
			<p>Here is some content for the Blog Usage page.</p>
			<p>Callout Usage 1:<br>
				<?php output_shortcode_pre('[blog the_query="post_type=post&order_by=date&order=ASC"]'); ?>
			</p>
			<?php output_shortcode_pre('[blog the_query="post_type=post&order_by=date&order=ASC"]', 'wp'); ?>

			<?php echo do_shortcode('[pegasus_settings_table plugin_slug="pegasus-blog"]'); ?>
		</div>
		<?php
	}

	function pegasus_blurb_submenu_page() {
		?>
		<h1>Blurb Usage</h1>
		<?php output_shortcode_pre('[blurb title="the_title" subtitle="the_subtitle" button_text="the_button_text" button_url="the_button_url" ]The content for the blurb[/blurb]'); ?>
		<?php output_shortcode_pre('[blurb title="the_title" subtitle="the_subtitle" button_text="the_button_text" button_url="the_button_url" ]The content for the blurb[/blurb]', 'wp'); ?>
		<?php echo do_shortcode('[pegasus_settings_table plugin_slug="pegasus-blurb"]'); ?>
		<?php
	}

	// Callback function for submenu page content for Callout Usage
	function pegasus_callout_submenu_page() {
		?>

		<div class="pegasus-wrap">
			<h1>Callout Usage</h1>
			<p>Here is some content for the Callout Usage page.</p>
			<p>Callout Usage 1:<br>
<?php output_shortcode_pre('
[callout
button="yes"
link="http://example.com"
color="black"
external="yes"
backgroundcolor="#dedede"]
	<h2>Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.
	Donec sollicitudin molestie malesuada.
	Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.
	Donec sollicitudin molestie malesuada. Nulla porttitor accumsan tincidunt.
	Nulla porttitor accumsan tincidunt. Praesent sapien massa,
	convallis a pellentesque nec, egestas non nisi.</h2>
[/callout]'); ?>
			</p>

			<p>Callout Usage 2:<br>
				<?php output_shortcode_pre('[callout
button="yes"
background="http://pegasustheme.com/wp-content/uploads/2016/07/quadroIdeas_0047-21.jpg"
link="http://example.com"
external="yes"
color="white"
link_text="Learn More"
]
<p>Get your copy now!Suspendisse vitae bibendum mauris. Nunc iaculis nisl vitae laoreet elementum donec dignissim metus sit.</p>
[/callout]'); ?>
				<?php //output_shortcode_pre('[callout title="the_title" subtitle="the_subtitle" button_text="the_button_text" button_url="the_button_url" ]The content for the callout[/callout]'); ?>
			</p>

			<?php output_shortcode_pre('[callout button="yes" link="http://example.com" color="black" external="yes" backgroundcolor="#dedede"] <h2>Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Donec sollicitudin molestie malesuada. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Donec sollicitudin molestie malesuada. Nulla porttitor accumsan tincidunt. Nulla porttitor accumsan tincidunt. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.</h2>[/callout]', 'wp'); ?>
			<?php //output_shortcode_pre('[callout button="yes" background="http://pegasustheme.com/wp-content/uploads/2016/07/quadroIdeas_0047-21.jpg" link="http://example.com" external="yes" color="white" link_text="Learn More" ]<p>Get your copy now!Suspendisse vitae bibendum mauris. Nunc iaculis nisl vitae laoreet elementum donec dignissim metus sit.</p>[/callout]', 'wp'); ?>

			<?php echo do_shortcode('[pegasus_settings_table plugin_slug="pegasus-callout"]'); ?>
		</div>
		<?php
	}

	function pegasus_carousel_submenu_page() {
		?>
		<div class="pegasus-wrap">
			<h1>Carousel Usage</h1>
			<?php output_shortcode_pre('[logo_slider the_query="post_type=logo_slider&showposts=100&order_by=title&order=ASC"]'); ?>
			<?php output_shortcode_pre('[logo_slider the_query="post_type=logo_slider&showposts=100&order_by=title&order=ASC"]', 'wp'); ?>

			<?php //echo do_shortcode('[pegasus_settings_table plugin_slug="pegasus-carousel"]'); ?>

			<?php output_shortcode_pre('[testimonial_slider image="circle" type="bubble" class="test" the_query="post_type=testimonial&showposts=100" ]'); ?>
			<?php output_shortcode_pre('[testimonial_slider image="circle" type="bubble" class="test" the_query="post_type=testimonial&showposts=100" ]', 'wp'); ?>

			<?php echo do_shortcode('[pegasus_settings_table plugin_slug="pegasus-carousel"]'); ?>
		</div>
		<?php
	}

	function pegasus_circle_progress_submenu_page() {
		?>
		<div class="pegasus-wrap">
			<h1>Circle Progress Usage</h1>
			<?php output_shortcode_pre('[circle_progress number="90" color="blue"]  '); ?>
			<?php output_shortcode_pre('[circle_progress number="90" color="blue"]  ', 'wp'); ?>
			<?php echo do_shortcode('[pegasus_settings_table plugin_slug="pegasus-circle-progress"]'); ?>
		</div>
		<?php
	}

	function pegasus_countup_submenu_page() {
		?>
		<div class="pegasus-wrap">
			<h1>Countup Usage</h1>
			<?php output_shortcode_pre('[counter_up container="h2" number="83"]'); ?>
			<?php output_shortcode_pre('[counter_up container="h2" number="83"]', 'wp'); ?>
			<?php echo do_shortcode('[pegasus_settings_table plugin_slug="pegasus-countup"]'); ?>
		</div>
		<?php
	}

	function pegasus_masonry_submenu_page() {
		?>
		<div class="pegasus-wrap">
			<h1>Masonry Usage</h1>
			<p>Masonry Usage 1:<br>
<?php output_shortcode_pre('
[masonry]
	<img src="http://pegasustheme.com/wp-content/uploads/2025/01/abarth.png" alt="image">
	<img src="http://pegasustheme.com/wp-content/uploads/2025/01/Acura.png" alt="image">
	<img src="http://pegasustheme.com/wp-content/uploads/2025/01/alfaromeo.png" alt="image">
	<img src="http://pegasustheme.com/wp-content/uploads/2025/01/Aston-Martin.png" alt="image">
	<img src="http://pegasustheme.com/wp-content/uploads/2025/01/Audi.png" alt="image">
	<img src="http://pegasustheme.com/wp-content/uploads/2025/01/bentley.png" alt="image">
	<img src="http://pegasustheme.com/wp-content/uploads/2025/01/BMW.png" alt="image">
	<img src="http://pegasustheme.com/wp-content/uploads/2025/01/Buick.png" alt="image">
	<img src="http://pegasustheme.com/wp-content/uploads/2025/01/Cadillac.png" alt="image">
	<img src="http://pegasustheme.com/wp-content/uploads/2025/01/Chevrolet.png" alt="image">
	<img src="http://pegasustheme.com/wp-content/uploads/2025/01/chrysler.png" alt="image">
[/masonry]
'); ?>
			</p>
			<?php output_shortcode_pre('[masonry]<img src="http://pegasustheme.com/wp-content/uploads/2025/01/abarth.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Acura.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/alfaromeo.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Aston-Martin.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Audi.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/bentley.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/BMW.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Buick.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Cadillac.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Chevrolet.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/chrysler.png" alt="image">[/masonry]'); ?>
			<?php output_shortcode_pre('[masonry]<img src="http://pegasustheme.com/wp-content/uploads/2025/01/abarth.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Acura.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/alfaromeo.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Aston-Martin.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Audi.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/bentley.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/BMW.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Buick.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Cadillac.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Chevrolet.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/chrysler.png" alt="image">[/masonry]', 'wp'); ?>
			<?php echo do_shortcode('[pegasus_settings_table plugin_slug="pegasus-masonry"]'); ?>
		</div>
		<?php
	}

	function pegasus_navmenu_submenu_page() {
		?>
		<div class="pegasus-wrap">
			<h1>Navmenu Usage</h1>
			<?php output_shortcode_pre('[menu menu="primary"]'); ?>
			<?php output_shortcode_pre('[menu menu="primary"]', 'wp'); ?>

			<?php output_shortcode_pre('[bootstrap_menu menu="primary" additional_classes="navbar-expand"]'); ?>
			<?php output_shortcode_pre('[bootstrap_menu menu="primary" additional_classes="navbar-expand"]', 'wp'); ?>
			<?php echo do_shortcode('[pegasus_settings_table plugin_slug="pegasus-navmenu"]'); ?>
		</div>
		<?php
	}

	function pegasus_onepage_submenu_page() {
		?>
		<div class="pegasus-wrap">
			<h1>One Page Usage</h1>
			<?php output_shortcode_pre('[section id="section-1" class="section-container" bkg_color="#dedede" text_color="#000000" image=""][/section]'); ?>
			<?php output_shortcode_pre('[section id="section-1" class="section-container" bkg_color="#dedede" text_color="#000000" image=""][/section]', 'wp'); ?>
			<?php echo do_shortcode('[pegasus_settings_table plugin_slug="pegasus-onepage"]'); ?>
		</div>
		<?php
	}

	function pegasus_packery_submenu_page() {
		?>
		<div class="pegasus-wrap">
			<h1>Packery Usage</h1>
			<p>Packery Usage 1:<br>
			<?php output_shortcode_pre('
[packery]
	<img src="http://pegasustheme.com/wp-content/uploads/2025/01/abarth.png" alt="image">
	<img src="http://pegasustheme.com/wp-content/uploads/2025/01/Acura.png" alt="image">
	<img src="http://pegasustheme.com/wp-content/uploads/2025/01/alfaromeo.png" alt="image">
	<img src="http://pegasustheme.com/wp-content/uploads/2025/01/Aston-Martin.png" alt="image">
	<img src="http://pegasustheme.com/wp-content/uploads/2025/01/Audi.png" alt="image">
	<img src="http://pegasustheme.com/wp-content/uploads/2025/01/bentley.png" alt="image">
	<img src="http://pegasustheme.com/wp-content/uploads/2025/01/BMW.png" alt="image">
	<img src="http://pegasustheme.com/wp-content/uploads/2025/01/Buick.png" alt="image">
	<img src="http://pegasustheme.com/wp-content/uploads/2025/01/Cadillac.png" alt="image">
	<img src="http://pegasustheme.com/wp-content/uploads/2025/01/Chevrolet.png" alt="image">
	<img src="http://pegasustheme.com/wp-content/uploads/2025/01/chrysler.png" alt="image">
[/packery]
'); ?>
			</p>
			<?php output_shortcode_pre('[packery]<img src="http://pegasustheme.com/wp-content/uploads/2025/01/abarth.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Acura.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/alfaromeo.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Aston-Martin.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Audi.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/bentley.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/BMW.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Buick.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Cadillac.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Chevrolet.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/chrysler.png" alt="image">[/packery]'); ?>
			<?php output_shortcode_pre('[packery]<img src="http://pegasustheme.com/wp-content/uploads/2025/01/abarth.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Acura.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/alfaromeo.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Aston-Martin.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Audi.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/bentley.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/BMW.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Buick.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Cadillac.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/Chevrolet.png" alt="image"><img src="http://pegasustheme.com/wp-content/uploads/2025/01/chrysler.png" alt="image">[/packery]', 'wp'); ?>
			<?php echo do_shortcode('[pegasus_settings_table plugin_slug="pegasus-packery"]'); ?>
		</div>
		<?php
	}

	function pegasus_popup_submenu_page() {
		?>
		<div class="pegasus-wrap">
			<h1>Popup Usage</h1>
			<?php output_shortcode_pre('[popup] image content goes here [/popup]'); ?>
			<?php output_shortcode_pre('[popup] image content goes here [/popup]', 'wp'); ?>
			<?php echo do_shortcode('[pegasus_settings_table plugin_slug="pegasus-popup"]'); ?>
		</div>
		<?php
	}

	function pegasus_postgrid_submenu_page() {
		?>
		<div class="pegasus-wrap">
			<h1>Post Grid Usage</h1>
			<p>Post Grid Usage 1:<br>
			<?php output_shortcode_pre('
[loop
	the_query="showposts=100&post_type=page&post_parent=453"
	bkg_color="#dedede"
]
'); ?>
			</p>
			<?php output_shortcode_pre('[loop the_query="showposts=100&post_type=page&post_parent=453" bkg_color="#dedede" ]'); ?>
			<?php output_shortcode_pre('[loop the_query="showposts=100&post_type=page&post_parent=453" bkg_color="#dedede" ]', 'wp'); ?>

			<p>Post Grid Usage 2:<br>
			<?php output_shortcode_pre('
[loop-posts
	the_query="post_type=post&showposts=100&ord=ASC&order_by=date"
	bkg_color="#dedede"
]
'); ?>
			</p>
			<?php output_shortcode_pre('[loop-posts the_query="post_type=post&showposts=100&ord=ASC&order_by=date" bkg_color="#dedede"]'); ?>
			<?php output_shortcode_pre('[loop-posts the_query="post_type=post&showposts=100&ord=ASC&order_by=date" bkg_color="#dedede"]', 'wp'); ?>

			<p>Post Grid Usage 3:<br>
			<?php output_shortcode_pre('
[loop-grid
	the_query="post_type=post&showposts=100&ord=ASC&order_by=date"
	bkg_color="#dedede"
	pagination="yes"
]
'); ?>
			</p>
			<?php output_shortcode_pre('[loop-grid the_query="post_type=post&showposts=100&ord=ASC&order_by=date" bkg_color="#dedede" pagination="yes"]'); ?>
			<?php output_shortcode_pre('[loop-grid the_query="post_type=post&showposts=100&ord=ASC&order_by=date" bkg_color="#dedede" pagination="yes"]', 'wp'); ?>

			<?php echo do_shortcode('[pegasus_settings_table plugin_slug="pegasus-post-grid"]'); ?>
		</div>
		<?php
	}

	function pegasus_posts_filter_submenu_page() {
		?>
		<div class="pegasus-wrap">
			<h1>Posts Filter Usage</h1>
			<?php output_shortcode_pre('[ajax_filter_posts per_page="1"]'); ?>
			<?php output_shortcode_pre('[ajax_filter_posts per_page="1"]', 'wp'); ?>
			<?php echo do_shortcode('[pegasus_settings_table plugin_slug="pegasus-posts-filter"]'); ?>
		</div>
		<?php
	}

	function pegasus_slider_submenu_page() {
		?>
		<div class="pegasus-wrap">
			<h1>Slider Usage</h1>
			<?php output_shortcode_pre('
[slider]
	[slide class="testing"]
		<img class="alignnone size-full wp-image-12" src="https://via.placeholder.com/960x550/" alt="Gold-and-Black-Logo">
	[/slide]
	[slide]
		<img class="alignnone size-full wp-image-12" src="https://via.placeholder.com/600x350/" alt="Gold-and-Black-Logo">
	[/slide]
[/slider]
'); ?>
			<?php output_shortcode_pre('[slider][slide class="testing"]<img class="alignnone size-full wp-image-12" src="https://via.placeholder.com/960x550/" alt="Gold-and-Black-Logo">[/slide][slide]<img class="alignnone size-full wp-image-12" src="https://via.placeholder.com/600x350/" alt="Gold-and-Black-Logo">[/slide][/slider]'); ?>
			<?php output_shortcode_pre('[slider][slide class="testing"]<img class="alignnone size-full wp-image-12" src="https://via.placeholder.com/960x550/" alt="Gold-and-Black-Logo">[/slide][slide]<img class="alignnone size-full wp-image-12" src="https://via.placeholder.com/600x350/" alt="Gold-and-Black-Logo">[/slide][/slider]', 'wp'); ?>

			<?php output_shortcode_pre('
[news_slider
the_query="showposts=100&post_type=post"
]
'); ?>

			<?php output_shortcode_pre('[news_slider the_query="showposts=100&post_type=post"]'); ?>
			<?php output_shortcode_pre('[news_slider the_query="showposts=100&post_type=post"]', 'wp'); ?>

			<?php output_shortcode_pre('
[thumb_slider]
	[thumb_slide title="slide1" number="1"]
		<img src="http://slippry.com assets/img/image-1.jpg" alt="This is caption 1">
	[/thumb_slide]
	[thumb_slide title="slide2" number="2"]
		<img src="http://slippry.com/assets/img/image-2.jpg" alt="This is caption 2">
	[/thumb_slide]
	[thumb_slide title="slide3" number="3"]
		<img src="http://slippry.com/assets/img/image-3.jpg" alt="This is caption 3">
	[/thumb_slide]
	[thumb_slide title="slide4" number="4"]
		<img src="http://slippry.com/assets/img/image-4.jpg" alt="This is caption 4">
	[/thumb_slide]
[/thumb_slider]
'); ?>
			<?php output_shortcode_pre('[thumb_slider][thumb_slide title="slide1" number="1"]<img src="http://slippry.com assets/img/image-1.jpg" alt="This is caption 1">[/thumb_slide][thumb_slide title="slide2" number="2"]<img src="http://slippry.com/assets/img/image-2.jpg" alt="This is caption 2">[/thumb_slide][thumb_slide title="slide3" number="3"]<img src="http://slippry.com/assets/img/image-3.jpg" alt="This is caption 3">[/thumb_slide][thumb_slide title="slide4" number="4"]<img src="http://slippry.com/assets/img/image-4.jpg" alt="This is caption 4">[/thumb_slide][/thumb_slider]'); ?>
			<?php output_shortcode_pre('[thumb_slider][thumb_slide title="slide1" number="1"]<img src="http://slippry.com/assets/img/image-1.jpg" alt="This is caption 1">[/thumb_slide][thumb_slide title="slide2" number="2"]<img src="http://slippry.com/assets/img/image-2.jpg" alt="This is caption 2">[/thumb_slide][thumb_slide title="slide3" number="3"]<img src="http://slippry.com/assets/img/image-3.jpg" alt="This is caption 3">[/thumb_slide][thumb_slide title="slide4" number="4"]<img src="http://slippry.com/assets/img/image-4.jpg" alt="This is caption 4">[/thumb_slide][/thumb_slider]', 'wp'); ?>

			<?php echo do_shortcode('[pegasus_settings_table plugin_slug="pegasus-slider"]'); ?>
		</div>
		<?php
	}

	function pegasus_tabs_submenu_page() {
		?>
		<div class="pegasus-wrap">
			<h1>Tabs Usage</h1>
			<?php output_shortcode_pre('
[tabs]
	[tab class="first" title="Home"]
		Vivamus suscipit tortor eget felis porttitor volutpat.
	[/tab]
	[tab class="second" title="Profile"]
		Pellentesque in ipsum id orci porta dapibus.
	[/tab]
[/tabs]
'); ?>
			<?php output_shortcode_pre('[tabs][tab class="first" title="Home"]Vivamus suscipit tortor eget felis porttitor volutpat. [/tab][tab class="second" title="Profile"]Pellentesque in ipsum id orci porta dapibus.[/tab][/tabs]'); ?>
			<?php output_shortcode_pre('[tabs][tab class="first" title="Home"]Vivamus suscipit tortor eget felis porttitor volutpat. [/tab][tab class="second" title="Profile"]Pellentesque in ipsum id orci porta dapibus.[/tab][/tabs]', 'wp'); ?>
			<?php echo do_shortcode('[pegasus_settings_table plugin_slug="pegasus-tabs"]'); ?>
		</div>
		<?php
	}

	function tooldrawer_submenu_page() {
		?>
		<div class="pegasus-wrap">
			<h1>Tooldrawer Usage</h1>
			<?php output_shortcode_pre('[tooldrawer]'); ?>
			<?php output_shortcode_pre('[tooldrawer]', 'wp'); ?>
			<?php echo do_shortcode('[pegasus_settings_table plugin_slug="pegasus-tooldrawer"]'); ?>
		</div>
		<?php
	}

	function pegasus_toggleslide_submenu_page() {
		?>
		<div class="pegasus-wrap">
			<h1>Toggleslide Usage</h1>
			<?php output_shortcode_pre('
[toggleslide
	title="the_title"
]
	The content for the toggleslide
[/toggleslide]
'); ?>
			<?php output_shortcode_pre('[toggleslide title="the_title" ]The content for the toggleslide[/toggleslide]'); ?>
			<?php output_shortcode_pre('[toggleslide title="the_title" ]The content for the toggleslide[/toggleslide]', 'wp'); ?>
			<?php echo do_shortcode('[pegasus_settings_table plugin_slug="pegasus-toggleslide"]'); ?>
		</div>
		<?php
	}

	function pegasus_wow_submenu_page() {
		?>
		<div class="pegasus-wrap">
			<h1>Wow Usage</h1>
			<?php output_shortcode_pre('[wow]wow content [/wow]'); ?>
			<?php output_shortcode_pre('[wow]wow content [/wow]', 'wp'); ?>
			<?php echo do_shortcode('[pegasus_settings_table plugin_slug="pegasus-wow"]'); ?>
		</div>
		<?php
	}


	// Callback function for menu page content
	function pegasus_plugins_menu_page() {
		global $plugin_submenus;

		echo '<h1>Welcome to the Pegasus Plugins Suite!</h1>';

		echo '<p>Here you can find information about the plugins included in the suite and how to use them.</p>';

		foreach ($plugin_submenus as $plugin_path => $submenu) {
			if (is_plugin_active($plugin_path)) {
				echo '<p><a href="' .
				admin_url('admin.php?page=' . 'pegasus-plugins-' . sanitize_title($submenu['title']))
				. '">' . $submenu['title'] . '</a></p>';
			}
		}

	}

