<?php
function register_navwalker() {
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}

add_action( 'after_setup_theme', 'register_navwalker' );