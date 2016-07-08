<?php

define( 'MY_THEME_BASE_PATH', get_stylesheet_directory() );
define( 'MY_THEME_BASE_URI', get_stylesheet_directory_uri() );
define( 'MY_THEME_ASSETS_URI', MY_THEME_BASE_URI . '/assets' );
define( 'MY_THEME_BUILD_URI', MY_THEME_BASE_URI . '/build' );
define( 'MY_THEME_VERSION', '1.0' );

require_once 'includes/theme-enqueue.php';
require_once 'includes/author-rewrite-rules.php';
require_once 'includes/wpcrowd-acf.php';

class my_theme {

	protected $theme_enqueue;

	function __construct() {
		$this->theme_enqueue = new my_theme_enqueue();
	}

	function theme_enqueue() {
		$this->theme_enqueue->theme_scripts();
	}

	function theme_setup() {
		add_theme_support( 'title-tag' );

		register_nav_menus( array(
			'top_header' 	=> __( 'Top Header', 'wpcrowd' ),
			'header'		=> __( 'Header Menu', 'wpcrowd' ),
			'footer_left' 	=> __( 'Footer Menu (Left)', 'wpcrowd' ),
			'footer_right' 	=> __( 'Footer Menu (Right)', 'wpcrowd' ),
		) );

	}

	function register_sidebars() {
		register_sidebar( array(
							'name' 			=> __( 'Home Sidebar', 'wpcrowd' ),
							'id' 			=> 'home-sidebar',
							'description' 	=> __( 'Home Page Sidebar. ', 'wpcrowd' ),
							'before_widget' => '<section id="%1$s" class="widget %2$s">',
							'after_widget' 	=> '</section>',
							'before_title' 	=> '<h4 class="widgettitle">',
							'after_title' 	=> '</h4>',
						)
		);

		register_sidebar( array(
							'name' 			=> __( 'Single Sidebar', 'wpcrowd' ),
							'id' 			=> 'single-sidebar',
							'description' 	=> __( 'Single Post Sidebar. ', 'wpcrowd' ),
							'before_widget' => '<section id="%1$s" class="widget %2$s">',
							'after_widget' 	=> '</section>',
							'before_title' 	=> '<h4 class="widgettitle">',
							'after_title' 	=> '</h4>',
						) 
		);
	}

	function author_rewrite_init() {
		$author_rewrite = new wpcrowd_admin_rewrites();
		$author_rewrite->add_admin_cpt_rewrite();
	}

	function gmaps_head() {

		/* TODO: this should be moved to the enqueue file */

		global $post;
		if( is_page( 'contributors' ) ) {
			echo '<script async defer
		        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvwRWaA2cVMOJDGB9qz3YaladDBJtApBE&callback=initMap">
			</script>';
		}
	}

}

$my_theme = new my_theme();

add_action( 'wp_enqueue_scripts', array( $my_theme, 'theme_enqueue' ) );
add_action( 'after_setup_theme', array( $my_theme, 'theme_setup' ) );
add_action( 'widgets_init', array( $my_theme, 'register_sidebars' ) );
add_action( 'init', array( $my_theme, 'author_rewrite_init' ) );
add_action( 'wp_head', array( $my_theme, 'gmaps_head' ) );
add_theme_support( 'post-thumbnails' ); 


function get_protocol(){
    if ( isset($_SERVER['HTTPS'] ) &&
        ( $_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1 ) ||
        isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ) {
      $protocol = 'https://';
    }
    else {
      $protocol = 'http://';
    }
    return $protocol;
}
add_theme_support( 'post-thumbnails' );
