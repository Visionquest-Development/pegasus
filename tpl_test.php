<?phpphp
/* 
	Template Name: Test Template
*/
?>
	<?php get_header(); ?>
	
 
    <?php 
			
			//this is the option on the page options
			$pegasus_container_choice = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true ); 
			//this is the option from the theme options for global fullwidth
			$full_container_chk_choice =  pegasus_theme_get_option('full_container_chk' ); 
			
			//$meta2 = get_post_meta($post->ID); 
			//echo "<pre>";  var_dump($meta2); echo "</pre><hr>";  
			//echo $pegasus_container_choice;
		?>
		
		<div class="<?php if($full_container_chk_choice === 'on') { 
										echo 'container-fluid'; 
									}elseif ($pegasus_container_choice === 'on') { 
										echo 'container-fluid'; 
									}else{
										echo 'container';
									}?>">
		<!-- Example row of columns -->
		<div class="row">
			<div id="dot-nav-container">
					  <nav id="dotnav" class="">
						<ul class="dotnav dotnav-vertical dotnav-right nav">
							
						</ul>
					  </nav>
				</div>
			<div class="scrollspy-page-content">
				
				
			</div>
			<div class="content-no-sidebar clearfix">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<!--<div class="page-header">
						<h1><?php //the_title(); ?></h1>
					</div>-->
					
					<?php the_content(); ?>
				
				<?php endwhile; else: ?>
					<?php /* kinda a 404 of sorts when not working */ ?>
					<div class="page-header">
						<h1>Oh no!</h1>
					</div>
					<p>No content is appearing for this page!</p>
				<?php endif; ?>
			</div>
			

		</div>
	</div>
    <?php get_footer(); ?>