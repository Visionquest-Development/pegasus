<div id="top-bar" class="clearfix">	
						
	<div class="<?php $headerContainerCheck = pegasus_theme_get_option( 'header_container' ); if(!$headerContainerCheck) { echo 'container'; }else{ echo 'container-fluid'; } ?>">
		<div class="row">
			<div class="col-xs-6 left">
				<div class="text"><?php 
					$top_header_left = pegasus_theme_get_option( 'toparea_code' ); 
					echo $top_header_left;
				?></div>
			</div>
			<div class="col-xs-6 right">
				<div class="navbar-right">	
					<?php 
						$top_social_check = pegasus_theme_get_option( 'top_social_chk' );
						if($top_social_check === 'on'){
							get_template_part( 'templates/social_icons', 'header' );
						}
						
						$woo_check = pegasus_theme_get_option( 'woo_chk' );
						if ( $woo_check === 'on' ) {
							if ( class_exists( 'WooCommerce' ) ) {
							  // code that requires WooCommerce
							  get_template_part( 'templates/header-cart', 'header' );
							} else {
							  // you don't appear to have WooCommerce activated
							  echo '<div class="woo-error navbar-right">Enable WooCommerce</div>';
							}
						} 
						
					?>
				</div>
			</div>
		</div>
	</div>
</div>