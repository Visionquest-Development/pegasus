
				<?php
					$footer_custom_code =  pegasus_get_option( 'custom_bottom_textareacode' );
					$full_container_chk_choice =  pegasus_get_option( 'full_container_chk' );
					$full_container_footer_choice =  pegasus_get_option( 'footer_fullwidth_checkbox' );
					$final_footer_container_class = ( 'on' === $full_container_chk_choice ) ? 'container-fluid' : 'container';
					$final_footer_colophon_class = ( 'on' === $full_container_footer_choice ) ? 'container-fluid' : $final_footer_container_class;
					$back_to_top = pegasus_get_option( 'back_to_top' );
				?>

				<?php
					if( "on" === $back_to_top ) {
						?><div id="toTop" class="fa fa-chevron-up"></div><?php
					}
				?>


				<?php
					if( $footer_custom_code ):
				?>
						<!-- Footer custom code for banner, etc. -->
						<section class="pegasus-custom-footer">
							<div class="<?php echo $final_footer_container_class; ?>">
								<div class="">
									<?php echo do_shortcode( $footer_custom_code ); ?>
								</div>
							</div>
						</section>
						<!-- end custom footer code -->
				<?php
					endif;
				?>
				<!-- start pegasus footer -->
				<div class="pegasus-footer">
					<footer>
						<?php
							$hr_check = pegasus_get_option( 'footer_hr_checkbox' );
							if( $hr_check === 'on' ){
								echo "<hr>";
							}
						?>

						<!-- FOOTER SOCIAL WIDGET -->
						<?php if ( is_active_sidebar( 'footer-social' ) ) : ?>
							<div class="<?php echo $final_footer_container_class; ?>">
								<div class="footer-social-container">
									<?php dynamic_sidebar( 'footer-social' ); ?>
								</div>
							</div>
						<?php endif; ?>

						<!-- FOOTER WIDGET AREA -->
						<?php
							$footer_widget_areas = absint( pegasus_get_option(  'footer_widget_areas' ) );

							switch ( $footer_widget_areas ) {
								case 0:
									$footer_widget_class = '';
									break;
								case 1:
									$footer_widget_class = 'col-12 col-sm-12 col-md-12 col-lg-12';
									break;
								case 2:
									$footer_widget_class = 'col-12 col-sm-12 col-md-6 col-lg-6';
									break;
								case 3:
									$footer_widget_class = 'col-12 col-sm-12 col-md-6 col-lg-4';
									break;
								case 4:
									$footer_widget_class = 'col-12 col-sm-12 col-md-6 col-lg-3';
									break;
								default:
									$footer_widget_class = '';
							}

							if( $footer_widget_areas > 0 ) :
						?>
							<div class="<?php echo $final_footer_container_class; ?>">
								<div id="footer-widgets" class="footer-widget-areas clearfix">
									<div class="row">
										<?php for( $i = 1; $i <= $footer_widget_areas; $i++ ): ?>
											<div id="footer-widget-<?php echo $i; ?>" class="footer-widget-area <?php echo $footer_widget_class; ?>" role="complementary" >
												<?php dynamic_sidebar( 'footer-' . $i ); ?>
											</div><!-- .widget-area -->
										<?php endfor; ?>
									</div>
								</div>
							</div><!-- /container -->
						<?php endif; ?>
						<!-- COLOPHON -->
						<div class="colophon-container">
							<div class="<?php echo $final_footer_colophon_class; ?>">
								<div id="colophon" class="site-footer" role="contentinfo">
									<div class="site-info">
										<?php
											$custom_footer = pegasus_get_option( 'footer_copy_textareacode' );
											if( $custom_footer ) {
												echo $custom_footer;
											} else {
										?>
											<p class="copyright">&copy; <?php echo date('Y');?> <?php bloginfo('name'); ?></p>
										<?php
											}//end else
										?>
									</div><!-- .site-info -->
								</div><!-- .site-footer -->
							</div><!-- /container -->
						</div>
					</footer>
				</div>
			
			</div><!--mainbar end-->
		
		</div><!--end-wrapper-->
		<?php wp_footer(); ?>
		
	</body>
</html>
