<!--
	<div id="mega-menu" class="header header-sticky primary-menu the-default-fifth-nav icons-no default-skin ">


	</div>
-->
<?php
	$top_header_choice = pegasus_get_option( 'top_header_chk' );

	//echo $top_header_choice;
	if($top_header_choice === 'on' ) {
		get_template_part( 'templates/top_bar', 'header' );
	}
?>
<nav class="navbar navbar-inverse navbar-fixed-top keegans-nav">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php
			$logo =  pegasus_get_option( 'logo' );
			if( ! empty( $logo ) ) : ?>
				<a class="logo-container" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img id="logo" src="<?php echo $logo; ?>" alt=""/></a>
			<?php else: ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php endif; ?>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<?php
				$args = array(
					'container'		=> false,
					//'menu' 			=> 'primary-menu',
					'theme_location'  => 'primary',
					'menu_class'	=> ' keegans-header-menu',
					//'menu_class'	=> 'nav navbar-nav primary-navigation-bar',
					//'menu_id' => false
					//'items_wrap'      => '<ul id="%1$s" class="%2$s nav navbar-nav">%3$s</ul>',
					//'walker' => new wp_bootstrap_navwalker()
				);
				wp_nav_menu( $args );
		?>
		</div><!--/.navbar-collapse -->
	</div>
</nav>

<div class="sidebar-nav open" id="header">

	<!-- Sidebar navigate Button -->
	<div class="navi-btn">
		<a href="#"><i class="fa fa-bars"></i></a>
	</div>


	<!-- Logo Area -->
	<div class="keegans-logo">
		<!-- Heading -->
		<?php
		$logo =  pegasus_get_option( 'logo' );
		if( ! empty( $logo ) ) : ?>
			<a class="logo-container" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img id="logo" src="<?php echo $logo; ?>" alt=""/></a>
		<?php else: ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php endif; ?>

		<!-- Logo sub text -->
		<!--<span>Some Text Here</span>-->
	</div>


	<!-- Sidebar Widget -->
	<div class="nav-sidebar-widget">
		<!-- Sidebar list items -->
		<?php
			$args = array(
				'container'		=> false,
				//'menu' 			=> 'primary-menu',
				'theme_location'  => 'primary',
				'menu_class'	=> ' keegans-header-menu',
				//'menu_class'	=> 'nav navbar-nav primary-navigation-bar',
				//'menu_id' => false
				//'items_wrap'      => '<ul id="%1$s" class="%2$s nav navbar-nav">%3$s</ul>',
				//'walker' => new wp_bootstrap_navwalker()
			);
			wp_nav_menu( $args );
		?>
	</div>
	<div class="">
	<?php
		/*
		$woo_check =  pegasus_get_option( 'woo_chk' );
		if ( $woo_check === 'on' ) {
			if ( class_exists( 'WooCommerce' ) ) {
			  // code that requires WooCommerce
			  get_template_part( 'templates/header-cart', 'header' );
			} else {
			  // you don't appear to have WooCommerce activated
			  echo '<div class="nav navbar-nav woo-error navbar-right">Enable WooCommerce</div>';
			}
		} */
		//$nav_social_check =  pegasus_get_option( 'nav_social_chk' );
		//if($nav_social_check === 'on'){
			//get_template_part( 'templates/social_icons', 'header' );
		//}
	?>
	</div>

</div>

<?php get_template_part( 'templates/additional_header' ); ?>
