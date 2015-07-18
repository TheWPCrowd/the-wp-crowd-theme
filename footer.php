			</div> <!-- end row -->
		</div> <!-- end container -->
	
	<?php if( !is_front_page() ): ?>
	<footer class="container-fluid">
		<div class="container">
			<nav class="row">
				<?php wp_nav_menu( array( 'menu' => 'Main Menu', 'container' => '', 'menu_class' => 'col-xs-12' ) ); ?>
			</nav>
		</div>
	</footer>
	<?php endif; wp_footer(); ?>
	<?php if( is_front_page() ): ?>
		<img src="<?php echo get_template_directory_uri().'/build/img/people.png'?>" class="people_img" alt="The WP Crowd" />
	<?php endif; ?>
	</body>
</html>