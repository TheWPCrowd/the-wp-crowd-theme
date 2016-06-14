<?php
get_header();
$podcasts = new WP_Query( array( 'post_type' => 'podcast', 'posts_per_page' => 7 ) );
$first_podcast  = false;

if ($podcasts->have_posts() ){
    $first_podcast = $podcasts->posts[0];
}
$blog  = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 7 ) );
?>

<?php if( $first_podcast ) { ?>
	<!-- HOME TOP -->
	<div class="container-fluid" id="home-top">
		<div class="container">
			<div class="row">
                                <?php if(function_exists('get_field')) { ?>
				<div class="col-sm-8 featured-image" style="background-image: url(http://img.youtube.com/vi/<?php echo get_field( 'youtube_video_id', $first_podcast->ID ); ?>/hqdefault.jpg);">
					<a href="<?php echo esc_url( get_permalink( $first_podcast->ID ) ); ?>"></a>
				</div>
                                <?php } ?>
				<div class="col-sm-4 featured-info">
					<h3>
						<a href="<?php echo esc_url( get_permalink( $first_podcast->ID ) ); ?>">
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
	</div>
<?php } ?>
	<!-- HOME MAIN AREA -->
	<div id="home-main" class="container">
		<div class="row">
			<div class="col-sm-8">
				<div class="latest-podcast-wrapper">
					<div class="headline">
						<h2>Latest <strong>Videos</strong></h2>
						<a href="<?php echo get_bloginfo('wpurl'); ?>/podcast">See All <strong>Videos</strong></a>
					</div>
					<div class="row latest-entries podcast">
					<?php $i=0; if( $podcasts->have_posts() ) : while( $podcasts->have_posts() ) : $podcasts->the_post(); if( $i > 0 ) :?>
						<article class="col-sm-4 single-entry">
                                                        <?php if(function_exists('get_field')) { ?>
							<a href="<?php the_permalink(); ?>" class="featured-image">
								<img src="http://img.youtube.com/vi/<?php echo get_field( 'youtube_video_id', $post->ID ); ?>/hqdefault.jpg" class="img-responsive" alt="<?php echo get_the_title(); ?> Podcast" />
							</a>
                                                        <?php } ?>
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
					<?php endif; $i++; endwhile; endif; ?>
					</div>
				</div>
				<div class="latest-podcast-wrapper">
					<div class="headline">
						<h2>Latest <strong>Articles</strong></h2>
						<a href="<?php echo get_bloginfo('wpurl'); ?>/thewpcrowd-blog">See All <strong>articles</strong></a>
					</div>
					<div class="row latest-entries blog">
						<?php $i=0; if( $blog->have_posts() ) : while( $blog->have_posts() ) : $blog->the_post(); if( $i > 0 ) :?>
							<article class="col-sm-4 single-entry">
								<a href="<?php the_permalink(); ?>" class="featured-image">
									<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
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