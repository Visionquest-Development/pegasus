	<?php
		/**
		 * Silence is golden; exit if accessed directly
		 */
		if ( ! defined( 'ABSPATH' ) ) {
			exit;
		}
		get_header();
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
			$final_page_header_option = ( 'on' === $global_disable_page_header_option ) ? $global_disable_page_header_option : $post_disable_page_header_choice;
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
						<!-- page header -->
						<?php
						if( 'on' !== $final_page_header_option ) {
							?>
							<div class="page-header">
								<h1>
									<?php
									if ( is_day() ) :
										printf( __( 'Daily Archives: %s', 'pegasus-bootstrap' ), get_the_date() );
									elseif ( is_month() ) :
										printf( __( 'Monthly Archives: %s', 'pegasus-bootstrap' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'pegasus-bootstrap' ) ) );
									elseif ( is_year() ) :
										printf( __( 'Yearly Archives: %s', 'pegasus-bootstrap' ), get_the_date( _x( 'Y', 'yearly archives date format', 'pegasus-bootstrap' ) ) );
									else :
										_e( 'Archives', 'pegasus-bootstrap' );
									endif;
									?>
								</h1>
							</div>
						<?php }else{ ?>
							<div class="page-header-spacer"></div>
						<?php } ?>
						<!-- end page header -->
						<!-- achive content -->
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

							<?php
								get_template_part( 'templates/content_item', 'content-item' );
							?>
						
						<?php endwhile; else: ?>
							<?php /* kinda a 404 of sorts when not working */ ?>
							<div class="page-header">
								<h1>Oh no!</h1>
							</div>
							<p>No content is appearing for this page!</p>
						<?php endif; ?>

						<?php
						// Previous/next post navigation.
						/*wp_bootstrap_post_navigation( array(
							'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'pegasus-bootstrap' ) . '</span> ' .
										   '<span class="screen-reader-text">' . __( 'Next post:', 'pegasus-bootstrap' ) . '</span> ' .
										   '<span class="post-title">%title</span>',
							'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'pegasus-bootstrap' ) . '</span> ' .
										   '<span class="screen-reader-text">' . __( 'Previous post:', 'pegasus-bootstrap' ) . '</span> ' .
										   '<span class="post-title">%title</span>'
						) );*/
						wp_bootstrap_posts_pagination( array(
							'prev_text'          => __( 'Previous page', 'pegasus-bootstrap' ),
							'next_text'          => __( 'Next page', 'pegasus-bootstrap' ),
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'pegasus-bootstrap' ) . ' </span>'
						) );
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