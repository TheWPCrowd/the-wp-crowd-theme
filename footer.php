			</div> <!-- end row -->
		</div> <!-- end container -->

	<?php wp_footer(); ?>
	<?php if( is_front_page() ): ?>
		<img src="<?php echo get_template_directory_uri().'/build/img/people.png'?>" class="people_img" alt="The WP Crowd" />
	<?php endif; ?>
	</body>
</html>