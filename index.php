	<?php
		/**
		 * Silence is golden; exit if accessed directly
		 */
		if ( ! defined( 'ABSPATH' ) ) {
			exit;
		}
		get_header();
		global $post;
	?>
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
			if ( isset($post) ) {
				$page_title = $post->post_title;
			}
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
						 	if ( is_front_page() && is_home() ) {
							  // Default homepage
							  //echo '<h1>Default Homepage</h1>';
							} elseif ( is_front_page() ) {
							  // static homepage
							  //echo '<h1>Front Page</h1>';
							} elseif ( is_home() ) {
							  	// blog page
							  	?>
								<?php /* ?>
								<ul id="blog-categories">
									<li class="cat-item ">
										<a href="#self">All</a>
									</li>
									<?php
										$args = array(
										'show_option_all'    => '',
										'orderby'            => 'name',
										'order'              => 'ASC',
										'style'              => 'list',
										'show_count'         => 0,
										'hide_empty'         => 1,
										'use_desc_for_title' => 0,
										'child_of'           => 0,
										'feed'               => '',
										'feed_type'          => '',
										'feed_image'         => '',
										'exclude'            => '',
										'exclude_tree'       => '',
										'include'            => '',
										'hierarchical'       => 0,
										'title_li'           => 0,
										'show_option_none'   => __( '', 'pegasus' ),
										'number'             => null,
										'echo'               => 1,
										'depth'              => 0,
										'current_category'   => 0,
										'pad_counts'         => 0,
										'taxonomy'           => 'category',
										'walker'             => null
										);
										wp_list_categories( $args );
									?>
								</ul>
								<?php */ ?>
								<?php
									//$paged = ( get_query_var( 'paged' ) ) ? get_query_var('paged') : 1;
									$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

									$blog_query = new WP_Query(
										array(
											'post_type' => 'post',
											'paged' => $paged,
											'posts_per_page' => 10,
											'order'                  => 'DESC',
											'orderby'                => 'date'
										)
									);
									if ( $blog_query->have_posts() ) :
									while ( $blog_query->have_posts() ) : $blog_query->the_post();
								?>
									<?php get_template_part( 'templates/content_item', 'content-item' ); ?>
								<?php
									endwhile;
									endif;
									//wp_reset_query();
									wp_reset_postdata();
								?>
								<?php
							} else {
							  //everything else
								?>
								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

									<?php if( 'off' === $final_page_header_option ) { ?>
										<div class="page-header">
											<?php
											if( '' === $page_title ) {
												echo '';
											} elseif ( $page_title ) {
												echo '<h1>';
												echo the_title();
												echo '</h1>';
											}
											?>
										</div>
									<?php }else{ ?>
										<div class="page-header-spacer"></div>
									<?php } //else ?>

									<?php the_content(); ?>

									<?php comments_template(); ?>
								<?php endwhile; else: ?>
									<?php /* kinda a 404 of sorts when not working */ ?>
									<div class="page-header">
										<h1>Oh no!</h1>
									</div>
									<p>No content is appearing for this page!</p>
								<?php endif; ?>
								<?php
							} //end page template check
						?>

						<?php
							my_pagination();

							if ( function_exists( 'wp_bootstrap_edit_post_link' ) ) {
								// Edit post link
								wp_bootstrap_edit_post_link(
									sprintf(
										/* translators: %s: Name of current post */
										__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'pegasus' ),
										get_the_title()
									),
									'<span class="edit-link">',
									'</span>'
								);
							}
							if ( function_exists( 'wp_bootstrap_posts_pagination' ) ) {
								wp_bootstrap_posts_pagination( array(
									'prev_text'          => __( 'Previous page', 'pegasus' ),
									'next_text'          => __( 'Next page', 'pegasus' ),
									'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'pegasus' ) . ' </span>'
								) );
							}
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
