<?php
if ( has_nav_menu( 'social-icons' ) ) {
    // User has assigned menu to this location;
    // output it
    wp_nav_menu( array( 
       'container'		=> false,
		'theme_location'  => 'social-icons',
		'menu_class'	=> 'nav navbar-nav pegasus-social',
    ) );
}else{
	echo 'Please select menu';
}
?>