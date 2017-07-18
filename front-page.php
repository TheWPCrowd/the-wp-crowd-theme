<?php
get_header();
$podcasts = new WP_Query( array( 'post_type' => 'podcast', 'posts_per_page' => 7 ) );
$blog  = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 7 ) );
$first_blog = $blog->posts[0];
$first_podcast = $podcasts->posts[0];

$protocol = get_protocol();
?>

<?php if ( $podcasts->have_posts() ) { ?>
	<!-- HOME TOP -->
	<div class="container-fluid" id="home-top">
		<div class="container">
			<div class="row">
				<?php if(function_exists('get_field')) { ?>
				<div class="col-sm-8 featured-image">
					<a href="<?php echo esc_url( get_permalink( $first_podcast->ID ) ); ?>">
						<?php echo get_the_post_thumbnail( $first_podcast->ID, 'full', array( 'class' => 'img-responsive' ) ); ?>
					</a>
				</div>
				<?php } ?>
				<div class="col-sm-4 featured-info">
					<h3>
						<a href="<?php echo esc_url( get_permalink( $first_podcast->ID ) ); ?>">
							<?php echo get_the_title( $first_podcast->ID ); ?>
						</a>
						<div class="post-excerpt">
							<?php echo substr( $first_podcast->post_content, 0, 200 ) . ' &hellip; '; ?>
						</div>
					</h3>
					<div class="featured-meta">
						<span class="date"><?php echo get_the_date( 'F j, Y', $first_podcast->ID ); ?></span>
						<?php if( function_exists( 'wpcrowd_engage' ) ) { wpcrowd_engage(); } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
	<!-- HOME MAIN AREA -->
	<div id="home-main" class="container">
		<div class="row">
			<div class="col-sm-8">
				<div class="latest-podcast-wrapper">
					
					<!-- Latest Videos -->
					<div class="latest-podcast-wrapper">
						<div class="headline">
							<h2><?php _e( 'Latest <strong>Articles</strong>', 'wpcrowd' );?></h2>
							<a href="<?php echo get_bloginfo( 'url' ); ?>/thewpcrowd-blog">See All <strong>articles</strong></a>
						</div>
						<div class="row latest-entries blog">
							<?php $i=0; if ( $blog->have_posts() ) : while( $blog->have_posts() ) : $blog->the_post(); if ( $i > 0 ) :?>
								<article class="col-sm-4 single-entry">
									<a href="<?php the_permalink(); ?>" class="featured-image">
										<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
									</a>
									<?php get_template_part( 'partials/block', 'title' ); ?>
									<?php get_template_part( 'partials/meta', 'featured' ); ?>
								</article>
							<?php endif; $i++; endwhile; endif; ?>
						</div>
					</div>

					<!-- Latest Podcasts -->
					<div class="headline">
						<h2><?php _e( 'Latest <strong>Videos</strong>', 'wpcrowd' );?></h2>
						<a href="<?php echo get_bloginfo( 'url' ); ?>/podcast">See All <strong>Videos</strong></a>
					</div>
					<div class="row latest-entries podcast">
					<?php $i=0; if ( $podcasts->have_posts() ) : while( $podcasts->have_posts() ) : $podcasts->the_post(); if ( $i > 0 ) :?>
						<article class="col-sm-4 single-entry">
							<?php if ( function_exists( 'get_field' ) ) { ?>
							<a href="<?php the_permalink(); ?>" class="featured-image">
								<img src="<?php echo $protocol?>img.youtube.com/vi/<?php echo get_field( 'youtube_video_id', $post->ID ); ?>/hqdefault.jpg" class="img-responsive" alt="<?php echo get_the_title(); ?> Podcast" />
							</a>
														<?php } ?>
							<?php get_template_part( 'partials/block', 'title' ); ?>
							<?php get_template_part( 'partials/meta', 'featured' ); ?>
						</article>
					<?php endif; $i++; endwhile; endif; ?>
					</div>
				</div>

			</div>
			<div class="col-sm-4 sidebar">
				<?php dynamic_sidebar( 'home-sidebar' ); ?>
			</div>
		</div>
	</div>

<?php get_footer();
