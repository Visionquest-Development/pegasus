<form role="search" method="get" class="searchform search-form form-inilne ms-auto me-0" action="<?php echo home_url( '/' ); ?>">
	<label class="screen-reader-text search-label" for="header_s"><?php echo _x('Search for:', 'label', 'pegasus') ?></label>
	<div class="form-group mb-0">
		<div class="input-group">
			<input type="search"
				   id="header_s"
				   class="search-field form-control"
				   name="s"
				   value="<?php echo esc_attr( get_search_query() ); ?>"
				   title="<?php echo esc_attr_x('Search for:', 'label', 'pegasus') ?>"
				   placeholder="<?php echo esc_attr_x('Search …', 'placeholder', 'pegasus') ?>"
				   aria-label="Search"
			/>
			<button class="btn btn-primary searchSubmit" type="submit" title="Search">
					Search
				</button>
		</div>
	</div>
</form>
