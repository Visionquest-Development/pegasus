<?php
	/*=================
		NAV OPTIONS
	==================*/
	$fixed_header_choice = ( 'on' === pegasus_get_option( 'header_fixed_checkbox' ) ) ? 'fixed-top' : '';
	//$sticky_header_choice = ( 'on' === pegasus_get_option( 'header_sticky_checkbox' ) ) ? 'sticky-top' : '';
	$right_align_nav_items = ( 'on' === pegasus_get_option('nav_right') ) ? 'ml-auto' : 'mr-auto';

	$bootstrap_color_scheme = pegasus_get_option('nav_color_scheme') ? pegasus_get_option('nav_color_scheme') : '';
	$bootstrap_color_utility = pegasus_get_option('nav_color_utility') ? pegasus_get_option('nav_color_utility') : '';

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
	if ( 'justify-content-md-center' === $nav_menu_justify_check ) {
		$right_align_nav_items = 'ms-auto';
	}
	$moremenuchk = pegasus_get_option( 'header_more_chk' );
	$woo_check =  pegasus_get_option( 'woo_chk' );
	$nav_social_check =  pegasus_get_option( 'nav_social_chk' );

	if ( 'on' === $woo_check || 'on' === $nav_social_check ) {
		$bootstrap_navbar_expand_class = 'navbar-expand-md';
	}

	$home_url = esc_url( home_url( '/' ) ) ? esc_url( home_url( '/' ) ) : '#';
	$fallback_menu = '<ul id="" class="navbar-nav"><li class="nav-item active current-menu-item"><a class="nav-link" href="' . $home_url . '">Home <span class="sr-only">(current)</span></a></li></ul>';
	$classes_for_nav_menu = 'navbar-nav primary-navigation-bar ' . $right_align_nav_items . ' ';
	//$final_menu = pegasus_get_menu( 'primary', $classes_for_nav_menu, 4, $fallback_menu );
	//$final_menu = $fallback_menu;

	$final_inner_container_class = ( 'container-fluid' === $global_full_container_option ) ? $global_full_container_option : $header_inner_container_option;
	$final_container_class = ( 'container-fluid' === $global_full_container_option ) ? $global_full_container_option : 'container';

	//justify-content-md-center
	$woo_check = pegasus_get_option( 'woo_chk' );
	$top_social_check = pegasus_get_option( 'top_social_chk' );
	$searchmenuchk = pegasus_get_option( 'search_box_chk' );

	$header_one_top_logo_container = ( 'on' === pegasus_get_option( 'full_container_chk' ) ) ? $global_full_container_option : 'container';

?>

<div id="header" class="header-container <?php echo $fixed_header_choice; ?> ">
	<?php
		if( 'on' === $top_header_choice ) {
			get_template_part( 'templates/top_bar', 'header' );
		}
	?>
	<div class="<?php echo $header_one_top_logo_container; ?>">
		<div class="site-branding <?php echo $centerLogo; ?>">
			<?php if( ! empty( $logo ) ) : ?>
				<a class="logo-container" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img id="logo" src="<?php echo $logo; ?>" alt=""/></a>
			<?php else: ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="" ><?php bloginfo( 'name' ); ?></a></h1>
			<?php endif; ?>
		</div><!-- .site-branding -->
	</div><!-- container -->
	<div class="<?php echo $header_container_check; ?>">
		<nav class="navbar <?php echo $bootstrap_navbar_expand_class; ?> the-default-nav <?php echo $bootstrap_color_scheme; ?> <?php echo $bootstrap_color_utility; ?>" >
			<?php if( 'on' !== pegasus_get_option( 'full_container_chk' ) & 'container' !== $header_container_check ) : ?>
				<div class="<?php echo $final_inner_container_class; ?>">
			<?php endif; ?>
				<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php bloginfo( 'name' ); ?>
				</a>
				<!-- Brand and toggle get grouped for better mobile display -->
				<button
					class="navbar-toggler"
					type="button"
					data-bs-toggle="collapse"
					data-bs-target="#pegasus_header_one"
					aria-controls="pegasus_header_one"
					aria-label="Toggle navigation"
				>
					<span class="navbar-toggler-icon"></span>
				</button>
				<div
					class="collapse navbar-collapse <?php echo $nav_menu_justify_check; ?>"
					id="pegasus_header_one"
				>
					<?php
						echo pegasus_get_menu( 'primary', $classes_for_nav_menu, 4, $fallback_menu );
						if( 'on' === $moremenuchk ) {
							get_template_part( 'templates/more_menu', 'header' );
						}
						if( 'on' === $searchmenuchk ) {
							get_template_part( 'templates/header_search', 'header' );
						}
						if ( 'on' === $woo_check ) {
							if ( class_exists( 'WooCommerce' ) ) {
								// code that requires WooCommerce
								get_template_part( 'templates/header_cart', 'header' );
							} else {
								// you don't appear to have WooCommerce activated
								echo '<div class="woo-error navbar-right">Enable WooCommerce</div>';
							}
						}
						if( 'on' === $nav_social_check ){
							get_template_part( 'templates/social_icons', 'header' );
						}
					?>
				</div>
			<?php if( 'on' !== pegasus_get_option( 'full_container_chk' ) ) : ?>
				</div ><!-- container-->
			<?php endif; ?>
		</nav>
	</div>
</div><!-- container -->
