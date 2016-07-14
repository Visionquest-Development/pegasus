	<?php get_header(); ?>
	
 

    <div id="page-wrap">
      <!-- Example row of columns -->
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<div class="inner-content">	
						<?php woocommerce_content(); ?>
					</div><!--end inner content-->
				</div>
				<?php get_sidebar(); ?>
		   
			</div><!--end row -->
		</div><!-- end container -->
	</div><!-- end page wrap -->

    <?php get_footer(); ?>