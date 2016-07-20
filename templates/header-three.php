		<header id="header">
			
			
			<div id="mega-menu" class="header header-sticky primary-menu the-default-third-nav icons-no default-skin ">
				<?php $top_header_choice =  pegasus_theme_get_option( 'top_header_chk' ); 
				if($top_header_choice === 'on' ) { get_template_part( 'templates/top-bar', 'header' ); } ?>
				
				<div class="<?php $headerContainerCheck =  pegasus_theme_get_option( 'header_container' ); if(!$headerContainerCheck) { echo 'container'; }else{ echo 'container-fluid'; } ?>">
					<div class="">
						<nav class="navbar navbar-default redq" role="navigation">
						<div class="">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
								
								
								<button type="button" class="navbar-toggle" data-toggle="collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand tk-proxima-nova large" href="<?php echo esc_url( home_url( '/' ) ); ?>">
									<?php
										$logo =  pegasus_theme_get_option( 'logo' );
										if( ! empty( $logo ) ) : ?>
											<img id="logo" src="<?php echo $logo; ?>" />
										<?php else: ?>
											<?php bloginfo( 'name' ); ?>
										<?php endif; 
									?>
								</a>
							</div>
							<!-- Collect the nav links, forms, and other content for toggling -->
							<!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> -->
							<div class="collapse navbar-collapse" id="navbar-collapse-1">
								<a class="navbar-brand mobile tk-proxima-nova pull-left" href="<?php esc_url( home_url() )?>">
									<?php
										$logo =  pegasus_theme_get_option( 'logo' );
										if( ! empty( $logo ) ) : ?>
											<img id="logo" src="<?php echo $logo; ?>" />
										<?php else: ?>
											<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
										<?php endif; 
									?>
								</a>
								<a class="mobile-menu-close"><i class="fa fa-times-circle"></i></a>
								<?php 
									$args = array(
										'theme_location'  => 'primary',
										'menu_class'	=> 'nav navbar-nav primary-navigation-bar',
										'container'		=> 'false'
									);
									wp_nav_menu( $args );
								?>
								<?php 
									$args = array(
										'menu' 			=> 'more-menu',
										'menu_class'	=> 'collapse nav navbar-nav nav-collapse primary-navigation-bar ',
										'menu_id'	=> 'nav-collapse1',
										'container'		=> 'false'
									);
									wp_nav_menu( $args );
								?>	
									 
									
									
									<div class="navbar-right">
									<?php 
										
										$woo_check =  pegasus_theme_get_option( 'woo_chk' );
										if ( $woo_check === 'on' ) {
											if ( class_exists( 'WooCommerce' ) ) {
											  // code that requires WooCommerce
											  get_template_part( 'templates/header-cart', 'header' );
											} else {
											  // you don't appear to have WooCommerce activated
											  echo '<div class="nav navbar-nav woo-error navbar-right">Enable WooCommerce</div>';
											}
										} 
										//$nav_social_check =  pegasus_theme_get_option( 'nav_social_chk' );
										//if($nav_social_check === 'on'){
											//get_template_part( 'templates/social_icons', 'header' );
										//}
									?>
									
						
									</div>
								
								
							<!-- end .nav .navbar-nav -->
							</div>
							<!-- end .navbar-collapse -->
							<!-- </div> -->
							<!-- end .container-fluid -->
						</div>
						<!-- end .container -->
						</nav>
						<!-- end nav -->
					</div>
					<!-- end .row -->
					
					
				</div>
				<!-- end .container -->
			</div>
			<!-- end .header -->
		</header> 
			
			<!-- Animated Intro
			================================================== -->
			<?php 
				
			
				/*if ( is_shop() ) { 
					//do nothing
					
				}else {
					//$meta2 = get_post_meta($post->ID); 
				}*/
				
					
					//$meta2 = get_post_meta($post->ID); 
					//echo "<pre>";  var_dump($meta2); echo "</pre><hr>";  
				
					if ( has_post_thumbnail() ) { 
						$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' ); 
					}else{
						$src = array( get_template_directory_uri() . "/images/banner.png", "1");
					}
					
					
					
					$header_three_choice = get_post_meta( get_the_ID(), 'pegasus_header_three_select', true );
					switch ($header_three_choice) {
						case "no-header":
							?>
							<div class="noheader-spacer"></div>
							<?php 
							break;
							
						case "sml-header":
							/*==================================
							============ SMALL HEADER ==========
							===================================*/
							?>
							<section class="pagetitle parallax parallax-image" style="background-image: url(<?php echo $src[0]; ?>); background-position: 50% 0px;">
								
								
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
								</div>
							</section>
							<?php
							break;
							
						case "lrg-header":
							/*==================================
							============ LARGE HEADER ==========
							===================================*/
							?>
							<section id="large-header" class="large-header" style="background:url(<?php echo $src[0]; ?>) center center no-repeat;">
								
								
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
							?><div class="noheader-spacer"></div><?php
							
					}
					
					
					?>