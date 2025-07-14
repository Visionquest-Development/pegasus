<div id="header" class="the-fourth-nav header">
<?php
		/*=================
			NAV OPTIONS
		==================*/
		$fixed_header_choice = ( 'on' === pegasus_get_option( 'header_fixed_checkbox' ) ) ? 'fixed-top' : '';
		$sticky_header_choice = ( 'on' === pegasus_get_option( 'header_sticky_checkbox' ) ) ? 'sticky-top' : '';
		$right_align_nav_items = ( 'on' === pegasus_get_option('nav_right') ) ? 'ms-auto' : 'me-auto';

		$bootstrap_color_scheme = pegasus_get_option('nav_color_scheme') ? pegasus_get_option('nav_color_scheme') : '';
		$bootstrap_color_utility = pegasus_get_option('nav_color_utility') ? pegasus_get_option('nav_color_utility') : 'bg-light';

		$header_bkg_color = pegasus_get_option('header_bkg_color');
		if( $header_bkg_color ) {
			$bootstrap_color_scheme = '';
			$bootstrap_color_utility = '';
		}

		$bootstrap_navbar_expand_class = pegasus_get_option('global_nav_viewport_break') ? pegasus_get_option('global_nav_viewport_break') : 'navbar-expand-md';

		$top_header_choice = ( 'on' === pegasus_get_option( 'top_header_chk' ) ) ? pegasus_get_option( 'top_header_chk' ) : 'off';

		/*=================
			MENU OPTIONS
		==================*/
		$header_container_check = ( 'on' === pegasus_get_option( 'header_container' ) ) ? 'container' : '';
		$global_full_container_option =  ( 'on' === pegasus_get_option( 'full_container_chk' ) ) ? 'container-fluid' : 'container';
		$header_inner_container_option = ( 'on' === pegasus_get_option( 'nav_inner_container_checkbox' ) ) ? 'container-fluid' : 'container';

		$logo = pegasus_get_option( 'logo' );
		$centerLogo = ( 'on' === pegasus_get_option( 'logo_centered' ) ) ? 'center' : '';
		$nav_menu_justify_check = ( 'on' === pegasus_get_option( 'nav_justify' ) ) ? 'mx-auto' : '';
		$moremenuchk = pegasus_get_option( 'header_more_chk' );
		$woo_check =  pegasus_get_option( 'woo_chk' );
		$nav_social_check =  pegasus_get_option( 'nav_social_chk' );

		if ( 'on' === $woo_check || 'on' === $nav_social_check ) {
			$bootstrap_navbar_expand_class = 'navbar-expand-md';
		}

		//$home_url = esc_url( home_url( '/' ) ) ? esc_url( home_url( '/' ) ) : '#';
		//$fallback_menu = '<ul id="" class="navbar-nav"><li class="nav-item active current-menu-item"><a class="nav-link" href="' . $home_url . '">Home <span class="visually-hidden">(current)</span></a></li></ul>';
		//$classes_for_nav_menu = ' nav navbar-nav primary-navigation-bar ' . $right_align_nav_items . ' ';
		//$final_menu = pegasus_get_menu( 'primary', $classes_for_nav_menu, 3, $fallback_menu );
		//$final_menu = $fallback_menu;
		$home_url = esc_url( home_url( '/' ) ) ? esc_url( home_url( '/' ) ) : '#';
		$fallback_menu = '<ul id="" class="navbar-nav"><li class="nav-item active current-menu-item"><a class="nav-link" href="' . $home_url . '">Home <span class="visually-hidden">(current)</span></a></li></ul>';

		$final_inner_container_class = ( 'container-fluid' === $global_full_container_option ) ? $global_full_container_option : $header_inner_container_option;
		$final_container_class = ( 'container-fluid' === $global_full_container_option ) ? $global_full_container_option : 'container';

		//justify-content-md-center
		$woo_check = pegasus_get_option( 'woo_chk' );
		$top_social_check = pegasus_get_option( 'top_social_chk' );
		$searchmenuchk = pegasus_get_option( 'search_box_chk' );

	?>


	<?php get_template_part( 'templates/additional_header' ); ?>

	<div id="mega-menu" class="header header-sticky primary-menu the-default-fourth-nav icons-no default-skin ">


		<div class="container">
			<div class="row">
				<nav class="navbar navbar-default redq" role="navigation">

						<!-- Brand and toggle get grouped for better mobile display -->

						<a class="navbar-brand tk-proxima-nova large" href="<?php esc_url( home_url() )?>">
							<?php
								$logo =  pegasus_get_option( 'logo' );
								if( ! empty( $logo ) ) : ?>
									<img id="logo" src="<?php echo esc_url( $logo ); ?>" alt=""/>
								<?php else: ?>
									<?php bloginfo( 'name' ); ?>
								<?php endif;
							?>
						</a>
						<!--<button type="button" class="navbar-toggler" data-toggle="collapse">
						<span class="visually-hidden">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>-->
						<button
							type="button"
							class="navbar-toggler p-0 border-0"
							data-bs-toggle="collapse"
							data-bs-target="#pegasus-header-four-nav"
						>
							<span class="navbar-toggler-icon"></span>
						</button>


						<!-- Collect the nav links, forms, and other content for toggling -->
						<!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> -->
						<div class="collapse navbar-collapse" id="pegasus-header-four-nav">
							<div class="mobile-container">
								<a class="navbar-brand mobile tk-proxima-nova " href="<?php echo esc_url( $home_url ); ?>">
									<?php
										//$logo =  pegasus_get_option( 'logo' );
										if( ! empty( $logo ) ) : ?>
											<img id="logo" src="<?php echo esc_url( $logo ); ?>" alt=""/>
										<?php else: ?>
											<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
										<?php endif;
									?>
								</a>
								<a class="mobile-menu-close">
									<i class="fa fa-times-circle"></i>
								</a>
								<div id="mobile-menu-wrap">
								<?php
									$args = array(
										//'menu' 			=> 'header-menu',
										'theme_location'  => 'primary',
										'menu_class'	=> 'nav navbar-nav navbar-expand-md primary-navigation-bar',
										'container'		=> 'false'
									);
									wp_nav_menu( $args );
								?>
								</div>
								<?php
									//$classes_for_nav_menu2 = ' nav navbar-nav primary-navigation-bar ';
									//$final_menu2 = ;
									//echo pegasus_get_menu( 'primary', $classes_for_nav_menu2, 4, $fallback_menu );
								?>
								<div class="navbar-right">
									<?php

										$woo_check =  pegasus_get_option( 'woo_chk' );
										if ( $woo_check === 'on' ) {
											if ( class_exists( 'WooCommerce' ) ) {
												// code that requires WooCommerce
												get_template_part( 'templates/header_cart', 'header' );
											} else {
												// you don't appear to have WooCommerce activated
												echo '<div class="nav navbar-nav woo-error navbar-right">Enable WooCommerce</div>';
											}
										}
										//$nav_social_check =  pegasus_get_option( 'nav_social_chk' );
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

