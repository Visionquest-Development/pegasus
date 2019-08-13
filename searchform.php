<?php
	global $post;
	$postid = $post->ID;
	$unique_id = uniqid( $postid );

	/*$is_page_template = is_page_template( 'sidebar-left.php' );
	$page_template_slug = get_page_template_slug( $post->ID );
	if ( $is_page_template ) {
		echo $is_page_template;
	}
	if ( $page_template_slug ) {
		echo $page_template_slug;
	}
	if ( 'sidebar.php' === $is_page_template || 'sidebar.php' === $page_template_slug ) {
		$extra_classes = ' sidebar-shizz ';
	} else {
		$extra_classes = ' form-inilne ml-auto mr-0 ';
	}*/

	//echo '<form role="search" method="get" id="searchform" class="searchform search-form ' . $extra_classes . '" action="' . home_url( '/' ) . '">';
?>
	<form role="search" method="get" class="searchform search-form" action="<?php echo home_url( '/' ); ?>">
		<label class="screen-reader-text search-label" for="s-<?php echo $unique_id; ?>"><?php echo _x('Search for:', 'label') ?></label>
		<div class="form-group mb-0">
			<div class="input-group">
				<input type="search"
					   id="s-<?php echo $unique_id; ?>"
					   class="search-field form-control"
					   name="s"
					   value="<?php echo get_search_query() ?>"
					   title="<?php echo esc_attr_x('Search for:', 'label') ?>"
					   placeholder="<?php echo esc_attr_x('Search …', 'placeholder') ?>"
					   aria-label="Search"
				/>
				<span class="input-group-btn">
					<button class="btn btn-primary searchSubmit" type="submit" title="Search">
						Search
					</button>
				</span>
			</div>
		</div>
	</form>
<?php
	//$search_form_id++;
?>
