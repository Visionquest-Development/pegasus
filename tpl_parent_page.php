<?php
/* 
	Template Name: List Sub-pages Template
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
			
			//$meta2 = get_post_meta($post->ID); 
			//echo "<pre>";  var_dump($meta2); echo "</pre><hr>";  
			//echo $pegasus_container_choice;
		?>
		
		<div class="<?php echo $final_container_class; ?>">
		<!-- Example row of columns -->
			<div class="">
		
				<div class="inner-content">	
					<div class="content-no-sidebar clearfix">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<?php 
								$page_header_choice =  pegasus_get_option('page_header_chk' );
								if( $page_header_choice != 'on' ) {
							?>
								<div class="page-header">
									<h1><?php the_title(); ?></h1>
								</div>
							<?php }else{ ?>
								<div class="page-header-spacer"></div>
							<?php } ?>
							
							<?php the_content(); ?>
							
							<?php 
		
								$args = array(
									'post_type'      => 'page',
									'posts_per_page' => -1,
									'post_parent'    => $post->ID,
									'order'          => 'ASC',
									'orderby'        => 'menu_order'
								);
								$parent = new WP_Query( $args );

								if ( $parent->have_posts() ) : 
							?>

								<?php while ( $parent->have_posts() ) : $parent->the_post(); ?>

									<div id="parent-<?php the_ID(); ?>" class="parent-page">
										<h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
									</div>

								<?php endwhile; ?>

							<?php 
								endif; 
								wp_reset_query(); 
							?>
							
						<?php endwhile; else: ?>
							<?php /* kinda a 404 of sorts when not working */ ?>
							<div class="page-header">
								<h1>Oh no!</h1>
							</div>
							<p>No content is appearing for this page!</p>
						<?php endif; ?>
					</div>
				</div><!--end inner content-->

			</div><!--end row -->
		</div><!-- end container -->
	</div><!-- end page wrap -->
    <?php get_footer(); ?>