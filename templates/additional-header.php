
<!-- Animated Intro
================================================== -->
<?php

	if ( has_post_thumbnail() ) { 
		$featured_img_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' ); 
	}else{
		$featured_img_src = array( get_template_directory_uri() . "/images/banner.png", "1");
	}
	
	$header_three_choice = get_post_meta( get_the_ID(), 'pegasus_header_three_select', true );
	switch ($header_three_choice) {
		case "no-header":
			?>
				
			<?php 
			break;

		case "space":
			?>
				<div class="noheader-spacer"></div>
			<?php 
			break;
			
		case "sml-header":
			/*==================================
			============ SMALL HEADER ==========
			===================================*/
			?>
			<section class="pagetitle parallax parallax-image" style="background-image: url(<?php echo $featured_img_src[0]; ?>); background-position: 50% 0px;">
				
				<div class="wrapsection">
					<!--<div class="overlay" style="background:#303543;opacity:0.4;">-->
				</div>
					
				<div class="container">
					<div class="parallax-content">
						<div class="block2 text-center octane-header-content" style="color:#fff;">
							<?php
								$the_header_content =  get_post_meta(get_the_ID(), 'pegasus-header-three-wysiwyg', true ); 
								echo $the_header_content;
							?>
						</div>
					</div>
				</div>
				
			</section>
			<?php
			break;
			
		case "lrg-header":
			/*==================================
			============ LARGE HEADER ==========
			===================================*/
			?>
			<section id="large-header" class="large-header" style="background:url(<?php echo $featured_img_src[0]; ?>) center center no-repeat;">
				
				
				<canvas id="demo-canvas"></canvas>
				<div class="pegasus-header-content">
					<?php
						$the_header_content = get_post_meta(get_the_ID(), 'pegasus-header-three-wysiwyg', true ); 
						echo $the_header_content;
					?>
				</div>
			</section>
			<?php 
			break;
			
		default:
			?><?php
			
	}
?>