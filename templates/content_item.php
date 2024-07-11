<?php
global $post;
$terms = get_the_terms( $post->ID, 'category' );

if ( $terms && ! is_wp_error( $terms ) ) :
	$links = array();

	foreach ( $terms as $term ) {
		$links[] = $term->name;
	}
	$links = str_replace( ' ', '-', $links );
	$tax = join( " ", $links );
else :
	$tax = '';
endif;
?>

<div class="content-item-container <?php echo strtolower( $tax ); ?>">
	<article class="article-<?php the_ID(); ?> block-inner ">

		<div class="content-item-image">
			<img src="<?php echo pegasus_image_display( 'thumbnail', '', false ); ?>" alt="">
		</div>

		<div class="content-item-wrapper">
			<!-- the permalink and title -->
			<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
				<h3 class="content-item-title"><?php the_title(); ?></h3>
			</a>
			<?php
				$the_time = the_time( 'l, F jS, Y' ) ? the_time( 'l, F jS, Y' ) : '';
				if ( '' !== $the_time ) :
			?>
				<em>
					<p class="content-item-date-time">
						<?php echo $the_time;?>
					</p>
				</em>
			<?php
				endif;
			?>

			<div class="content-item-cats"><i><?php the_category(); ?></i></div>

			<!-- output the excerpt, and if no excerpt then output content-->
			<!-- output is limited to the first 300 characters then an elipsis (...) is added and a read more link appears -->
			<div class="content-item-paragraph-content">
				<?php
				$pegasus_excerpt = get_the_excerpt();
				if( isset( $pegasus_excerpt ) ) { ?>
					<p>
						<?php
						//$temporary_excerpt = substr( strip_tags( $pegasus_excerpt ), 0, 1900 );
						//$final_excerpt = ( $pegasus_excerpt !== $temporary_excerpt ) ? ( $temporary_excerpt . '...') : $pegasus_excerpt;
						//echo $final_excerpt;
						echo $pegasus_excerpt;
						?>
					</p>
				<?php } else {
					$more = 0;
					$pegasus_content = get_the_content();
					//$temporary_content = substr( strip_tags( $pegasus_content ), 0, 1900 );
					//$final_content = ( $pegasus_content !== $temporary_content ) ? ( $temporary_content . '...' ) : $pegasus_content;
					?>
					<p>
						<?php //echo do_shortcode( $final_content ); ?>
						<?php echo do_shortcode( $pegasus_content ); ?>
					</p>
				<?php }	?>
			</div>
			<!-- output a read more button -->
			<a class="button btn btn-primary" href="<?php the_permalink(); ?>"> Read More </a>
		</div>

		<?php
		// Edit post link
		wp_bootstrap_edit_post_link(
			sprintf(
			/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'textdomain' ),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
		?>

	</article>
</div>
