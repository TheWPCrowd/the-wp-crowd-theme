<?php
/*
 * Template Name: Contributors
 */
	get_header();
	global $wpdb;
	$min_posts = 1; // Make sure it's int, it's not escaped in the query
	$author_ids = $wpdb->get_col("SELECT `post_author` FROM
	    (SELECT `post_author`, COUNT(*) AS `count` FROM {$wpdb->posts}
	        WHERE `post_status`='publish' GROUP BY `post_author`) AS `stats`
	    WHERE `count` >= {$min_posts} ORDER BY `count` DESC;");

	$people_terms = get_terms( 'people' );
	$podcasters = array();
	if( !empty( $people_terms ) ) {
		foreach( $people_terms as $person ) {
			$associated_user = get_field( 'associated_user', $person->taxonomy . '_' . $person->term_id );
			if( $associated_user ) {
				$podcasters[] = $associated_user['ID'];
			}
		}
	}
	$author_ids = array_merge( $author_ids, $podcasters );
	$author_ids = array_unique( $author_ids );
?>
<div id="map"></div>

<div class="container">
	<div class="row">
		<div class="col-sm-12 text-center contributors-wrapper">
			<h1>Contributors</h1>
			<div class="row">
				<?php
					foreach( $author_ids as $author ):
						if( $author == 1 ) { continue; }
						$user = get_user_by( 'id', $author );
						$usermeta = get_user_meta( $user->ID );
						$author_name = $user->user_nicename;
						if( $usermeta['first_name'][0] && $usermeta['last_name'][0] ) {
							$author_name = $usermeta['first_name'][0] . ' ' . $usermeta['last_name'][0];
						}
						$location = get_field( 'location', 'user_'.$user->ID );
				?>
					<article class="col-sm-3 contributor-wrapper" data-loc="<?php echo $location; ?>">
						<div class="contributor">
							<div class="contributor-image">
								<a href="<?php echo get_author_posts_url( $user->ID ); ?>">
									<?php echo get_avatar( $user->ID, 300, '', 'The WP Crowd', array( 'class' => 'img-responsive' ) ); ?>
								</a>
							</div>
							<div class="contributor-meta">
								<h3>
									<a href="<?php echo get_author_posts_url( $user->ID ); ?>">
										<?php echo $author_name; ?>
									</a>
								</h3>
								<?php if( get_field( 'title', 'user_'.$user->ID ) ) : ?>
									<h5>
										<?php
											$title = get_field( 'title', 'user_'.$user->ID );
											$title = str_replace( '-', ' ', $title );
											$title = str_replace( '_', ' ', $title );
											echo $title;
										?>
									</h5>
								<?php endif; ?>
								<?php if( $location ) : ?>
									<div class="location">
										<i class="fa fa-map-marker" aria-hidden="true"></i>
										<?php echo $location; ?>
									</div>
								<?php endif; ?>
								<?php if( get_field( 'biography', 'user_'.$user->ID ) ) : ?>
									<a href="<?php echo get_author_posts_url( $user->ID ); ?>" class="bio circle">
										<i>BIO</i>
									</a>
								<?php endif; ?>
								<?php if( get_field( 'twitter_handle', 'user_'.$user->ID ) ) : ?>
									<a href="https://twitter.com/<?php echo get_field( 'twitter_handle', 'user_'.$user->ID ); ?>" target="_blank" class="circle">
										<i class="fa fa-twitter" aria-hidden="true"></i>
									</a>
								<?php endif; ?>
								<?php if( get_field( 'facebook_url', 'user_'.$user->ID ) ) : ?>
									<a href="<?php echo get_field( 'facebook_url', 'user_'.$user->ID ); ?>" target="_blank" class="circle">
										<i class="fa fa-facebook" aria-hidden="true"></i>
									</a>
								<?php endif; ?>
								<?php if( $user->user_url ) : ?>
									<a href="<?php echo $user->user_url; ?>" target="_blank" class="circle">
										<i class="fa fa-home" aria-hidden="true"></i>
									</a>
								<?php endif; ?>
							</div>
						</div>
					</article>
				<?php
					endforeach;
				?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
