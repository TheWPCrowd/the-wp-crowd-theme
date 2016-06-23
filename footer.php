<?php

global $post;

if ( get_post_type( $post->ID ) != 'portfolio' ) {

	$sidebar_col_span = 4;

	/* if this is front page, narrow the column for the sidebar */
	if ( is_front_page() )
		$sidebar_col_span = 3;

?>

	<div class="col-sm-<?php echo $sidebar_col_span;?>">
		<?php if ( is_active_sidebar( 'default-sidebar' ) ) : ?>
			<ul class="sidebar">
				<?php dynamic_sidebar( 'default-sidebar' ); ?>
			</ul>
		<?php endif; ?>
	</div>


<?php } ?>



			</div> <!-- end row -->
		</div> <!-- end container -->
	
	<?php if( ! is_front_page() ) { ?>

	<footer class="container-fluid">
		<div class="container">
			<nav class="row">
				<?php wp_nav_menu( array( 'menu' => 'Main Menu', 'container' => '', 'menu_class' => 'col-xs-12' ) ); ?>
			</nav>
		</div>
	</footer>

	<?php } else { ?>

		<img src="<?php echo get_template_directory_uri() . '/build/img/people.png'?>" class="people_img" alt="<?php _e( 'The WP Crowd', 'thewpcrowd' );?>" />
	
	<?php } ?>
	</body>
</html>