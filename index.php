	<?php get_header(); ?>			<?php 			$pegasus_container_choice = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true ); 			$full_container_chk_choice = get_post_meta( get_the_ID(), 'full_container_chk', true ); 		?>		<div class="<?php if($full_container_chk_choice === 'on') { 														echo 'container-fluid'; 													}elseif ($pegasus_container_choice === 'on') { 														echo 'container-fluid'; 													}else{														echo 'container';													}?>">			<!-- Example row of columns -->			<div class="row">				<?php 					$left_sidebar_chk =  pegasus_theme_get_option('sidebar_left_chk' ); 					if( $left_sidebar_chk == 'on' ) {						get_sidebar(); 					} 				?>				<div class="col-md-9">					<div class="inner-content">							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>													<?php 								$page_header_choice =  pegasus_theme_get_option('page_header_chk' ); 								if( $page_header_choice != 'on' ) {							?>								<div class="page-header">									<h1><?php wp_title(); ?></h1>								</div>							<?php }else{ ?>								<div class="page-header-spacer"></div>							<?php } ?>														<?php the_content(); ?>											<?php endwhile; else: ?>							<?php /* kinda a 404 of sorts when not working */ ?>							<div class="page-header">								<h1>Oh no!</h1>							</div>							<p>No content is appearing for this page!</p>						<?php endif; ?>					</div><!--end inner content-->				</div>				<?php 					//get_sidebar(); 					if( $left_sidebar_chk == 'on' ) {						//do nothing					} else{						get_sidebar(); 					}				?>		   			</div><!--end row -->		</div><!-- end container -->	    <?php get_footer(); ?>