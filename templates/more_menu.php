<?php

	$home_url = esc_url( home_url( '/' ) ) ? esc_url( home_url( '/' ) ) : '#';
	$fallback_menu = '<ul id="" class="navbar-nav"><li class="nav-item active current-menu-item"><a class="nav-link" href="' . $home_url . '">Home <span class="sr-only">(current)</span></a></li></ul>';

	$mega_menu_widget_choice = absint( pegasus_get_option( 'more_menu_widget_areas' ) );
	$more_menu_widgets = $mega_menu_widget_choice ? $mega_menu_widget_choice : 1;
	$mega_menus_nav_vs_widgets_select = pegasus_get_option('menus_vs_widgets_select');

?>

<ul id="pegasus-mega-menu" class="navbar-nav sf-menu">
	<li class="the-more-link">
		<div class="sf-mega container-fluid">

			<?php
				if( $mega_menu_widget_choice > 0 ) {
					switch ( $more_menu_widgets ) {
						case 1:
							$more_widget_class = 'col-12 col-sm-12 col-md-12 col-lg-12';
							if ( 'navs' === $mega_menus_nav_vs_widgets_select ) {
								echo '<div class="row">';
									echo '<div class="sf-mega-section ' . $more_widget_class . '">';
									echo pegasus_get_menu( 'mega-menu-1', 'mega-sub-menu', 1, $fallback_menu );
									echo '</div>';
								echo '</div>';
							} elseif ( 'widgets' === $mega_menus_nav_vs_widgets_select ) {
								echo '<div class="row">';
									echo '<div class="sf-mega-section ' . $more_widget_class . '">';
									//if ( is_active_sidebar( 'mega-menu-1' ) ) {
										dynamic_sidebar( 'mega-menu-1' );
									//}
									echo '</div>';
								echo '</div>';
							}

							break;
						case 2:
							$more_widget_class = 'col-12 col-sm-12 col-md-6 col-lg-6';
							if ( 'navs' === $mega_menus_nav_vs_widgets_select ) {
								echo '<div class="row">';
								for( $i = 1; $i <= $more_menu_widgets; $i++ ) {
									echo '<div class="sf-mega-section ' . $more_widget_class . '" role="complementary" >';
									echo pegasus_get_menu( 'mega-menu-' . $i, 'mega-sub-menu', 1, $fallback_menu );
									echo '</div><!-- .widget-area -->';
								}
								echo '</div>';
							} elseif ( 'widgets' === $mega_menus_nav_vs_widgets_select ) {
								echo '<div class="row">';
								for( $i = 1; $i <= $more_menu_widgets; $i++ ) {
									echo '<div id="pegasus-more-menu-widget-' . $i . '" class="sf-mega-section ' . $more_widget_class . '" role="complementary" >';
									dynamic_sidebar( 'mega-menu-' . $i );
									echo '</div><!-- .widget-area -->';
								}
								echo '</div>';
							}
							break;
						case 3:
							$more_widget_class = 'col-12 col-sm-12 col-md-6 col-lg-4';
							if ( 'navs' === $mega_menus_nav_vs_widgets_select ) {
								echo '<div class="row">';
								for( $i = 1; $i <= $more_menu_widgets; $i++ ) {
									echo '<div class="sf-mega-section ' . $more_widget_class . '" role="complementary" >';
									echo pegasus_get_menu( 'mega-menu-' . $i, 'mega-sub-menu', 1, $fallback_menu );;
									echo '</div><!-- .widget-area -->';
								}
								echo '</div>';
							} elseif ( 'widgets' === $mega_menus_nav_vs_widgets_select ) {
								echo '<div class="row">';
								for( $i = 1; $i <= $more_menu_widgets; $i++ ) {
									echo '<div id="pegasus-more-menu-widget-' . $i . '" class="sf-mega-section ' . $more_widget_class . '" role="complementary" >';
									dynamic_sidebar( 'mega-menu-' . $i );
									echo '</div><!-- .widget-area -->';
								}
								echo '</div>';
							}
							break;
						case 4:
							$more_widget_class = 'col-12 col-sm-12 col-md-6 col-lg-3';
							if ( 'navs' === $mega_menus_nav_vs_widgets_select ) {
								echo '<div class="row">';
								for( $i = 1; $i <= $more_menu_widgets; $i++ ) {
									echo '<div class="sf-mega-section ' . $more_widget_class . '" role="complementary" >';
									echo pegasus_get_menu( 'mega-menu-' . $i, 'mega-sub-menu', 1, $fallback_menu );
									echo '</div><!-- .widget-area -->';
								}
								echo '</div>';
							} elseif ( 'widgets' === $mega_menus_nav_vs_widgets_select ) {
								echo '<div class="row">';
								for( $i = 1; $i <= $more_menu_widgets; $i++ ) {
									echo '<div id="pegasus-more-menu-widget-' . $i . '" class="sf-mega-section ' . $more_widget_class . '" role="complementary" >';
									dynamic_sidebar( 'mega-menu-' . $i );
									echo '</div><!-- .widget-area -->';
								}
								echo '</div>';
							}
							break;
					}
				} else {
					echo 'Pick one or more "More Menu Widget Areas" in the Theme Settings.';
				}
			?>

		</div>
		<a class="trigger nav-link" href="#">More</a>
	</li>
</ul>