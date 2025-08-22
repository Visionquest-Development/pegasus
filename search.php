<?php get_header(); ?>
<div id="page-wrap">
	<?php
		//full container page options
		$post_full_container_choice = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true );
		//full container theme option
		$global_full_container_option = pegasus_get_option('full_container_chk' );

		//assign post class
		$pegasus_post_container_choice = ( 'on' === $post_full_container_choice ) ? 'container-fluid' : 'container';
		//assign global class
		$pegasus_global_container_choice = ( 'on' === $global_full_container_option ) ? 'container-fluid' : 'container' ;
		//check global first then post
		$final_container_class = ( 'container-fluid' === $pegasus_global_container_choice ) ? $pegasus_global_container_choice : $pegasus_post_container_choice;

		//left align right sidebar?
		$left_align_sidebar_chk =  pegasus_get_option( 'sidebar_left_chk' ) ? pegasus_get_option( 'sidebar_left_chk' ) : 'off';
		//enable both sidebars?
		$pegasus_left_sidebar_option = ( 'on' === pegasus_get_option( 'both_sidebar_chk' ) ) ? pegasus_get_option( 'both_sidebar_chk' ) : 'off';
		//change content class if both sidebars
		$page_body_content_class = ( 'on' === $pegasus_left_sidebar_option  ) ? 'col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xg-6' : 'col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xg-9';

		//page header page options
		$post_disable_page_header_choice = get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) ? get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) : 'off';
		//page header theme option
		$global_disable_page_header_option =  pegasus_get_option('page_header_chk' ) ? pegasus_get_option('page_header_chk' ) : 'off';
		//check theme option for page header before page option

		$is_this_home = is_home();
		if ( 'on' === $global_disable_page_header_option ) {
			$final_page_header_option = 'on';
		} elseif ( 'on' === $post_disable_page_header_choice ) {
			$final_page_header_option = 'on';
		} else {
			$final_page_header_option = 'off';
		}

		if ( true === $is_this_home ) {
			$final_page_header_option = 'off';
		}


		$search_query = isset( $_REQUEST['s'] ) ? sanitize_text_field( $_REQUEST['s'] ) : '';

		if ( class_exists( 'SWP_Query' ) ) {
			// retrieve our search query if applicable
			$query = isset( $_REQUEST['swpquery'] ) ? sanitize_text_field( $_REQUEST['swpquery'] ) : '';

			// retrieve our pagination if applicable
			$swppg = isset( $_REQUEST['swppg'] ) ? absint( $_REQUEST['swppg'] ) : 1;

			//$engine = 'swp_support'; // taken from the SearchWP settings screen

			$swp_query = new SWP_Query(
			// see all args at https://searchwp.com/docs/swp_query/
				array(
					's'      => $query,
					//'engine' => $engine,
					'page'   => $swppg,
				)
			);

			// set up pagination
			$pagination = paginate_links( array(
				'format'  => '?swppg=%#%',
				'current' => $swppg,
				'total'   => $swp_query->max_num_pages,
			) );
		}
	?>

	<div class="<?php echo esc_attr( $final_container_class ); ?>">
		<!-- Example row of columns -->
		<div class="row">
			<?php
			if( 'on' === $pegasus_left_sidebar_option && 'on' === $left_align_sidebar_chk ) {
				get_sidebar( 'left' );
			} else if( 'on' === $left_align_sidebar_chk ) {
				get_sidebar( 'right' );
			}
			?>

			<div class="<?php echo esc_attr( $page_body_content_class ); ?>">
				<div class="inner-content">
					<?php
						if ( class_exists( 'SWP_Query' ) ) {

							if ( ! empty( $swp_query->posts ) ) {
								foreach( $swp_query->posts as $post ) : setup_postdata( $post ); ?>
									<div class="search-result">
										<h3><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h3>
										<?php the_excerpt(); ?>
									</div>
								<?php endforeach; wp_reset_postdata();
								// pagination
								if ( $swp_query->max_num_pages > 1 ) { ?>
									<div class="navigation pagination" role="navigation">
										<h2 class="screen-reader-text">Posts navigation</h2>
										<div class="nav-links">
											<?php echo wp_kses_post( $pagination ); ?>
										</div>
									</div>
								<?php }
							} else {
								?><p>No results found.</p><?php
							}
						} else {


							//global $query_string;
							//wp_parse_str( $query_string, $search_query );
							//$search = new WP_Query( $search_query );
							//global $wp_query;
							//$total_results = $wp_query->found_posts;
							$paged2 = (get_query_var('paged')) ? get_query_var('paged') : 1;
							$args = array(
								's' =>	$search_query,
								//'paged'          => $paged2,
								//'posts_per_page' => 5,

							);

							// the query
							$the_query = new WP_Query( $args );

							if ( $the_query->have_posts() ) :
								?>
								<h2 style="font-weight:bold;color:#000">
									<?php
									printf(
										/* translators: %s: search query */
										esc_html__( 'Search Results for: %s', 'pegasus' ),
										esc_html( get_query_var('s') )
									);
									?>
								</h2>
								<div class="search-list-container">
								<?php
								while ( $the_query->have_posts() ) : $the_query->the_post();
									global $post;

									$terms = get_the_terms( $post->ID, 'category' );

									if ( $terms && ! is_wp_error( $terms ) ) :
										$links = array();

										foreach ( $terms as $term ) {
											$links[] = $term->name;
										}
										$links = str_replace( ' ', '-', $links );
										$tax = join( " ", $links );
									else :
										$tax = '';
									endif;

									get_template_part('templates/content_item');
								endwhile;
								echo '</div><!-- End search-list-container -->';
								wp_reset_postdata();
								?>

							<?php else : ?>
								<h1><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'pegasus' ); ?></h1>
							<?php endif;
						} //end else
					?>
				</div><!--end inner content-->
			</div>
			<?php
			if( 'on' === $pegasus_left_sidebar_option ) {
				get_sidebar( 'right' );
			}
			if( 'on' !== $left_align_sidebar_chk ) {
				get_sidebar( 'right' );
			}
			?>
		</div><!--end row -->
	</div><!-- end container -->
</div><!-- end page wrap -->
<?php get_footer(); ?>
