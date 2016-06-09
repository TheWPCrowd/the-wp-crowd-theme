<?php
get_header();
the_post();
?>

<div class="container single-container">
	<div class="row">
		<div class="col-sm-8 content">
			<h2 class="single-title"><?php the_title(); ?></h2>
			<div class="single-top">
				<?php
					if( 'podcast' == get_post_type() ) {
						$people_terms = wp_get_post_terms( $post->ID, 'people', array( 'fields' => 'all' ) );
						$podcasters = array();
						if( !empty( $people_terms ) ) {
							foreach( $people_terms as $person ) {
								$associated_user = get_field( 'associated_user', $person->taxonomy . '_' . $person->term_id );
								if( $associated_user ) {
									$podcasters[] = $associated_user['ID'];
								}
							}
						}
						echo '<div class="embed-responsive embed-responsive-16by9"><iframe id="podcast" class="embed-responsive-item" src="https://www.youtube.com/embed/' . get_field( 'youtube_video_id', $post->ID) . '" frameborder="0" allowfullscreen></iframe></div>';
						echo '<div class="podcast-people">';
							echo '<strong>In This Episode</strong>';
							foreach( $podcasters as $user ) {
								echo '<a href="' . get_author_posts_url( $user ) . '">';
									echo get_avatar( $user, 300, '', 'The WP Crowd', array( 'class' => 'img-responsive' ) );
									$usermeta = get_user_meta( $user );
									echo $usermeta['first_name'][0] . ' ' . $usermeta['last_name'][0];
								echo '</a>';
							}
						echo '</div>';
					} else {
						the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
						echo '<div class="author-meta row">';
							echo '<div class="col-sm-2 author-avatar text-center">';
								echo get_avatar( $post->post_author, 300, '', 'The WP Crowd', array( 'class' => 'img-responsive' ) );
							echo '</div>';
							echo '<div class="col-sm-9">';
								echo '<h3>' . get_the_author() . '</h3>';
								if( get_field( 'title', 'user_'.$post->post_author ) ) :
									echo '<h5>';
										$title = get_field( 'title', 'user_'.$post->post_author );
										$title = str_replace( '-', ' ', $title );
										$title = str_replace( '_', ' ', $title );
										echo $title;
									echo '</h5>';
								endif;
								$user = get_user_by( 'id', $post->post_author );
								if( get_field( 'biography', 'user_'.$user->ID ) ) :
									echo '<a href="' . get_author_posts_url( $user->ID ) . '" class="bio circle">
										<i>BIO</i>
									</a>';
								endif;
								if( get_field( 'twitter_handle', 'user_'.$user->ID ) ) :
									echo '<a href="https://twitter.com/' . get_field( 'twitter_handle', 'user_'.$user->ID ) . '" target="_blank" class="circle">
										<i class="fa fa-twitter" aria-hidden="true"></i>
									</a>';
								endif;
								if( get_field( 'facebook_url', 'user_'.$user->ID ) ) :
									echo '<a href="' . get_field( 'facebook_url', 'user_'.$user->ID ) . '" target="_blank" class="circle">
										<i class="fa fa-facebook" aria-hidden="true"></i>
									</a>';
								endif;
								if( $user->user_url ) :
									echo '<a href="' . $user->user_url . '" target="_blank" class="circle">
										<i class="fa fa-home" aria-hidden="true"></i>
									</a>';
								endif;
							echo '</div>';
						echo '</div>';
						echo '<div class="categories">';
							echo '<strong>Topics:</strong>';
							echo get_the_category_list();
						echo '</div>';
					}
				?>
			</div>
			<div class="content-container">
				<?php
					the_content();
					comments_template();
				?>
			</div>
		</div>
		<div class="col-sm-4 sidebar">
			<?php dynamic_sidebar( 'single-sidebar' ); ?>
		</div>
	</div>
</div>


<?php
get_footer();