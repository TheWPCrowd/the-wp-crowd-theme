<?php 
	get_header(); 
	the_post(); 
	
	$crowd = wp_get_post_terms( $post->ID, 'people', array( 'fields' => 'all' ) );
	$topics = wp_get_post_terms( $post->ID, 'topics', array( 'fields' => 'all' ) );
	
?>
	
	<div class="col-sm-8 content">
		<h2 class="page_title"><?php the_title(); ?></h2>
		<div class="embed-responsive embed-responsive-16by9">
			<iframe id="podcast" class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo get_field( 'youtube_video_id', $post->ID); ?>" frameborder="0" allowfullscreen></iframe>
		</div>

		<div class="topic_in_podcast">
			<strong>Topics:</strong> 
			<?php 
				foreach( $topics as $topic ) {
					echo '<div class="person">' . $topic->name . '</div>';
				}	
			?>
		</div>
		
		<div class="crowd_in_podcast">
			<strong>Crowd Members:</strong> 
			<?php 
				foreach( $crowd as $person ) {
					echo '<div class="person">' . $person->name . '</div>';
				}	
			?>
		</div>
		
		<?php the_content(); ?>
	</div>
	<div class="col-sm-4">
		<?php if ( is_active_sidebar( 'default-sidebar' ) ) : ?>
			<ul class="sidebar">
				<?php dynamic_sidebar( 'default-sidebar' ); ?>
			</ul>
		<?php endif; ?>
	</div>

<?php get_footer(); ?>