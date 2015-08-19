<?php 
	get_header(); 
	the_post(); 
	
	if( isset( $_POST['__crowd_attending'] ) ) {
		wp_set_post_terms( $post->ID, $_POST['__crowd_attending'], 'people' );
	}
	
	$crowd = wp_get_post_terms( $post->ID, 'people', array( 'fields' => 'all' ) );
	$guests = wp_get_post_terms( $post->ID, 'guest', array( 'fields' => 'all' ) );
	$topics = wp_get_post_terms( $post->ID, 'topics', array( 'fields' => 'all' ) );
	
	$chat_on = 'true';
	if( get_field( 'chat_available' ) == false )
		$chat_on = 'false';
	
?>
	
	<div class="col-sm-8 content <?php echo 'chat_'.$chat_on; ?> ">
		<h2 class="page_title"><?php the_title(); ?></h2>
		<div class="post_meta"><em>Air Date: <?php the_field( 'air_date' ); ?> @ <?php the_field( 'air_time' ); ?></em></div>
		<?php 
			if( isset( $_GET['rsvp'] ) ): 
			$all_crowd = get_terms( 'people', array( 'hide_empty' => false ) );
		?>
		<form method="post" action="<?php echo get_the_permalink(); ?>">
			<h3>Attending</h3>
			<p>If you are attending, check the box next to your name and hit save</p>
			<?php 
				foreach( $all_crowd as $person ) {
					echo '<div class="checkbox">';
						echo '<label>';
							echo '<input type="checkbox" name="__crowd_attending[]" value="' . $person->term_id . '"';
							if(has_term( $person->name, 'people' )) { echo 'checked="checked"'; }
							echo ' />';
							echo $person->name;
						echo '</label>';					
					echo '</div>';
				}
			?>
			
		<input type="submit" value="Save" class="btn btn-block btn-primary" />	
		</form>
		
		<?php else: ?>
		<div class="embed-responsive embed-responsive-16by9">
			<iframe id="podcast" class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo get_field( 'youtube_video_id', $post->ID); ?>" frameborder="0" allowfullscreen></iframe>
		</div>

		<div class="topic_in_podcast">
			<strong>Topics:</strong> 
			<?php 
				foreach( $topics as $topic ) {
					echo '<a href="/topics/' . $topic->slug. '" class="person">' . $topic->name . '</a>';
				}	
			?>
		</div>
		
		<div class="crowd_in_podcast">
			<strong>Crowd Members:</strong> 
			<?php 
				foreach( $crowd as $person ) {
					echo '<a href="/people/' . $person->slug . '" class="person">' . $person->name . '</a>';
				}	
			?>
		</div>
		
		<?php if( !empty( $guests ) ): ?>
		<div class="crowd_in_podcast">
			<strong>Guests:</strong> 
			<?php 
				foreach( $guests as $person ) {
					$meta = Taxonomy_MetaData::get( 'guest', $person->term_id );

					
					if( isset( $meta['person_twitter'] ) ) {
						echo '<a target="_blank" href="https://twitter.com/' . $meta['person_twitter'] . '" class="person"> ' . $person->name . '</a>';
					} else {
						echo '<span class="person">' . $person->name . '</span>';	
					}
				}	
			?>
		</div>
		<?php endif; ?>
		<?php 
			
			echo '<h2>Episode Description</h2>';
			the_content(); 
			
			if( get_field( 'meme_of_the_week' ) ):
				echo '<h2>MEME of the week</h2>';
				$meme_pic = get_field( 'meme_of_the_week' );
				$meme_src = $meme_pic['sizes']['large'];
				echo '<img src="' . $meme_src . '" class="img-responsive" alt="WP Crowd" />';
				
			endif;
			
			comments_template();
			endif; 
			
		?>
	</div>
	<div class="col-sm-4">
		<?php if ( is_active_sidebar( 'default-sidebar' ) ) : ?>
			<ul class="sidebar">
				<?php dynamic_sidebar( 'default-sidebar' ); ?>
			</ul>
		<?php endif; ?>
	</div>

<?php get_footer(); ?>