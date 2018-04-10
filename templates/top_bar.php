<?php

	//full container page options
	$post_full_container_choice = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true );
	//full container theme option
	$global_full_container_option = pegasus_get_option('full_container_chk' );

	//assign post class
	$pegasus_post_container_choice = ( 'on' === $post_full_container_choice ) ? 'container-fluid' : 'container';
	//assign global class
	$pegasus_global_container_choice = ( 'on' === $global_full_container_option ) ? 'container-fluid' : 'container' ;
	//check global first then post
	$final_container_class = ( 'container-fluid' === $pegasus_global_container_choice ) ? $pegasus_global_container_choice : 'container';

	$top_column_option = ( pegasus_get_option( 'top_column_count' ) ) ? ( (int) pegasus_get_option( 'top_column_count' ) ) : 2;
	$top_column_class = ( 2 === $top_column_option ) ? 'col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6' : 'col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4';

	$top_outer_container_class = ( 'on' === pegasus_get_option( 'top_header_container' ) ) ? 'container': '';

	$top_header_left = pegasus_get_option( 'toparea_left_code' );
	$top_header_center = pegasus_get_option( 'toparea_center_code' );
	$woo_check = pegasus_get_option( 'woo_chk' );
	$top_social_check = pegasus_get_option( 'top_social_chk' );

	if ( 'on' === $top_social_check ) {
		$top_column_class = ( 2 === $top_column_option ) ? 'col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6' : 'col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4';
	}
?>
<div class="<?php echo $top_outer_container_class; ?>">
	<div id="top-bar" class="">
		<div class="<?php echo $final_container_class; ?>">
			<div class="row">
				<div class="<?php echo $top_column_class; ?> left">
					<div class="text">
						<?php
							echo $top_header_left;
						?>
					</div>
				</div>
				<?php if( 3 === $top_column_option ) : ?>
					<div class="<?php echo $top_column_class; ?> center">
						<div class="text">
							<?php
								echo $top_header_center;
							?>
						</div>
					</div>
				<?php endif; ?>
				<div class="<?php echo $top_column_class; ?> right">
					<nav class="navbar" role="navigation">
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
							if( 'on' === $top_social_check ){
								get_template_part( 'templates/social_icons', 'header' );
							}
						?>
					</nav>
				</div>
			</div>
		</div>
	</div><!-- top bar -->
</div>