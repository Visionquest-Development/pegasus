<?php
	/* ===============================================================================================
	============================ CUSTOM POST TYPE  ==================================================
	================================================================================================*/
	add_action( 'init', 'pegasus_cpt_init' );
	function pegasus_cpt_init() {

		$cpt_portfolio = ( 'on' === pegasus_get_option( 'cpt_portfolio_checkbox' ) ) ? true : false;
		if ( true === $cpt_portfolio ) {
			/*============================
			======= Portfolio Post Type ========
			============================*/

			$portfolio_labels = array(
				'name' => _x('Portfolios', 'post type general name', 'pegasus-bootstrap'),
				'singular_name' => _x('Portfolio', 'post type singular name', 'pegasus-bootstrap'),
				'add_new' => _x('Add New', 'portfolio', 'pegasus-bootstrap'),
				'add_new_item' => __('Add New Portfolio', 'pegasus-bootstrap'),
				'edit_item' => __('Edit Portfolio', 'pegasus-bootstrap'),
				'new_item' => __('New Portfolio', 'pegasus-bootstrap'),
				'view_item' => __('View Portfolio', 'pegasus-bootstrap'),
				'search_items' => __('Search Portfolio', 'pegasus-bootstrap'),
				'not_found' =>  __('No portfolio found', 'pegasus-bootstrap'),
				'not_found_in_trash' => __('No portfolio found in Trash', 'pegasus-bootstrap'),
				'parent_item_colon' => '',
				'menu_name' => 'Pegasus Portfolio'
			);

			// Some arguments and in the last line 'supports', we say to WordPress what features are supported on the Project post type
			$portfolio_args = array(
				'labels' => $portfolio_labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'query_var' => true,
				'rewrite' => true,
				/* this is important to make it so that page-portfolio.php will show when used */
				'capability_type' => 'post',
				'can_export' => true,
				 /* make sure has_archive is turned off if you plan on using page-portfolio.php */
				'has_archive' => false,
				'hierarchical' => true,
				'menu_position' => null,
				/* include this line to use global categories */
				//'taxonomies' => array('category'),
				'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields','page-attributes')
			);

			// We call this function to register the custom post type
			register_post_type( 'pegasus_portfolio', $portfolio_args);

			/*============================
			======= Portfolio Taxonomy ========
			============================*/

			// Initialize Taxonomy Labels
			$tags_labels = array(
				'name' => _x( 'Tags', 'taxonomy general name', 'pegasus-bootstrap' ),
				'singular_name' => _x( 'Tag', 'taxonomy singular name' , 'pegasus-bootstrap'),
				'search_items' =>  __( 'Search Types' , 'pegasus-bootstrap'),
				'all_items' => __( 'All Tags' , 'pegasus-bootstrap'),
				'parent_item' => __( 'Parent Tags', 'pegasus-bootstrap' ),
				'parent_item_colon' => __( 'Parent Tags:' , 'pegasus-bootstrap'),
				'edit_item' => __( 'Edit Tags', 'pegasus-bootstrap' ),
				'update_item' => __( 'Update Tags' , 'pegasus-bootstrap'),
				'add_new_item' => __( 'Add New Tags', 'pegasus-bootstrap' ),
				'new_item_name' => __( 'New Tags Name' , 'pegasus-bootstrap'),
			);

			$cats_labels = array(
				'name' => _x( 'Categories', 'taxonomy general name', 'pegasus-bootstrap' ),
				'singular_name' => _x( 'Cat', 'taxonomy singular name' , 'pegasus-bootstrap'),
				'search_items' =>  __( 'Search Types' , 'pegasus-bootstrap'),
				'all_items' => __( 'All Cats' , 'pegasus-bootstrap'),
				'parent_item' => __( 'Parent Cats', 'pegasus-bootstrap' ),
				'parent_item_colon' => __( 'Parent Cats:' , 'pegasus-bootstrap'),
				'edit_item' => __( 'Edit Cats', 'pegasus-bootstrap' ),
				'update_item' => __( 'Update Cats' , 'pegasus-bootstrap'),
				'add_new_item' => __( 'Add New Cats', 'pegasus-bootstrap' ),
				'new_item_name' => __( 'New Cats Name' , 'pegasus-bootstrap'),
			);

			// Register Custom Taxonomy - Tags
			register_taxonomy('tagportfolio',array('portfolio'), array(
				'hierarchical' => false, // define whether to use a system like tags or categories
				'labels' => $tags_labels,
				'show_ui' => true,
				'show_admin_column'     => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'tag-portfolio' ),
			));

			// Register Custom Taxonomy - Category
			register_taxonomy('catportfolio',array('portfolio'), array(
				'hierarchical' => true, // define whether to use a system like tags or categories
				'labels' => $cats_labels,
				'show_ui' => true,
				'show_admin_column'     => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'cat-portfolio' ),
			));
		}

		$cpt_staff = ( 'on' === pegasus_get_option( 'cpt_staff_checkbox' ) ) ? true : false;
		if ( true === $cpt_staff ) {
			/*============================
			========= Staff Post Type ========
			============================*/

			$staff_labels = array(
				'name' => _x('Staff', 'post type general name', 'pegasus-bootstrap'),
				'singular_name' => _x('Staff', 'post type singular name', 'pegasus-bootstrap'),
				'add_new' => _x('Add New', 'staff', 'pegasus-bootstrap'),
				'add_new_item' => __('Add New Staff', 'pegasus-bootstrap'),
				'edit_item' => __('Edit Staff', 'pegasus-bootstrap'),
				'new_item' => __('New Staff', 'pegasus-bootstrap'),
				'view_item' => __('View Staff', 'pegasus-bootstrap'),
				'search_items' => __('Search Staff', 'pegasus-bootstrap'),
				'not_found' =>  __('No staff found', 'pegasus-bootstrap'),
				'not_found_in_trash' => __('No staff found in Trash', 'pegasus-bootstrap'),
				'parent_item_colon' => '',
				'menu_name' => 'Pegasus Staff'
			);

			// Some arguments and in the last line 'supports', we say to WordPress what features are supported on the Project post type
			$staff_args = array(
				'labels' => $staff_labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'query_var' => true,
				'rewrite' => true,
				/* this is important to make it so that page-portfolio.php will show when used */
				'capability_type' => 'post',
				'can_export' => true,
				 /* make sure has_archive is turned off if you plan on using page-portfolio.php */
				'has_archive' => false,
				'hierarchical' => false,
				'menu_position' => null,
				/* include this line to use global categories */
				//'taxonomies' => array('category'),
				'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields','page-attributes')
			);

			// We call this function to register the custom post type
			register_post_type( 'pegasus_staff', $staff_args);

			// Register Custom Taxonomy - Categories
			register_taxonomy('department',array('staff'), array(
				'hierarchical' => true, // define whether to use a system like tags or categories
				'labels' => $cats_labels,
				'show_ui' => true,
				'show_admin_column'     => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'department' ),
			));
		}

		$cpt_testimonial = ( 'on' === pegasus_get_option( 'cpt_testimonial_checkbox' ) ) ? true : false;
		if ( true === $cpt_testimonial ) {
			/*================================
			========Testimonial Post Type ========
			================================*/

			$review_labels = array(
				'name' => _x('Testimonials', 'post type general name', 'pegasus-bootstrap'),
				'singular_name' => _x('Testimonials', 'post type singular name', 'pegasus-bootstrap'),
				'add_new' => _x('Add New', 'testimonial', 'pegasus-bootstrap'),
				'add_new_item' => __('Add New Testimonials', 'pegasus-bootstrap'),
				'edit_item' => __('Edit Testimonial', 'pegasus-bootstrap'),
				'new_item' => __('New Testimonial', 'pegasus-bootstrap'),
				'view_item' => __('View Testimonials', 'pegasus-bootstrap'),
				'search_items' => __('Search Testimonials', 'pegasus-bootstrap'),
				'not_found' =>  __('No testimonial found', 'pegasus-bootstrap'),
				'not_found_in_trash' => __('No testimonial found in Trash', 'pegasus-bootstrap'),
				'parent_item_colon' => '',
				'menu_name' => 'Pegasus Testimonial'
			);

			// Some arguments and in the last line 'supports', we say to WordPress what features are supported on the Project post type
			$review_args = array(
				'labels' => $review_labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'query_var' => true,
				'rewrite' => true,
				/* this is important to make it so that page-portfolio.php will show when used */
				'capability_type' => 'post',
				'can_export' => true,
				 /* make sure has_archive is turned off if you plan on using page-portfolio.php */
				'has_archive' => false,
				'hierarchical' => false,
				'menu_position' => null,
				/* include this line to use global categories */
				//'taxonomies' => array('category'),
				'supports' => array( 'title' )
			);

			// We call this function to register the custom post type
			register_post_type( 'pegasus_testimonial', $review_args);

			remove_post_type_support( 'pegasus_testimonial', 'editor', 'permalink', 'comments', 'thumbnail', 'custom-fields', 'author', 'excerpt', 'trackbacks', 'page-attributes' );

			function remove_yoast_metabox_testimonial(){
				remove_meta_box( 'wpseo_meta', 'pegasus_testimonial', 'normal' );
			}
			add_action( 'add_meta_boxes', 'remove_yoast_metabox_testimonial', 11 );

			add_action( 'cmb2_admin_init', 'pegasus_testimonial_metabox' );

			function pegasus_testimonial_metabox() {
				$prefix = 'pegasus_testimonial_';

				$testimonial_metabox = new_cmb2_box(
					array(
						'id'           => $prefix . 'content',
						'title'        => __( 'Testimonial Slider Slides', 'pegasus-bootstrap' ),
						'object_types' => array( 'pegasus_testimonial' ),
						'priority'     => 'high',
					)
				);

				$testimonial_group_fields = $testimonial_metabox->add_field(
					array(
						'id'         => $prefix . 'slides',
						'type'       => 'group',
						'repeatable' => true,
						'options'    => array(
							'group_title'   => 'Slide #{#}',
							'add_button'    => 'Add Another Slide',
							'remove_button' => 'Remove Slide',
							'sortable'      => true,
							'closed'        => true, // true to have the groups closed by default
						),

					)
				);

				$testimonial_metabox->add_group_field(
					$testimonial_group_fields, array(
						'name'             => 'Title',
						'id'               => $prefix . 'title',
						'type'             => 'text',
						'allow_custom_url' => true,
					)
				);

				$testimonial_metabox->add_group_field(
					$testimonial_group_fields, array(
						'name'             => 'Link',
						'id'               => $prefix . 'link',
						'type'             => 'text',
						'allow_custom_url' => true,
					)
				);

				$testimonial_metabox->add_group_field(
					$testimonial_group_fields, array(
						'name' => 'Slide Image',
						'id'   => $prefix . 'slide_image',
						'type' => 'file',
					)
				);

				$testimonial_metabox->add_group_field(
					$testimonial_group_fields, array(
						'name'              => 'Alt Text',
						'id'                => $prefix . 'alt_text',
						'type'              => 'text',
					)
				);

				$testimonial_metabox->add_group_field(
					$testimonial_group_fields, array(
						'name'              => 'Caption',
						'id'                => $prefix . 'caption',
						'type'              => 'text',
					)
				);

			} //end testimonial cmb2 function



			//Make new custom column
			add_filter('manage_pegasus_testimonial_posts_columns', 'pegasus_testimonial_posts_columns_id', 5);
			function pegasus_testimonial_posts_columns_id( $defaults ){
				$defaults['pegasus_shortcode_id'] = __('Shortcode');
				return $defaults;
			}

			//add content to new custom column
			add_action('manage_pegasus_testimonial_posts_custom_column', 'pegasus_testimonial_posts_custom_id_columns', 5, 2);
			function pegasus_testimonial_posts_custom_id_columns( $column, $post_id ){
				switch ( $column ) {
					case 'pegasus_shortcode_id' :
						//echo '<pre><code>[pegasus_logo_slider id="' . $post_id . '" ]</code></pre>'; // the data that is displayed in the column
						echo '<input
					type="text"
					readonly
					value="' . esc_html('[pegasus_testimonial_slider id="' . $post_id . '"]') . '"
					class="regular-text code"
					id="my-shortcode"
					onClick="this.select();"
				>';
						break;
				}
			}

			//make custom column sortable
			add_filter( 'manage_edit-pegasus_testimonial_sortable_columns', 'pegasus_testimonial_add_custom_column_make_sortable' );
			function pegasus_testimonial_add_custom_column_make_sortable( $columns ) {
				$columns['usefulness'] = 'usefulness';

				return $columns;
			}

			// Add custom column sort request to post list page
			add_action( 'load-edit.php', 'pegasus_testimonial_add_custom_column_sort_request' );
			function pegasus_testimonial_add_custom_column_sort_request() {
				add_filter( 'request', 'pegasus_testimonial_add_custom_column_do_sortable' );
			}

			// Handle the custom column sorting
			function pegasus_testimonial_add_custom_column_do_sortable( $vars ) {

				// check if post type is being viewed -- replace ht_kb with your CPT slug
				if ( isset( $vars['post_type'] ) && 'ht_kb' == $vars['post_type'] ) {

					// check if sorting has been applied
					if ( isset( $vars['orderby'] ) && 'usefulness' == $vars['orderby'] ) {

						// apply the sorting to the post list
						$vars = array_merge(
							$vars,
							array(
								'meta_key' => '_ht_kb_usefulness',
								'orderby' => 'meta_value_num'
							)
						);
					}
				}

				return $vars;
			}
		}

		$cpt_logo_slider = ( 'on' === pegasus_get_option( 'cpt_logo_slider_checkbox' ) ) ? true : false;
		if ( true === $cpt_logo_slider ) {
			/*============================
			======= Logo Slider Post Type ========
			============================*/

			$logo_slider_labels = array(
				'name' => _x('Logos', 'logo slider general name', 'pegasus-bootstrap'),
				'singular_name' => _x('Logo', 'logo slider singular name', 'pegasus-bootstrap'),
				'add_new' => _x('Add New', 'logo', 'pegasus-bootstrap'),
				'add_new_item' => __('Add New Slider', 'pegasus-bootstrap'),
				'edit_item' => __('Edit Logo', 'pegasus-bootstrap'),
				'new_item' => __('New Logo', 'pegasus-bootstrap'),
				'view_item' => __('View Logo', 'pegasus-bootstrap'),
				'search_items' => __('Search Logo', 'pegasus-bootstrap'),
				'not_found' =>  __('No logo found', 'pegasus-bootstrap'),
				'not_found_in_trash' => __('No logo found in Trash', 'pegasus-bootstrap'),
				'parent_item_colon' => '',
				'menu_name' => 'Pegasus Logo Slider'
			);

			// Some arguments and in the last line 'supports', we say to WordPress what features are supported on the Project post type
			$logo_slider_args = array(
				'labels' => $logo_slider_labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'query_var' => true,
				'rewrite' => true,
				/* this is important to make it so that page-portfolio.php will show when used */
				'capability_type' => 'post',
				'can_export' => true,
				 /* make sure has_archive is turned off if you plan on using page-portfolio.php */
				'has_archive' => false,
				'hierarchical' => true,
				'menu_position' => null,
				/* include this line to use global categories */
				//'taxonomies' => array('category'),
				'supports' => array( 'title' )
			);

			// We call this function to register the custom post type
			register_post_type( 'pegasus_logo_slider', $logo_slider_args);

			remove_post_type_support( 'pegasus_logo_slider', 'editor', 'permalink', 'comments', 'thumbnail', 'custom-fields', 'author', 'excerpt', 'trackbacks' );

			function remove_yoast_metabox_logo_slider(){
				remove_meta_box( 'wpseo_meta', 'pegasus_logo_slider', 'normal' );
			}
			add_action( 'add_meta_boxes', 'remove_yoast_metabox_logo_slider', 11 );

			add_action( 'cmb2_admin_init', 'pegasus_logo_slider_metabox' );

			function pegasus_logo_slider_metabox() {
				$prefix = 'pegasus_logo_slider_';

				$logo_slider_metabox = new_cmb2_box(
					array(
						'id'           => $prefix . 'content',
						'title'        => __( 'Logo Slider Slides', 'pegasus-bootstrap' ),
						'object_types' => array( 'pegasus_logo_slider' ),
						'priority'     => 'high',
					)
				);

				$logo_slider_group_fields = $logo_slider_metabox->add_field(
					array(
						'id'         => $prefix . 'slides',
						'type'       => 'group',
						'repeatable' => true,
						'options'    => array(
							'group_title'   => 'Slide #{#}',
							'add_button'    => 'Add Another Slide',
							'remove_button' => 'Remove Slide',
							'sortable'      => true,
							'closed'        => true, // true to have the groups closed by default
						),

					)
				);

				$logo_slider_metabox->add_group_field(
					$logo_slider_group_fields, array(
						'name'             => 'Title',
						'id'               => $prefix . 'title',
						'type'             => 'text',
						'allow_custom_url' => true,
					)
				);

				$logo_slider_metabox->add_group_field(
					$logo_slider_group_fields, array(
						'name'             => 'Link',
						'id'               => $prefix . 'link',
						'type'             => 'text',
						'allow_custom_url' => true,
					)
				);

				$logo_slider_metabox->add_group_field(
					$logo_slider_group_fields, array(
						'name' => 'Slide Image',
						'id'   => $prefix . 'slide_image',
						'type' => 'file',
					)
				);

				$logo_slider_metabox->add_group_field(
					$logo_slider_group_fields, array(
						'name'              => 'Alt Text',
						'id'                => $prefix . 'alt_text',
						'type'              => 'text',
					)
				);

				$logo_slider_metabox->add_group_field(
					$logo_slider_group_fields, array(
						'name'              => 'Caption',
						'id'                => $prefix . 'caption',
						'type'              => 'text',
					)
				);

			} //end logo slider cmb2 function

			//Make new custom column
			add_filter('manage_pegasus_logo_slider_posts_columns', 'posts_columns_id', 5);
			function posts_columns_id( $defaults ){
				$defaults['pegasus_shortcode_id'] = __('Shortcode');
				return $defaults;
			}

			//add content to new custom column
			add_action('manage_pegasus_logo_slider_posts_custom_column', 'posts_custom_id_columns', 5, 2);
			function posts_custom_id_columns( $column, $post_id ){
				switch ( $column ) {
					case 'pegasus_shortcode_id' :
						//echo '<pre><code>[pegasus_logo_slider id="' . $post_id . '" ]</code></pre>'; // the data that is displayed in the column
						echo '<input
					type="text"
					readonly
					value="' . esc_html('[pegasus_logo_slider id="' . $post_id . '"]') . '"
					class="regular-text code"
					id="my-shortcode"
					onClick="this.select();"
				>';
						break;
				}
			}

			//make custom column sortable
			add_filter( 'manage_edit-pegasus_logo_slider_sortable_columns', 'itsg_add_custom_column_make_sortable' );
			function itsg_add_custom_column_make_sortable( $columns ) {
				$columns['usefulness'] = 'usefulness';

				return $columns;
			}

			// Add custom column sort request to post list page
			add_action( 'load-edit.php', 'itsg_add_custom_column_sort_request' );
			function itsg_add_custom_column_sort_request() {
				add_filter( 'request', 'itsg_add_custom_column_do_sortable' );
			}

			// Handle the custom column sorting
			function itsg_add_custom_column_do_sortable( $vars ) {

				// check if post type is being viewed -- replace ht_kb with your CPT slug
				if ( isset( $vars['post_type'] ) && 'ht_kb' == $vars['post_type'] ) {

					// check if sorting has been applied
					if ( isset( $vars['orderby'] ) && 'usefulness' == $vars['orderby'] ) {

						// apply the sorting to the post list
						$vars = array_merge(
							$vars,
							array(
								'meta_key' => '_ht_kb_usefulness',
								'orderby' => 'meta_value_num'
							)
						);
					}
				}

				return $vars;
			}

		} //end logo slider


	} //cpt init




	function pegasus_rewrite_flush() {
		flush_rewrite_rules();
	}
	add_action( 'after_switch_theme', 'pegasus_rewrite_flush' );

	/* fixes permalinks for custom post types */
	add_action('init', 'pegasus_rewrite');
	function pegasus_rewrite() {
		global $wp_rewrite;
		$wp_rewrite->add_permastruct('typename', 'typename/%year%/%postname%/', true, 1);
		add_rewrite_rule('typename/([0-9]{4})/(.+)/?$', 'index.php?typename=$matches[2]', 'top');
		$wp_rewrite->flush_rules(); // !!!
	}



	/*~~~~~~~~~~~~~~~~~~~~
		LOGO SLIDER
	~~~~~~~~~~~~~~~~~~~~~*/
	// [pegasus_logo_slider id="5" ]
	function pegasus_logo_slider_query_shortcode( $atts ) {

		$a = shortcode_atts( array(
			//"id" => ''
		), $atts );

		// Defaults
		extract(shortcode_atts(array(
			//"the_query" => '',
			"id" => ''
		), $atts));

		// de-funkify query
		//$the_query = preg_replace('~&#x0*([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $the_query);
		//$the_query = preg_replace('~&#0*([0-9]+);~e', 'chr(\\1)', $the_query);

		//$the_query = preg_replace_callback('~&#x0*([0-9a-f]+);~', function($matches){
			//return chr( dechex( $matches[1] ) );
		//}, $the_query);

		//$the_query = preg_replace_callback('~&#0*([0-9]+);~', function($matches){
			//return chr( $matches[1] );
		//}, $the_query);

		//if ( '' === $the_query || null === $the_query || empty( $the_query ) ) {
			$the_query = 'post_type=pegasus_logo_slider&p=' . $atts['id'];
		//}

		// query is made
		query_posts( $the_query );

		// Reset and setup variables
		global $post;
		$output = '';
		$temp_title = '';
		$temp_link = '';
		$temp_date = '';
		$temp_pic = '';
		$temp_content = '';
		$the_id = '';

		// the loop
		if (have_posts()) : while (have_posts()) : the_post();

			$temp_title = get_the_title($post->ID);
			$temp_link = get_permalink($post->ID);
			$temp_date = get_the_date($post->ID);
			$temp_pic = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			$temp_excerpt = wp_trim_words( get_the_excerpt(), 150 );
			$temp_content = wp_trim_words( get_the_content(), 300 );
			$the_id = get_the_ID();

			$slides = get_post_meta( $the_id, 'pegasus_logo_slider_slides', true );

			if ( ! empty( $slides ) ) {
				foreach ( (array) $slides as $key => $slide ) {
					$prefix = 'pegasus_logo_slider_';

					$slide_title = isset( $slide[$prefix . 'title'] ) ? sanitize_title( $slide[$prefix . 'title'] ) : '';
					$slide_link = isset( $slide[$prefix . 'link'] ) ? esc_url( $slide[$prefix . 'link'] ) : '';
					$slide_img_id = isset( $slide[$prefix . 'slide_image_id'] ) ? absint ( $slide[$prefix . 'slide_image_id'] ) : '';
					$slide_slide_img = isset( $slide[$prefix . 'slide_image'] ) ? esc_url( $slide[$prefix . 'slide_image'] ) : '';
					$slide_alt_text = isset( $slide[$prefix . 'alt_text'] ) ? $slide[$prefix . 'alt_text'] : '';
					$slide_caption = isset( $slide[$prefix . 'caption'] ) ? $slide[$prefix . 'caption'] : '';


					$output .= "<article class='post-$the_id' >";
					$output .= '<div class="slick-slider-item">';
					if ( $slide_link ) {
						$output .= '<a href="' . $slide_link  . '" >';
					}
						if( $slide_slide_img ) {
							$output .= '<img class="post-img-feat" src="' . $slide_slide_img . '" alt="' . $slide_alt_text . '">';
						}
						if( $slide_title ) {
							$output .= '<p class="slick-p">' . $slide_title . '</p>';
						}
						if( $slide_caption ) {
							$output .= '<p class="slick-p">' . $slide_caption . '</p>';
						}
					if ( $slide_link ) {
						$output .= '</a>';
					}
					$output .= '</div>';
					$output .= "</article>";

				} // End foreach().
			}

		endwhile; else:
			$output .= "nothing found.";
		endif;

		wp_reset_query();

		wp_enqueue_style( 'slick-css' );
		wp_enqueue_style( 'slick-theme-css' );
		wp_enqueue_script( 'slick-js' );
		wp_enqueue_script( 'match-height-js' );
		wp_enqueue_script( 'pegasus-carousel-plugin-js' );

		return '<div class="center logo-slider slider">' . $output . '</div>';

	}
	add_shortcode("pegasus_logo_slider", "pegasus_logo_slider_query_shortcode");
?>
