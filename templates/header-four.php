<div id="header" class="the-fourth-nav">
	<?php 
		$top_header_choice =  pegasus_theme_get_option( 'top_header_chk' );
		$headerContainerCheck =  pegasus_theme_get_option( 'header_container' ); 
		if($top_header_choice === 'on' ) { get_template_part( 'templates/top-bar', 'header' ); } 
	?>
	

	<?php get_template_part( 'templates/additional-header' ); ?>
	
	<div id="mega-menu" class="header header-sticky primary-menu the-default-fourth-nav icons-no default-skin ">
	
		
		<div class="<?php  if(!$headerContainerCheck) { echo 'container'; }else{ echo 'container-fluid'; } ?>">
			<div class="row">
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
							<a class="navbar-brand tk-proxima-nova large" href="<?php esc_url( home_url() )?>">
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
						<div class="collapse navbar-collapse">
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
									//'menu' 			=> 'header-menu',
									'theme_location'  => 'primary',
									'menu_class'	=> 'nav navbar-nav primary-navigation-bar',
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
</div> 
			
		