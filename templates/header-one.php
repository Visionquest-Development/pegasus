	<?php $fixed_header_choice = pegasus_theme_get_option( 'header_one_fixed_checkbox' ); ?>
	<div id="header" class="header-container <?php if($fixed_header_choice == 'on') { echo 'navbar-fixed-top'; } ?>">
		<?php 
			$top_header_choice = pegasus_theme_get_option( 'top_header_chk' );
			$headerContainerCheck =  pegasus_theme_get_option( 'header_container' );

			if($top_header_choice === 'on' ) { 
				get_template_part( 'templates/top-bar', 'header' );
			}
		?>
		<div class="<?php if(!$headerContainerCheck) { echo 'container'; }else{ echo 'container-fluid'; } ?> ">
			<div class="">
				
				<div class="site-branding <?php $centerLogo =  pegasus_theme_get_option( 'logo_centered' ); if($centerLogo) { echo 'center'; } ?>">
					<?php
					$logo =  pegasus_theme_get_option( 'logo' );
					if( ! empty( $logo ) ) : ?>
						<a class="logo-container" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img id="logo" src="<?php echo $logo; ?>" /></a>
					<?php else: ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php endif; ?>
				</div><!-- .site-branding -->
				<!-- Static navbar -->
				<nav class="navbar the-default-nav">
					<div class="row">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							  <span class="sr-only">Toggle navigation</span>
							  <span class="icon-bar top-bar"></span>
							  <span class="icon-bar middle-bar"></span>
							  <span class="icon-bar bottom-bar"></span>
							</button>
							
						</div>
						<div id="navbar" class="navbar-collapse  collapse">
							<?php 
								$args = array(
									'container'		=> false,
									//'menu' 			=> 'primary-menu',
									'theme_location'  => 'primary',
									'menu_class'	=> 'nav navbar-nav primary-navigation-bar ',
									//'menu_id' => false
									//'items_wrap'      => '<ul id="%1$s" class="%2$s nav navbar-nav">%3$s</ul>',
								);
								wp_nav_menu( $args );
							?>
							<?php 
								$moremenuchk =  pegasus_theme_get_option( 'header_more_chk' ); 
								if($moremenuchk === 'on') {
									get_template_part( 'tenplates/more_menu_one.php');
								} 
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
								$nav_social_check =  pegasus_theme_get_option( 'nav_social_chk' );
								if($nav_social_check === 'on'){
									get_template_part( 'templates/social_icons', 'header' );
								}
							?>
							</div>
						</div><!--/.nav-collapse -->
					</div><!--/.container-fluid -->
				</nav>
			</div><!-- end div holding stuff-->

		</div> <!-- /container -->
		<!-- end .container -->
		<?php get_template_part( 'templates/additional-header' ); ?>
	</div>

	
	