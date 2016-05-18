<?php
	get_header();

	/**
	 * Build out page data
	 */
	$queried_object = get_queried_object();
	$user_id = $queried_object->ID;
	$cpt = false;
	if( isset( $wp_query->query_vars['author_cpt'] ) ) {
		$cpt = $wp_query->query_vars['author_cpt'];
	}
	$page = 1;
	if( isset( $wp_query->query_vars['page'] ) ) {
		$page = $wp_query->query_vars['page'];
	}
	$per_page = 6;
	if( $cpt ) {
		$per_page = 12;
	}


	$person = false;
	$podcasts = false;
	if( get_field( 'person_association', 'user_'.$user_id ) ) {
		$person = get_field( 'person_association', 'user_' . $user_id );
		$person = get_term_by( 'id', $person, 'people' );
	}


	$blog_args = array(
		'posts_per_page' => $per_page,
		'page' => $page,
		'paged' => $page,
		'author' => $user_id,
		'post_type' => array( 'post' ),
	);
	$blogs = get_posts( $blog_args );
	$podcast_args = array(
		'posts_per_page' => $per_page,
		'page' => $page,
		'paged' => $page,
		'post_type' => array( 'podcast' ),
		'tax_query' => array(
			array(
				'taxonomy' => 'people',
				'field' => 'id',
				'terms' => $person->term_id
			)
		)
	);
	$podcasts = get_posts( $podcast_args );
	$articles = array_merge( $blogs, $podcasts );


	/** Author Info */
	$user = get_user_by( 'id', $user_id );
	$usermeta = get_user_meta( $user_id );
	$author_name = $user->user_nicename;
	if( $usermeta['first_name'][0] && $usermeta['last_name'][0] ) {
		$author_name = $usermeta['first_name'][0] . ' ' . $usermeta['last_name'][0];
	}

?>

<div class="container" id="author-top">
	<div class="row">
		<div class="col-sm-8">
			<div class="avatar-wrapper">
				<?php echo get_avatar( $user_id, 150, '', 'The WP Crowd', array( 'class' => 'img-responsive' ) ); ?>
				<h2><?php echo $author_name; ?></h2>
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
			</div>
				<?php
				if( get_field( 'biography', 'user_'.$user_id ) ) {
					echo '<div class="bio">';
					the_field( 'biography', 'user_' . $user_id );
					echo '</div>';
				}
				?>
		</div>
		<div class="col-sm-4">
			<div class="author-info">
				<?php if( get_field( 'location', 'user_'.$user_id ) ) : ?>
					<div class="location">
						<i class="fa fa-map-marker" aria-hidden="true"></i>
						<?php the_field( 'location', 'user_'.$user_id ); ?>
					</div>
				<?php endif; ?>
				<div class="social-links">
					<?php if( get_field( 'twitter_handle', 'user_'.$user->ID ) ) : ?>
						<a href="https://twitter.com/<?php echo get_field( 'twitter_handle', 'user_'.$user->ID ); ?>" target="_blank" class="circle">
							<i class="fa fa-twitter" aria-hidden="true"></i>
							<?php echo '@'.get_field( 'twitter_handle', 'user_'.$user->ID ); ?>
						</a>
					<?php endif; ?>
					<?php if( get_field( 'facebook_url', 'user_'.$user->ID ) ) : ?>
						<a href="<?php echo get_field( 'facebook_url', 'user_'.$user->ID ); ?>" target="_blank" class="circle">
							<i class="fa fa-facebook" aria-hidden="true"></i>
							Facebook
						</a>
					<?php endif; ?>
					<?php if( $user->user_url ) : ?>
						<a href="<?php echo $user->user_url; ?>" target="_blank" class="circle">
							<i class="fa fa-home" aria-hidden="true"></i>
							<?php echo $user->user_url; ?>
						</a>
					<?php endif; ?>
					<a class="circle" href="<?php echo get_author_posts_url( $user_id ); ?>"><i class="fa fa-user"></i>The WP Crowd Profile</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="home-main" class="container author-archive">
	<div class="row">
		<div class="col-sm-12">
			<?php if( !empty( $articles ) ) : ?>
			<div class="latest-podcast-wrapper">
				<div class="headline">
					<h2>Podcast <strong>Videos</strong></h2>
					<?php if( !$cpt ) : ?>
						<a href="<?php echo get_author_posts_url( $user_id ); ?>podcast/page/1">See All <strong>videos</strong> with <?php echo $author_name; ?></a>
					<?php endif; ?>
				</div>
				<div class="row latest-entries podcast">
					<?php
						$i=0;
						foreach( $articles as $post ):
					?>
						<article class="col-sm-4 single-entry">
							<a href="<?php the_permalink(); ?>" class="featured-image <?php echo $post->post_type; ?>">
								<?php if( $post->post_type == 'podcast' ) { ?>
									<img src="http://img.youtube.com/vi/<?php echo get_field( 'youtube_video_id', $post->ID ); ?>/hqdefault.jpg" class="img-responsive" alt="<?php echo get_the_title(); ?> Podcast" />
								<?php } else { ?>
									<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
								<?php } ?>
							</a>
							<h3>
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h3>
							<div class="featured-meta">
								<span class="date"><?php echo get_the_date( 'F j, Y', $post->ID ); ?></span>
								<span class="hearts"></span>
							</div>
						</article>
					<?php $i++; endforeach; ?>
				</div>
				<div class="col-sm-12 text-right">
					<?php wp_pagenavi( array( 'query' => $podcasts ) ); ?>
				</div>
			</div>
			<?php endif; wp_reset_query(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
