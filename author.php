<?php
get_header();

/**
 * Build out page data
 */
$queried_object = get_queried_object();
$user_id = $queried_object->ID;
$cpt = false;
if ( isset( $wp_query->query_vars['author_cpt'] ) ) {
	$cpt = $wp_query->query_vars['author_cpt'];
}
$page = 1;
if ( isset( $wp_query->query_vars['page'] ) ) {
	$page = $wp_query->query_vars['page'];
}
$per_page = 6;
if ( $cpt ) {
	$per_page = 12;
}
query_posts( 'posts_per_page=' . $per_page . '&page=' . $page . '&paged=' . $page . '&author=' . $user_id );
$person = false;
$podcasts = false;
if ( get_field( 'person_association', 'user_' . $user_id ) ) {
	$person = get_field( 'person_association', 'user_' . $user_id );
}
$args = array( 'post_type' => array( 'wplife', 'podcast' ), 'posts_per_page' => $per_page );;

if ( $person && $cpt != 'posts' ) {
	$person = get_term_by( 'id', $person, 'people' );
	if( $person ) {
		$args['people'] = $person->slug;
		if ( $cpt && $cpt == 'podcast' ) {
			$args['paged'] = $page;
			$args['page']  = $page;
		}
		$podcasts = new WP_Query( $args );
	}
}

$args['post_type'] = 'showcase';
$showcase = new WP_Query( $args );

/** Author Info */
$user = get_user_by( 'id', $user_id );
$usermeta = get_user_meta( $user_id );
$author_name = $user->user_nicename;
if ( $usermeta['first_name'][0] && $usermeta['last_name'][0] ) {
	$author_name = $usermeta['first_name'][0] . ' ' . $usermeta['last_name'][0];
}

?>

	<div class="container" id="author-top">
		<div class="row">
			<div class="col-sm-8">
				<div class="avatar-wrapper">
					<?php echo get_avatar( $user_id, 150, '', __( 'The WP Crowd', 'wpcrowd' ), array( 'class' => 'img-responsive' ) ); ?>
					<h2><?php echo $author_name; ?></h2>
					<?php if ( get_field( 'title', 'user_' . $user->ID ) ) : ?>
						<h5>
							<?php echo $my_theme->format_title( $user->ID ); ?>
						</h5>
					<?php endif; ?>
				</div>
				<?php
				if ( get_field( 'biography', 'user_' . $user_id ) ) {
					echo '<div class="bio">';
					the_field( 'biography', 'user_' . $user_id );
					echo '</div>';
				}
				?>
			</div>
			<div class="col-sm-4">
				<div class="author-info">
					<?php if ( get_field( 'location', 'user_' . $user_id ) ) : ?>
						<div class="location">
							<div class="fa fa-map-marker" aria-hidden="true"></div>
							<div class="details">
							<?php the_field( 'location', 'user_' . $user_id ); ?>
							</div>
						</div>
					<?php endif; ?>
					<div class="social-links">
						<?php if ( get_field( 'twitter_handle', 'user_' . $user->ID ) ) : ?>
							<a href="<?php echo esc_url( 'https://twitter.com/' . get_field( 'twitter_handle', 'user_' . $user->ID ) ); ?>" target="_blank" class="circle">
								<i class="fa fa-twitter" aria-hidden="true"></i>
								<?php echo '@' .get_field( 'twitter_handle', 'user_' . $user->ID ); ?>
							</a>
						<?php endif; ?>
						<?php if ( get_field( 'facebook_url', 'user_' . $user->ID ) ) : ?>
							<a href="<?php echo esc_url( get_field( 'facebook_url', 'user_' . $user->ID ) ); ?>" target="_blank" class="circle">
								<i class="fa fa-facebook" aria-hidden="true"></i>
								<?php _e( 'Facebook', 'wpcrowd' );?>
							</a>
						<?php endif; ?>
						<?php if ( $user->user_url ) : ?>
							<a href="<?php echo esc_url( $user->user_url ); ?>" target="_blank" class="circle">
								<i class="fa fa-home" aria-hidden="true"></i>
								<?php echo $user->user_url; ?>
							</a>
						<?php endif; ?>
						<a class="circle" href="<?php echo get_author_posts_url( $user_id ); ?>"><i class="fa fa-user"></i><?php _e( 'The WP Crowd Profile', 'wpcrowd' );?></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="home-main" class="container author-archive">
        <?php if( $showcase->have_posts() ) : ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="latest-podcast-wrapper">
						<div class="headline">
							<h2><strong><?php _e( 'Products & services by ' . $author_name, 'wpcrowd' );?></strong></h2>
						</div>
						<div class="row latest-entries showcase">
							<?php $i=0; while( $showcase->have_posts() ) : $showcase->the_post();?>
                                <article class="col-sm-6 single-entry">
                                    <a href="<?php the_permalink(); ?>" class="featured-image">
                                        <?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
                                    </a>
                                    <h3>
                                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <?php the_excerpt(); ?>
                                </article>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
		<div class="row">
			<div class="col-sm-12">
				<?php if ( have_posts() && $cpt != 'podcast' ) : ?>
					<div class="latest-podcast-wrapper">
						<div class="headline">
							<h2><strong><?php _e( 'Articles', 'wpcrowd' );?></strong></h2>
							<?php if ( ! $cpt ) : ?>
								<a href="<?php echo get_author_posts_url( $user_id ); ?>posts/page/1"><?php _e( 'See All <strong>Articles</strong> by ', 'wpcrowd' );?><?php echo $author_name; ?></a>
							<?php endif; ?>
						</div>
						<div class="row latest-entries blog">
							<?php $i=0; while( have_posts() ) : the_post();?>
								<article class="col-sm-4 single-entry">
									<a href="<?php the_permalink(); ?>" class="featured-image">
										<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
									</a>
									<h3>
										<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
											<?php the_title(); ?>
										</a>
									</h3>
									<div class="featured-meta">
										<span class="date"><?php echo get_the_date( 'F j, Y', $post->ID ); ?></span>
										<span class="hearts"></span>
									</div>
								</article>
								<?php $i++; endwhile; ?>
							<?php if ( $cpt && $cpt == 'posts' ): ?>
								<div class="col-sm-12 text-right">
									<?php wp_pagenavi(); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; wp_reset_query(); ?>
				<?php if ( $person && $podcasts && $podcasts->have_posts() && $cpt !== 'posts' ) : ?>
					<div class="latest-podcast-wrapper">
						<div class="headline">
							<h2><?php _e( 'Podcast <strong>Videos</strong>', 'wpcrowd' );?></h2>
							<?php if ( ! $cpt ) : ?>
								<a href="<?php echo get_author_posts_url( $user_id ); ?>podcast/page/1"><?php _e( 'See All <strong>Podcasts</strong> with ', 'wpcrowd' );?><?php echo $author_name; ?></a>
							<?php endif; ?>
						</div>
						<div class="row latest-entries podcast">
							<?php
							$i=0;
							while( $podcasts->have_posts() ) : $podcasts->the_post();
								?>
								<article class="col-sm-4 single-entry">
									<a href="<?php the_permalink(); ?>" class="featured-image">
										<img src="<?php echo esc_url( 'http://img.youtube.com/vi/' . get_field( 'youtube_video_id', $post->ID ) . '/hqdefault.jpg' ); ?>" class="img-responsive" alt="<?php echo get_the_title(); ?> <?php _e( 'Podcast', 'wpcrowd' );?>" />
									</a>
									<h3>
										<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
											<?php the_title(); ?>
										</a>
									</h3>
									<div class="featured-meta">
										<span class="date"><?php echo get_the_date( 'F j, Y', $post->ID ); ?></span>
										<span class="hearts"></span>
									</div>
								</article>
								<?php $i++; endwhile; ?>
						</div>
						<?php if ( $cpt && $cpt == 'podcast' ): ?>
							<div class="col-sm-12 text-right">
								<?php wp_pagenavi( array( 'query' => $podcasts ) ); ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; wp_reset_query(); ?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>