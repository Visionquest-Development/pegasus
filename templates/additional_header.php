
<!-- Additional Header
================================================== -->
<?php


	$global_additional_header_choice = pegasus_get_option( 'global_additional_header_option' );
	$post_additional_header_choice = get_post_meta( get_the_ID(), 'pegasus_page_header_select', true ) ? get_post_meta( get_the_ID(), 'pegasus_page_header_select', true ) : 'no-header';

	$additional_header_choice = $global_additional_header_choice;

	if ( 'no-header' !== $post_additional_header_choice ) {
		$additional_header_choice = $post_additional_header_choice;
	}

	$global_the_header_content = ! empty( pegasus_get_option( 'global_page_header_wysiwyg' ) ) ? pegasus_get_option( 'global_page_header_wysiwyg' ) : '';
	$post_the_header_content = get_post_meta( get_the_ID(), 'pegasus_page_header_wysiwyg', true );

	$the_header_content = ! empty ( $post_the_header_content ) ? $post_the_header_content : $global_the_header_content;

	switch ( $additional_header_choice ) {
		case "no-header":
			break;

		case "space":
			?>
				<div class="noheader-spacer"></div>
			<?php
			break;
		case "sml-header":
			/*========= SMALL HEADER ==========*/
			?>
			<section id="small-header" class="small-header parallax parallax-image">
				<div class="overlay" ></div>
				<div class="container">
					<div class="parallax-content">
						<div class="pegasus-header-content">
							<?php echo $the_header_content; ?>
						</div>
					</div>
				</div>
			</section>
			<?php
			break;
		case "lrg-header":
			/*==================================
			============ LARGE HEADER ==========
			===================================*/
			?>
			<section id="large-header" class="large-header parallax-image" >
				<canvas id="demo-canvas"></canvas>
				<div class="pegasus-header-content container">
					<?php echo $the_header_content; ?>
				</div>
			</section>
			<?php
			break;
	}
?>
