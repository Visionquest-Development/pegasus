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

	<div class="<?php echo $final_container_class; ?>">
		<!-- Example row of columns -->
		<div class="row">
			<?php
			if( 'on' === $pegasus_left_sidebar_option && 'on' === $left_align_sidebar_chk ) {
				get_sidebar( 'left' );
			} else if( 'on' === $left_align_sidebar_chk ) {
				get_sidebar( 'right' );
			}
			?>

			<div class="<?php echo $page_body_content_class; ?>">
				<div class="inner-content">
					<?php
						if ( class_exists( 'SWP_Query' ) ) {

							if ( ! empty( $swp_query->posts ) ) {
								foreach( $swp_query->posts as $post ) : setup_postdata( $post ); ?>
									<div class="search-result">
										<h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
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

							$args = array(
								's' =>	$search_query
							);

							// the query
							$the_query = new WP_Query( $args );

							if ( $the_query->have_posts() ) :
								_e( "<h2 style='font-weight:bold;color:#000'>Search Results for: " . get_query_var('s') . "</h2>" );
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
									?>

									<div class="content-item-container search-results-container <?php echo strtolower( $tax ); ?>">
										<article class="article-<?php the_ID(); ?> block-inner ">

											<div class="content-item-wrapper">
												<!-- the permalink and title -->
												<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
													<h3 class="content-item-title"><?php the_title(); ?></h3>
												</a>


												<?php
												$the_time = the_time( 'l, F jS, Y' ) ? the_time( 'l, F jS, Y' ) : '';
												if ( '' !== $the_time ) :
													?>
													<em>
														<p class="content-item-date-time">
															<?php echo $the_time;?>
														</p>
													</em>
												<?php
												endif;
												?>

												<p><?php the_permalink(); ?></p>

												<div class="content-item-cats"><i><?php the_category(); ?></i></div>

												<!-- output the excerpt, and if no excerpt then output content-->
												<!-- output is limited to the first 300 characters then an elipsis (...) is added and a read more link appears -->
												<div class="content-item-paragraph-content">
													<?php
													$pegasus_excerpt = get_the_excerpt();
													if( isset( $pegasus_excerpt ) ) { ?>
														<p>
															<?php
															$temporary_excerpt = substr( strip_tags( $pegasus_excerpt ), 0, 300 );
															$final_excerpt = ( $pegasus_excerpt !== $temporary_excerpt ) ? ( $temporary_excerpt . '...') : $pegasus_excerpt;
															echo $final_excerpt;
															?>
														</p>
													<?php } else {
														$more = 0;
														$pegasus_content = get_the_content();
														$temporary_content = substr( strip_tags( $pegasus_content ), 0, 300 );
														$final_content = ( $pegasus_content !== $temporary_content ) ? ( $temporary_content . '...' ) : $pegasus_content;
														?>
														<p>
															<?php echo $final_content; ?>
														</p>
													<?php }	?>
												</div>

											</div>

										</article>
									</div>
								<?php endwhile; ?>

								<?php wp_reset_postdata(); ?>

							<?php else : ?>
								<h1><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></h1>
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
