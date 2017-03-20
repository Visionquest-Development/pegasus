
<ul id="pegasus-mega-menu" class="nav navbar-nav sf-menu">
	<li class="the-more-link">
		<div class="">
			<div class="">

				<?php 
					$args2 = array(
						'theme_location'	=> 'mega-one',
						'menu_class'	=> 'nav ',
						'container'		=> 'false'
					);
					wp_nav_menu( $args2 );
					
				?>
		
			</div>
			
		</div>
		<a class="trigger" href="#">More</a>
	</li>
</ul>