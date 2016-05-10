<?php
get_header();
$podcasts = new WP_Query( array( 'post_type' => 'podcast' ) );
$first_podcast = $podcasts->posts[0];
?>

<div class="container">
	<!-- HOME TOP -->
	<div id="home-top" class="row">
		<div class="col-sm-8 featured-image" style="background-image: url(http://img.youtube.com/vi/<?php echo get_field( 'youtube_video_id', $first_podcast->ID ); ?>/hqdefault.jpg);">
			<a href="<?php echo get_permalink( $first_podcast->ID ); ?>">

			</a>
		</div>
		<div class="col-sm-4 featured-info">
			<h3>
				<a href="<?php echo get_permalink( $first_podcast->ID ); ?>">
					<?php echo get_the_title( $first_podcast->ID ); ?>
				</a>
			</h3>
			<div class="featured-meta">
				<span class="date"><?php echo get_the_date( 'F j, Y', $first_podcast->ID ); ?></span>
				<span class="hearts"></span>
			</div>
		</div>
	</div>
	
	
	
</div>

<?php get_footer(); ?>
