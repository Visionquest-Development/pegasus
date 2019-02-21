<?php
if ( has_nav_menu( 'social-icons' ) ) :
    // User has assigned menu to this location;
    // output it
    $social_menu_check = wp_nav_menu( array(
		'theme_location'  => 'social-icons',
		'menu_class'	=> 'navbar-nav pegasus-social',
		'container'		=> 'ul',
		'echo' => false,
		'depth'				=> 1,
		'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
		'walker'			=> new WP_Bootstrap_Navwalker(),
		'items_wrap'      => '%3$s',
    ) );
	$fallback_social_menu = '<ul><li><a href="#" class="fa fa-facebook">FB</a></li></ul>';
	$final_social_menu = ( null !== $social_menu_check ) ? $social_menu_check : $fallback_social_menu;
?>
<ul class="ml-lg-3 pegasus-social">
	<?php echo $final_social_menu; ?>
</ul>


<?php
else:
	echo '<p style="margin: 10px 0 0;">Select social menu</p>';
endif;
?>