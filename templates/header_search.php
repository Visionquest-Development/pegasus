<form role="search" method="get" id="searchform" class="searchform search-form form-inilne ml-auto mr-0" action="<?php echo home_url( '/' ); ?>">
	<label class="screen-reader-text" for="s"><?php echo _x('Search for:', 'label') ?></label>
	<div class="form-group mb-0">
		<div class="input-group">
			<input type="search"
				   id="s"
				   class="search-field form-control"
				   name="s"
				   value="<?php echo get_search_query() ?>"
				   title="<?php echo esc_attr_x('Search for:', 'label') ?>"
				   placeholder="<?php echo esc_attr_x('Search …', 'placeholder') ?>"
				   aria-label="Search"
			/>
			<span class="input-group-btn">
					<button class="btn btn-primary" type="submit" id="searchsubmit" title="Search">
						Search
					</button>
				</span>
		</div>
	</div>
</form>