	<?php
		//$top_header_choice =  pegasus_get_option( 'top_header_chk' );
		//$fixed_header_choice = pegasus_get_option( 'header_fixed_checkbox' );
		//$headerContainerCheck =  pegasus_get_option( 'header_container' );
	?>

	<?php
		/*=================
			NAV OPTIONS
		==================*/
		$fixed_header_choice = ( 'on' === pegasus_get_option( 'header_fixed_checkbox' ) ) ? 'fixed-top' : '';
		$sticky_header_choice = ( 'on' === pegasus_get_option( 'header_sticky_checkbox' ) ) ? 'sticky-top' : '';
		$right_align_nav_items = ( 'on' === pegasus_get_option('nav_right') ) ? 'ml-auto' : 'mr-auto';

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
		//$fallback_menu = '<ul id="" class="navbar-nav"><li class="nav-item active current-menu-item"><a class="nav-link" href="' . $home_url . '">Home <span class="sr-only">(current)</span></a></li></ul>';
		//$classes_for_nav_menu = ' nav navbar-nav primary-navigation-bar ' . $right_align_nav_items . ' ';
		//$final_menu = pegasus_get_menu( 'primary', $classes_for_nav_menu, 3, $fallback_menu );
		//$final_menu = $fallback_menu;
		$home_url = esc_url( home_url( '/' ) ) ? esc_url( home_url( '/' ) ) : '#';
		$fallback_menu = '<ul id="" class="navbar-nav"><li class="nav-item active current-menu-item"><a class="nav-link" href="' . $home_url . '">Home <span class="sr-only">(current)</span></a></li></ul>';

		$final_inner_container_class = ( 'container-fluid' === $global_full_container_option ) ? $global_full_container_option : $header_inner_container_option;
		$final_container_class = ( 'container-fluid' === $global_full_container_option ) ? $global_full_container_option : 'container';

		//justify-content-md-center
		$woo_check = pegasus_get_option( 'woo_chk' );
		$top_social_check = pegasus_get_option( 'top_social_chk' );
		$searchmenuchk = pegasus_get_option( 'search_box_chk' );

	?>


	<div id="header" >

		<div class="header-container <?php echo $fixed_header_choice; ?> fixed-top">
			<div class="header header-sticky primary-menu the-default-third-nav icons-no default-skin ">
				<?php
					if($top_header_choice === 'on' ) {
						get_template_part( 'templates/top_bar', 'header' );
					}
				?>
				<nav id="mega-menu" class="navbar navbar-expand-md fixed-top ">
					<div class="container <?php echo $header_container_check; ?>">



							<!--<a class="navbar-brand mr-auto mr-lg-0" href="#">Offcanvas navbar</a>-->
							<a class="navbar-brand tk-proxima-nova large" href="<?php echo $home_url; ?>">
								<?php
									if( ! empty( $logo ) ) : ?>
										<img id="logo" src="<?php echo $logo; ?>" alt=""/>
									<?php else: ?>
										<?php bloginfo( 'name' ); ?>
									<?php endif;
								?>
							</a>


							<button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
								<span class="navbar-toggler-icon"></span>
							</button>

							<div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">

								<?php
									$classes_for_nav_menu2 = ' navbar-nav ms-auto ' . $nav_menu_justify_check . ' pegasus-mobile-nav ';
									//$final_menu2 = ;
									echo pegasus_get_menu( 'primary', $classes_for_nav_menu2, 4, $fallback_menu );
								?>
								<!--<form class="form-inline my-2 my-lg-0">
									<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
									<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
								</form>-->

								<?php
									$moremenuchk =  pegasus_get_option( 'header_more_chk' );
									if($moremenuchk === 'on') {
										$args = array(
											'menu' 			=> 'more-menu',
											'menu_class'	=> 'collapse nav navbar-nav nav-collapse primary-navigation-bar ',
											'menu_id'	=> 'nav-collapse1',
											'container'		=> 'false'
										);
										wp_nav_menu( $args );
									}
								?>

								<div class="navbar-right ms-auto">
									<?php

										if ( 'on' === $woo_check ) {
											if ( class_exists( 'WooCommerce' ) ) {
												// code that requires WooCommerce
												get_template_part( 'templates/header_cart', 'header' );
											} else {
												// you don't appear to have WooCommerce activated
												echo '<div class="woo-error navbar-right">Enable WooCommerce</div>';
											}
										}
										//$nav_social_check =  pegasus_get_option( 'nav_social_chk' );
										//if($nav_social_check === 'on'){
											//get_template_part( 'templates/social_icons', 'header' );
										//}
									?>
								</div>
							</div>

							<!-- end nav -->

						<!-- end .row -->
					</div>
					<!-- end .container -->
				</nav>
			</div>
			<!-- end .header -->
		</div><!-- header container -->
	</div><!-- end header tag -->

	<?php
		//echo '======== Starting Additional Header =======';
		//get_template_part( 'templates/additional_header' );
		//echo '======== Ending Additional Header =========';
		?>

