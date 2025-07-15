<?php
	// Delay execution if WordPress hasn't fully loaded yet
	if ( ! did_action( 'init' ) ) {
		return;
	}

	global $woocommerce;
	$shop_link_choice = ( 'on' === pegasus_get_option( 'shop_link_chk' ) ) ? pegasus_get_option( 'shop_link_chk' ) : 'off';
	$user_menu_choice = ( 'on' === pegasus_get_option( 'user_menu_chk' ) ) ? pegasus_get_option( 'user_menu_chk' ) : 'off';
	$cart_menu_choice = ( 'on' === pegasus_get_option( 'cart_menu_chk' ) ) ? pegasus_get_option( 'cart_menu_chk' ) : 'off';

	$logged_in_check = is_user_logged_in();
	$user_menu_logged_in_out = ( true === $logged_in_check ) ? '<i class="fa fa-user" aria-hidden="true"></i>' : '<i class="fa fa-user-times" aria-hidden="true"></i>';

	$user_menu = wp_nav_menu( array(
		'theme_location'	=> 'user-menu',
		'menu_class'	=> 'navbar-nav',
		'container'		=> false,
		'echo' => false,
		'depth'				=> 1,
		'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
		//'walker'			=> new WP_Bootstrap_Navwalker(),
		'items_wrap'      => '%3$s',
	) );

	$user_fallback_menu = '<li class="nav-item"><a class="nav-link" href="' . get_permalink( get_option('woocommerce_myaccount_page_id') ) . '">My Account</a></li>';
	//$user_fallback_menu = '';
	$final_user_menu = ( null !== $user_menu ) ? $user_menu : $user_fallback_menu;

	$woo_cart_url 	= wc_get_cart_url();
	$woo_cart_count = WC()->cart->get_cart_contents_count();
	$woo_cart_total = WC()->cart->get_cart_total();

	$final_woo_cart_url = $woo_cart_url;
	$woo_url_title = __( 'View your shopping cart' );
	$final_cart_count = sprintf (_n( '%d', '%d', $woo_cart_count ), $woo_cart_count );
	$final_cart_total = ' - ' . $woo_cart_total;

	$shop_page_url = get_permalink( get_option( 'woocommerce_shop_page_id' ) );
?>

<ul class="the-nav-cart pl-md-3 ms-auto">
	<?php if( 'on' !== $shop_link_choice ) : ?>
		<li class="menu-item">
			<a class="shop-link" href="<?php echo esc_url( $shop_page_url ); ?>">Shop</a>
		</li>
	<?php endif; ?>

	<?php if ( 'on' !== $user_menu_choice ) : ?>
	<li class="woo-item user-menu-container menu-item">
		<a class="user-menu " href="#" ><?php echo esc_html( $user_menu_logged_in_out ); ?></a>
		<ul class="sub-menu">
			<li class="menu-item">
				<?php
					if ( is_user_logged_in() ) {
						$current_user = wp_get_current_user();

						if ( $current_user->user_firstname || $current_user->user_lastname || $current_user->user_nicename || $current_user->display_name ) {
							if ( '' !== $current_user->user_firstname || '' !== $current_user->user_lastname ) {
								$final_name = $current_user->user_firstname;
							} else if ( '' !== $current_user->display_name ) {
								$final_name = $current_user->display_name;
							} else {
								$final_name = $current_user->user_nicename;
							}
							$first_and_last_name = $current_user->user_firstname . ' ' . $current_user->user_lastname;
							$final_last_name = ( '' !== $current_user->user_lastname ) ? ' ' . $current_user->user_lastname : '';
						}

						$temporary_name = substr( $final_name, 0, 25 );
						if( '' != $temporary_name ) {
							?>
							<a class="nav-link" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php _e('My Account'); ?>">
								Hi, <?php echo esc_html( $temporary_name . $final_last_name ); ?>!
							</a>
							<?php
						}
					} else{ ?>
						<a class="nav-link" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php _e('Login / Register'); ?>">
							<?php _e('Login / Register'); ?>
						</a>
				<?php } ?>
			</li>
			<?php
				echo wp_kses_post( $final_user_menu );
			?>
			<?php
				if ( is_user_logged_in() ) {
				?>
				<li class="menu-item">
					<a class="nav-link" href="<?php echo esc_url( home_url( '/' ) ); ?>wp-login.php?action=logout">Log Out <i class="fa fa-sign-out"></i></a>
				</li>
				<?php
				}
			?>
		</ul>
	 </li><?php endif; ?>

	<?php if( 'on' !== $cart_menu_choice ) : ?>
	<li class="header-cart-item woo-item menu-item">
		<a class="cart-contents" href="<?php echo esc_url( $final_woo_cart_url ); ?>" title="<?php echo esc_attr( $woo_url_title ); ?>"><?php echo esc_html( $final_cart_count ); ?></a>
		<ul class="sub-menu">
			<?php if( !is_cart() ) : ?>
				<li>
					<?php
						//if ( is_active_sidebar( 'shop-cart' ) ) {
							dynamic_sidebar( 'shop-cart' );
						//} else {
							//echo 'Add Cart Widget to Shop Sidebar.';
						//}
					?>
				</li>
			<?php else: ?>
				<li>You are on the cart page!</li>
			<?php endif; ?>
		</ul>
	</li>
	<?php endif; ?>
</ul>




