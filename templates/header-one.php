	<header id="header">
		<div class="<?php $headerContainerCheck =  pegasus_theme_get_option( 'header_container' ); if(!$headerContainerCheck) { echo 'container'; }else{ echo 'container-fluid'; } ?> ">
			<div class="row">
				
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
					<div class="">
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
											'menu' 			=> 'primary-menu',
											//'theme_location'  => 'primary-menu',
											'menu_class'	=> 'nav navbar-nav primary-navigation-bar ',
											//'menu_id' => false
											//'items_wrap'      => '<ul id="%1$s" class="%2$s nav navbar-nav">%3$s</ul>',
										);
										wp_nav_menu( $args );
									?>
							<ul id="pegasus-mega-menu" class="nav navbar-nav sf-menu">
								<li class="the-more-link">
									<div class="sf-mega clearfix">
										<div class="sf-mega-section">

											<?php 
												$args2 = array(
													'theme_location'	=> 'mega-one',
													'menu_class'	=> 'nav ',
													'container'		=> 'false'
												);
												wp_nav_menu( $args2 );
												
											?>
									
										</div>
										<div class="sf-mega-section">

											<?php 
												$args3 = array(
													'theme_location'			=> 'mega-two',
													'menu_class'	=> 'nav ',
													'container'		=> 'false'
												);
												wp_nav_menu( $args3 );
											?>												
									
										</div>
										<div class="sf-mega-section">

											<?php 
												$args4 = array(
													'theme_location'			=> 'mega-three' ,
													'menu_class'	=> 'nav ',
													'container'		=> 'false'
												);
												wp_nav_menu( $args4 );
											?>												
									
										</div>
										<div class="sf-mega-section">

											<?php 
												$args5 = array(
													'theme_location'		=> 'mega-four' ,
													'menu_class'	=> 'nav  ',
													'container'		=> 'false'
												);
												wp_nav_menu( $args5 );
											?>												
									
										</div>
									</div>
									<a class="trigger" href="#">More</a>
								</li>
							</ul>
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
	</header>