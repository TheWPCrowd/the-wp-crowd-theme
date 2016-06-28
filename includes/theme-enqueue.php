<?php

class my_theme_enqueue {

	function theme_scripts() {

		global $post;

		/* enqueue scripts */

		wp_enqueue_script(	'my-theme-main-js', 
							MY_THEME_BUILD_URI . '/js/scripts.min.js', 
							array( 'jquery' ), 
							MY_THEME_VERSION, 
							false 
						);
		

		wp_enqueue_script(	'google-analytics', 
							MY_THEME_BUILD_URI . '/js/google-analytics.js', 
							array( 'jquery' ), 
							MY_THEME_VERSION, 
							false 
						);


		if ( is_page( 'contributors' ) ) {

			/* enqueue maps on the contributor page only */

			wp_enqueue_script(	'google-maps', 
								'https://maps.googleapis.com/maps/api/js?key=AIzaSyCvwRWaA2cVMOJDGB9qz3YaladDBJtApBE&callback=initMap', 
								array( 'jquery' ), 
								MY_THEME_VERSION, 
								false 
							);
		}


		/* enqueue styles */

		wp_enqueue_style(	'my-theme-main-css', 
							MY_THEME_BUILD_URI . '/css/styles.min.css', 
							array(), 
							MY_THEME_VERSION, 
							'all' 
						);
	}

}
