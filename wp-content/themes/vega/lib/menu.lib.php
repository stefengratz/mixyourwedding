<?php
/*
 *  Setup main navigation menu
 */
add_action( 'init', 'register_my_menu' );
function register_my_menu() {
	register_nav_menu( 'left-menu', __( 'Main Menu Left Side', THEMEDOMAIN ) );
	register_nav_menu( 'right-menu', __( 'Main Menu Right Side', THEMEDOMAIN ) );
}
?>