<?php
	get_header();
	the_post();

	$gallery_images = get_post_meta( $post->ID, '_wpcrowd_gallery', true );

?>

	<div class="col-sm-12">
		<?php
			echo '<h2>'.get_the_title().'</h2>';

			the_content();

			echo '<h3>Gallery</h3>';
			foreach( $gallery_images as $key => $value ) {
				echo '<div class="col-sm-4">';
					echo '<img src="'.$value.'" alt="'.get_the_title().' gallery" style="margin:0 auto" class="img-responsive" />';
				echo '</div>';
			}

		?>
	</div>

<?php get_footer(); ?>