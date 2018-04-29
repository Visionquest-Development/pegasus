<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php /* lang="en" */ ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Use Yoast SEO or Google "Author Wordpress" instead of these 2 tags below
		<meta name="description" content="">
		<meta name="author" content="">-->
		<?php
			$favicon = pegasus_get_option( 'favicon' );
			if ( $favicon ) {
				echo '<link rel="icon" href="' . $favicon . '">';
			} else {
				echo '<link rel="icon" href="' . get_template_directory_uri() . '/images/favicon.ico">';
			}
		?>

		<?php /* <title>
			<?php // This displays the page title | site name in the tab in your browser  ?>
			<?php // display the page  title and to the right of it echo out this separator | before the name of the site ?>
			<?php wp_title('|', true, 'right'); ?>
			<?php // display site name  ?>
			<?php bloginfo('name'); ?>
		</title> */ ?>
		<?php wp_head(); ?>
		<?php global $post; ?>
	</head>
	<?php

		$header_choice = pegasus_get_option( 'header_select' );
		$page_loader_choice = pegasus_get_option( 'page_loader_chk' ) ? pegasus_get_option( 'page_loader_chk' ) : 'off';

		$sticky_header_choice = ( 'on' === pegasus_get_option( 'header_sticky_checkbox' ) ) ? 'sticky-top' : '';
		$bootstrap_navbar_expand_class = pegasus_get_option('global_nav_viewport_break') ? pegasus_get_option('global_nav_viewport_break') : 'navbar-expand-md';

		$top_header_choice = ( 'on' === pegasus_get_option( 'top_header_chk' ) ) ? pegasus_get_option( 'top_header_chk' ) : 'off';

		$bootstrap_color_scheme = pegasus_get_option('nav_color_scheme') ? pegasus_get_option('nav_color_scheme') : 'navbar-light';
		$bootstrap_color_utility = pegasus_get_option('nav_color_utility') ? pegasus_get_option('nav_color_utility') : 'bg-light';

		$bootstrap_navbar_expand_class = pegasus_get_option('global_nav_viewport_break') ? pegasus_get_option('global_nav_viewport_break') : 'navbar-expand-md';

		$header_container_check = ( 'on' === pegasus_get_option( 'header_container' ) ) ? 'container' : '';
		$global_full_container_option =  ( 'on' === pegasus_get_option( 'full_container_chk' ) ) ? 'container-fluid' : 'container';
		$header_inner_container_option = ( 'on' === pegasus_get_option( 'nav_inner_container_checkbox' ) ) ? 'container-fluid' : 'container';

		$final_inner_container_class = ( 'container-fluid' === $global_full_container_option ) ? $global_full_container_option : $header_inner_container_option;

		$home_url = esc_url( home_url( '/' ) ) ? esc_url( home_url( '/' ) ) : '#';
		$fallback_menu = '<ul id="" class="navbar-nav"><li class="nav-item active current-menu-item"><a class="nav-link" href="' . $home_url . '">Home <span class="sr-only">(current)</span></a></li></ul>';
		$final_menu = pegasus_get_menu( 'primary', 'navbar-nav primary-navigation-bar', 3, $fallback_menu );
		$moremenuchk = pegasus_get_option( 'header_more_chk' );
		$woo_check =  pegasus_get_option( 'woo_chk' );
		$top_social_check = pegasus_get_option( 'top_social_chk' );
	?>
	<body <?php body_class(); ?>>

		<div id="wrapper">
			<?php  if( 'on' === $page_loader_choice ) { ?>
				<div class="page-loader">
					<img src="<?php echo get_template_directory_uri(); ?>/images/loader.gif" alt="">
				</div> 
			<?php }  ?>
			<div class="mainbar">

				<?php
					if ( 'sticky-top' !== $sticky_header_choice ) :
				?>
					<header>
						<?php
						switch ($header_choice) {
							case "header-one":
								get_template_part( 'templates/header_one', 'header' );
								break;
							case "header-two":
								get_template_part( 'templates/header_two', 'header' );
								break;
							case "header-three":
								get_template_part( 'templates/header_three', 'header' );
								break;
							case "header-four":
								get_template_part( 'templates/header_four', 'header' );
								break;
							case "header-five":
								get_template_part( 'templates/header_five', 'header' );
								break;
							default:
								get_template_part( 'templates/header_one', 'header' );
						}

						?>
						<!-- end .header -->
					</header>
				<?php
					else:
				?>
					<?php
					if( 'on' === $top_header_choice ) {
						get_template_part( 'templates/top_bar', 'header' );
					}
					?>
					<nav class="navbar <?php echo $bootstrap_navbar_expand_class; ?> the-default-nav <?php echo $bootstrap_color_scheme; ?> <?php echo $bootstrap_color_utility; ?> sticky-top" role="navigation">
						<?php if( 'on' !== pegasus_get_option( 'full_container_chk' ) & 'container' !== $header_container_check ) : ?>
						<div class="<?php echo $final_inner_container_class; ?>">
							<?php endif; ?>
							<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<?php bloginfo( 'name' ); ?>
							</a>
							<!-- Brand and toggle get grouped for better mobile display -->
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1"  aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<?php
								echo $final_menu;

								if( 'on' === $moremenuchk ) {
									get_template_part( 'templates/more_menu', 'header' );
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
								if( 'on' === $top_social_check ){
									get_template_part( 'templates/social_icons', 'header' );
								}
								?>
							</div>
							<?php if( 'on' !== pegasus_get_option( 'full_container_chk' ) ) : ?>
						</div ><!-- container-->
					<?php endif; ?>
					</nav>
				<?php endif; ?>

				<?php get_template_part( 'templates/additional_header' ); ?>

			 	<?php
					$breadcrumbs_check =  pegasus_get_option( 'bread_chk' );
					if($breadcrumbs_check === 'on') {
						//if ( function_exists('yoast_breadcrumb') ) {
							//echo '<div class="container">';
							//$woo_chk =  pegasus_get_option( 'woo_chk' );
							//if($woo_chk != 'on') {
								//yoast_breadcrumb('<div id="breadcrumbs">','</div>');
							//}else {
								//if( !is_checkout() ) {
									//yoast_breadcrumb('<p id="breadcrumbs">','</p>');
								//}//end checkout check
							//}
							//echo '</div>';
						//} //end check for function

						if( function_exists( 'bcn_display' ) ) {
							echo '<div class="container">';
						?>
							<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
								<?php bcn_display(); ?>
							</div>
						<?php
							echo '</div>';
						}
					}
				?>