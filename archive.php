	<?php get_header(); ?>			<?php 			//this is the option on the page options			$pegasus_container_choice = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true ); 			//this is the option from the theme options for global fullwidth			$full_container_chk_choice =  pegasus_theme_get_option('full_container_chk' ); 						//$meta2 = get_post_meta($post->ID); 			//echo "<pre>";  var_dump($meta2); echo "</pre><hr>";  			//echo $pegasus_container_choice;		?>				<div class="<?php if($full_container_chk_choice === 'on') { 									echo 'container-fluid'; 								}elseif ($pegasus_container_choice === 'on') { 									echo 'container-fluid'; 								}else{									echo 'container';								}?>">			<!-- Example row of columns -->			<div class="row">				<?php 					$left_sidebar_chk =  pegasus_theme_get_option('sidebar_left_chk' ); 					if( $left_sidebar_chk == 'on' ) {						get_sidebar(); 					} 				?>				<div class="col-md-9">					<div class="inner-content">						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>							<?php 								$page_header_choice =  pegasus_theme_get_option('page_header_chk' ); 								if( $page_header_choice != 'on' ) {							?>								<div class="page-header">									<h1><?php wp_title(); ?></h1>								</div>							<?php }else{ ?>								<div class="page-header-spacer"></div>							<?php } ?>							<article class="post">								<hr>								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>								<em>									<p>										By <?php the_author(); ?> 										on <?php echo the_time('l, F, jS, Y');?>										in <?php the_category( ',' ); ?>.										<a href="<?php comments_link(); ?>"><?php comments_number(); ?></a>									</p>								</em>																<?php the_excerpt(); ?>							</article>																									<?php endwhile; else: ?>							<?php /* kinda a 404 of sorts when not working */ ?>							<div class="page-header">								<h1>Oh no!</h1>							</div>							<p>No content is appearing for this page!</p>						<?php endif; ?>					</div><!--end inner content-->				</div>				<?php 					//get_sidebar(); 					if( $left_sidebar_chk == 'on' ) {						//do nothing					} else{						get_sidebar(); 					}				?>			</div><!--end row -->		</div><!-- end container -->	    <?php get_footer(); ?>