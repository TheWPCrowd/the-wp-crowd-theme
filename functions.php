<?php

define( 'WPCROWDTHEMEVERSION', '0.1' );

class wp_crowd_theme {
	
	function __init(){
		
		add_action( 'wp_enqueue_scripts', array( $this, '__wp_crowd_css' ) );
		add_action( 'wp_enqueue_scripts', array( $this, '__wp_crowd_js' ) );
		$this->__register_menus();
	}
	
	function __register_menus() {
		
		register_nav_menus( array(
			'main_nav' => 'Main Navigation'
		));
		
	}
	
	function __wp_crowd_css() {
		
		wp_enqueue_style( 'wp_crowd_styles', get_template_directory_uri().'/build/css/wp_crowd_styles.css', null, WPCROWDTHEMEVERSION, 'all' );
		wp_enqueue_style( 'google_fonts', 'http://fonts.googleapis.com/css?family=Lato:300,400,700', array( 'wp_crowd_styles' ), WPCROWDTHEMEVERSION, 'all' );
		
	}
	
	function __wp_crowd_js() {		
		
		wp_enqueue_script( 'wp_crowd_bootstrap', get_template_directory_uri().'/build/js/bootstrap.js', array( 'jquery' ), WPCROWDTHEMEVERSION, true );
		
	}
	
}

$wp_crowd = new wp_crowd_theme();
$wp_crowd->__init();


?>