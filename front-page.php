<?php
	get_header();
?>
	<div class="col-xs-12 col-md-5">
		<div id="home_content">
			<?php
				$last_podcast = new WP_Query( array( 'post_type' => 'podcast', 'posts_per_page' => 1 ) );
				$podcast = $last_podcast->posts[0];	
			?>
			<h2><a href="<?php echo get_permalink( $podcast->ID ); ?>"><?php echo $podcast->post_title; ?></a></h2>
			<?php if( get_field( 'youtube_video_id' , $podcast->ID ) ): ?>
			<div class="embed-responsive embed-responsive-16by9">
				<iframe id="podcast" class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo get_field( 'youtube_video_id', $podcast->ID); ?>" frameborder="0" allowfullscreen></iframe>
			</div>
			<?php else: ?>
			<img class="img-responsive" src="<?php get_stylesheet_directory_uri(). '/build/img/wp_crowd_logo.jpg'; ?>" alt="The WP Crowd" />
			<?php endif; ?>
			<div class="meta">Running Time: <?php echo get_field( 'runtime', $podcast->ID); ?></div>
			
			<div class="text-right past_podcasts">
				<a href="/podcast">Past Podcasts</a>
			</div>
		</div>
	</div>
<?php 
	get_footer();
?>