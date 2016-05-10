<?php

class my_theme_enqueue {

	function theme_scripts() {

		if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) {
			wp_enqueue_script( 'my-theme-main-js', MY_THEME_BUILD_URI . '/js/scripts.js', array( 'jquery' ), MY_THEME_VERSION, false );
			wp_enqueue_style( 'my-theme-main-css', MY_THEME_BUILD_URI . '/css/styles.css', array(), MY_THEME_VERSION, 'all' );
		} else {
			wp_enqueue_script( 'my-theme-main-js', MY_THEME_BUILD_URI . '/js/scripts.min.js', array( 'jquery' ), MY_THEME_VERSION, false );
			wp_enqueue_style( 'my-theme-main-css', MY_THEME_BUILD_URI . '/css/styles.min.css', array(), MY_THEME_VERSION, 'all' );
		}

	}

}
