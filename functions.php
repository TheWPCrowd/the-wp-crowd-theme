<?php

define( 'WPCROWDTHEMEVERSION', '0.1' );

class wp_crowd_theme {
	
	function __init(){
		
		add_action( 'wp_enqueue_scripts', array( $this, '__wp_crowd_css' ) );
		add_action( 'wp_enqueue_scripts', array( $this, '__wp_crowd_js' ) );
		$this->__register_menus();
		$this->__register_sidebars();
		
		add_filter('give_donation_total_label', array( $this, 'new_give_donation_total_text' ) );

	}
	
	function __register_menus() {
		
		register_nav_menus( array(
			'main_nav' => 'Main Navigation'
		));
		
	}
	
	function __register_sidebars() {
		$args = array(
			'name'          => __( 'Default Sidebar', 'wpcrowd' ),
			'id'            => 'default-sidebar',
			'description'   => '',
			'class'         => '',
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h4 class="widgettitle">',
			'after_title'   => '</h4>' 
		);
		register_sidebar( $args );
	}
	
	function __wp_crowd_css() {
		
		wp_enqueue_style( 'wp_crowd_styles', get_template_directory_uri().'/build/css/min/wp_crowd_styles.css', null, WPCROWDTHEMEVERSION, 'all' );
		wp_enqueue_style( 'google_fonts', 'http://fonts.googleapis.com/css?family=Lato:300,400,700', array( 'wp_crowd_styles' ), WPCROWDTHEMEVERSION, 'all' );
		
	}
	
	function __wp_crowd_js() {		
		
		wp_enqueue_script( 'wp_crowd_bootstrap', get_template_directory_uri().'/build/js/bootstrap.js', array( 'jquery' ), WPCROWDTHEMEVERSION, true );
		
	}
	
	function new_give_donation_total_text() {    
	    return __('Support Total', 'give');
	}
	
}

$wp_crowd = new wp_crowd_theme();
$wp_crowd->__init();


?>