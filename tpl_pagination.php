<?php
/*
	Template Name: Pagination Template
*/
?>
	<?php get_header(); ?>

	<?php
		$header_choice = pegasus_get_option( 'header_select' );
		//var_dump($header_choice);
		if ( 'header-three' === $header_choice ) {
			get_template_part( 'templates/additional_header' );
		}
	?>

	<div id="page-wrap">
		<?php
			//this is the option on the page options
			$pegasus_container_choice = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true );
			//this is the option from the theme options for global fullwidth
			$full_container_chk_choice =  pegasus_get_option('full_container_chk' );

			$page_vs_global_check = $pegasus_container_choice ? $pegasus_container_choice : $full_container_chk_choice;
			$final_container_class = $page_vs_global_check ? $page_vs_global_check : 'container';
		?>

		<div class="<?php echo $final_container_class; ?>">
			<!-- Example row of columns -->
			<div class="row">
				<?php
					$left_sidebar_chk =  pegasus_get_option('sidebar_left_chk' );
					if( $left_sidebar_chk == 'on' ) {
						get_sidebar();
					}
				?>
				<div class="col-md-9">
					<div class="inner-content">
						<div class="blog-article-container">

							<?php
								$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

								query_posts(array(
									'post_type'      => 'post', // You can add a custom post type if you like
									'paged'          => $paged,
									'posts_per_page' => 4,
									'order'                  => 'DESC',
									'orderby'                => 'date'
								));

								if ( have_posts() ) : ?>

								<?php while ( have_posts() ) : the_post(); ?>

										<?php
											if ( has_post_thumbnail() ) {
												$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' );

											}else{
												$thumb_default_url = get_template_directory_uri() . "/images/on-tap-default.jpg";
											}
										?>
										<article class="article-<?php the_ID(); ?> block-inner clearfix">

											<div class="picture-container  clearfix">
												<!-- output the thumbnail -->

													<a class="" href="<?php the_permalink(); ?>">

														<?php
															if ( has_post_thumbnail() ) {
																$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' );
																?>
																<img src="<?php echo esc_url( $thumb_url[0] ); ?>">
															<?php
															}else{

																$thumb_default_url = get_template_directory_uri() . "/images/on-tap-default.jpg"; ?>
																<img src="<?php echo esc_url( $thumb_default_url ); ?>">
														<?php
															}
														?>

													</a>




											</div> <!-- end picture container -->

												<div class="inside-content">
													<!-- the title -->
													<a  class="" href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>"><h2 class="featured-title"><?php the_title(); ?></h2></a>
													<!--author and time -->
													<i>Posted by <?php the_author(); ?> in <?php the_category(', '); ?> on <?php the_time('F j Y'); ?></i>

													<!-- output the excerpt, and if no excerpt then output content-->
													<div class="pegasus-featured-content ">
														<?php

																$more = 0;
																$octane_content = get_the_content();
																$temporary = substr(strip_tags($octane_content), 0, 230); ?>
																<p>
																	<?php echo esc_html( $temporary ); ?>
																</p>

													</div>
													<!-- output a read more button -->
													<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" class="read-more-blog-button"> Read More </a>
												</div>

										</article>
									<!--end -col-md-4-->


							<?php endwhile; ?>

								<?php /* <div class="page-navi"><?php my_pagination(); ?></div> */ ?>


								<?php
									// Previous/next page navigation.
									wp_bootstrap_posts_pagination( array(
										'prev_text'          => __( 'Previous page', 'textdomain' ),
										'next_text'          => __( 'Next page', 'textdomain' ),
										'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'textdomain' ) . ' </span>'
									) );
								?>

							<?php else : ?>

									<?php // no posts found message goes here ?>

							<?php endif; ?>



						</div>
					</div><!--end inner content-->
				</div>
				<?php
					//get_sidebar();
					if( $left_sidebar_chk == 'on' ) {
						//do nothing
					} else{
						get_sidebar();
					}
				?>


			</div><!--end row -->
		</div><!-- end container -->

		<?php get_footer(); ?>
