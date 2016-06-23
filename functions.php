<?php

define( 'MY_THEME_BASE_PATH', get_template_directory() );
define( 'MY_THEME_BASE_URI', get_template_directory_uri() );
define( 'MY_THEME_ASSETS_URI', MY_THEME_BASE_URI . '/assets' );
define( 'MY_THEME_BUILD_URI', MY_THEME_BASE_URI . '/build' );
define( 'MY_THEME_VERSION', '1.0' );

<<<<<<< HEAD
class wp_crowd_theme {
	
	function __init(){
		
		add_action( 'wp_enqueue_scripts', array( $this, '__wp_crowd_css' ) );
		add_action( 'wp_enqueue_scripts', array( $this, '__wp_crowd_js' ) );
		$this->__register_menus();
		$this->__register_sidebars();
		
		add_filter( 'give_donation_total_label', array( $this, 'new_give_donation_total_text' ) );
		add_filter( 'excerpt_length', array( $this, 'wpdocs_custom_excerpt_length' ), 999 );
		add_filter( 'xmlrpc_enabled', '__return_false' );
=======
require_once 'includes/theme-enqueue.php';
require_once 'includes/author-rewrite-rules.php';
require_once 'includes/wpcrowd-acf.php';
>>>>>>> origin/v2-build

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
			'top_header'   => __( 'Top Header', 'wp-crowd' ),
			'header'       => __( 'Header Menu', 'wp-crowd' ),
			'footer_left'  => __( 'Footer Menu (Left)', 'wp-crowd' ),
			'footer_right' => __( 'Footer Menu (Right)', 'wp-crowd' ),
		) );

	}

	function register_sidebars() {
		register_sidebar( array(
			'name' => __( 'Home Sidebar', 'wp-crowd' ),
			'id' => 'home-sidebar',
			'description' => __( 'Home Page Sidebar.', 'wp-crowd' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widgettitle">',
<<<<<<< HEAD
			'after_title'   => '</h4>' 
		);
		register_sidebar( $args );
	}
	
	function __wp_crowd_css() {
		
		wp_enqueue_style( 'wp_crowd_styles', get_template_directory_uri() . '/build/css/min/wp_crowd_styles.css', null, WPCROWDTHEMEVERSION, 'all' );
		wp_enqueue_style( 'google_fonts', 'http://fonts.googleapis.com/css?family=Lato:300,400,700', array( 'wp_crowd_styles' ), WPCROWDTHEMEVERSION, 'all' );
		
	}
	
	function __wp_crowd_js() {		
		
		wp_enqueue_script( 'wp_crowd_bootstrap', get_template_directory_uri() . '/build/js/bootstrap.js', array( 'jquery' ), WPCROWDTHEMEVERSION, true );
		wp_enqueue_script( 'wp_crowd_analytics', get_template_directory_uri() . '/google-analytics.js', array( 'jquery' ), WPCROWDTHEMEVERSION, true );
		
	}
	
	function new_give_donation_total_text() {    
	    return __( 'Support Total', 'give' );
	}
	
	function wpdocs_custom_excerpt_length( $length ) {
	    return 40;
=======
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name' => __( 'Single Sidebar', 'wp-crowd' ),
			'id' => 'single-sidebar',
			'description' => __( 'Single Post Sidebar.', 'wp-crowd' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widgettitle">',
			'after_title'   => '</h4>',
		) );
>>>>>>> origin/v2-build
	}

	function author_rewrite_init() {
		$author_rewrite = new wpcrowd_admin_rewrites();
		$author_rewrite->add_admin_cpt_rewrite();
	}

	function gmaps_head() {
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
