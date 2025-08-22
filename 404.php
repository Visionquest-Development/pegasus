<?php
/**
 * 404 Page Template
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div id="page-wrap">
	<?php
		$header_choice = pegasus_get_option( 'header_select' );
		if ( 'header-three' === $header_choice ) {
			get_template_part( 'templates/additional_header' );
		}
	?>

	<div class="<?php echo esc_attr( ( 'on' === pegasus_get_option('full_container_chk' ) ) ? 'container-fluid' : 'container' ); ?>">
		<div class="row">
			<?php
				$left_align_sidebar_chk = pegasus_get_option( 'sidebar_left_chk' ) ?? 'off';
				$pegasus_left_sidebar_option = pegasus_get_option( 'both_sidebar_chk' ) ?? 'off';

				if( 'on' === $pegasus_left_sidebar_option && 'on' === $left_align_sidebar_chk ) {
					get_sidebar( 'left' );
				} elseif ( 'on' === $left_align_sidebar_chk ) {
					get_sidebar( 'right' );
				}
			?>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xg-9">
				<div class="inner-content">
					<div class="page-header">
						<h1>Oops! That page can't be found.</h1>
					</div>
					<p>It looks like nothing was found at this location. Try one of the links below or a search:</p>

					<?php get_search_form(); ?>

					<hr>
					<h2>Recent Posts</h2>
					<ul>
						<?php
							$recent_posts = wp_get_recent_posts( array( 'numberposts' => 5 ) );
							foreach( $recent_posts as $post ) :
						?>
							<li><a href="<?php echo get_permalink($post['ID']) ?>"><?php echo esc_html($post['post_title']); ?></a></li>
						<?php endforeach; ?>
					</ul>

				</div>
			</div>

			<?php
				if( 'on' === $pegasus_left_sidebar_option ) {
					get_sidebar( 'right' );
				}
				if( 'on' !== $left_align_sidebar_chk ) {
					get_sidebar( 'right' );
				}
			?>
		</div><!-- end row -->
	</div><!-- end container -->
</div><!-- end page wrap -->

<?php get_footer(); ?>
