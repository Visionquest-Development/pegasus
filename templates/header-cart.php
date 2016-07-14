<?php global $woocommerce; 

?>

<ul class="the-nav-cart nav navbar-nav">
		<?php $shop_link_choice = pegasus_theme_get_option( 'shop_link_chk' );
		if ($shop_link_choice != 'on') { ?>
		<li>
			<a class="shop-link" href="<?php echo esc_url( home_url( '/' ) ); ?>shop">Shop</a>
		</il><?php } ?>
		
		<?php $user_menu_choice = pegasus_theme_get_option( 'user_menu_chk' );
		if ($user_menu_choice != 'on') { ?>
		<li class="woo-item user-menu-container menu-item">
			<a class="user-menu" href="#" ><?php if ( is_user_logged_in() ) { echo '<i class="fa fa-user" aria-hidden="true"></i>'; } else { echo '<i class="fa fa-user-times" aria-hidden="true"></i>'; } ?></a>
			<ul class="sub-menu">
				<li class="menu-item">
					<?php if ( is_user_logged_in() ) { ?>
						<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','woothemes'); ?>"><?php _e('My Account','woothemes'); ?></a>
					<?php }else{ ?>
						<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','woothemes'); ?>"><?php _e('Login / Register','woothemes'); ?></a>
					<?php } ?>
				</li>
				<?php 
					$args = array(
						'theme_location'	=> 'user-menu',
						'menu_class'	=> 'nav ',
						'container'		=> 'false',
						'items_wrap'      => '%3$s',
					);
					wp_nav_menu( $args );
					
				?>
				
			</ul>
		 </li><?php } ?>
		
		<?php $cart_menu_choice = pegasus_theme_get_option( 'cart_menu_chk' );
		if ($cart_menu_choice != 'on') { ?>
		<li class="header-cart-item  woo-item menu-item">
			<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf (_n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> <?php //echo '- '; echo WC()->cart->get_cart_total(); ?></a>
			<ul class="sub-menu">
				<?php if( !is_cart() ) {?><li><?php if ( dynamic_sidebar( 'shop-cart' ) ); ?></li> <?php }else{ ?>
					<li>You are on the cart page!</li>
				<?php } ?>
			</ul>
		</li><?php } ?>
	
</ul>




