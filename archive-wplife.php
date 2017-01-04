<?php

	get_header();
	global $wp_query;

	$cattitle = ( is_tax() && 'podcast' == get_post_type() ? __( 'Videos', 'wpcrowd' ) : __( 'Articles', 'wpcrowd' ) );

	$caturl = ( is_tax() && 'podcast' == get_post_type() ? get_bloginfo( 'url' ) . '/podcast' : get_bloginfo( 'url' ) . '/thewpcrowd-blog' );

	$singletitle = ( is_singular( 'podcast' ) ? __( 'Videos', 'wpcrowd' ) : __( 'Articles', 'wpcrowd' ) );

	$singleurl = ( is_singular( 'podcast' ) ? get_bloginfo( 'url' ) . '/podcast' : get_bloginfo( 'url' ) . '/thewpcrowd-blog' );



?>

<div class="container archive">
	<div class="row">
		<div class="col-sm-8">
			<div class="posts-wrapper">
				<?php
				$wplife_page = get_post( 1433 );
				echo '<h1>' . get_the_title( $wplife_page->post_title ) . '</h1>';
				echo apply_filters( 'the_content', $wplife_page->post_content );
				?>
				<div class="headline">
					<h2><?php _e( 'Latest', 'wpcrowd' );?> <strong> #WPLife</strong> Videos</h2>
				</div>
				<div class="row latest-entries podcast ">
					<?php
					if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
							<article class="col-sm-4 single-entry">
								<?php if( 'podcast' === get_post_type() ): ?>
									<h3>
										<a href="<?php the_permalink(); ?>" class="featured-image">
											<img src="<?php echo get_protocol() ?>img.youtube.com/vi/<?php echo get_field( 'youtube_video_id', $post->ID ); ?>/hqdefault.jpg" class="img-responsive" alt="<?php echo get_the_title(); ?> Podcast" />
										</a>
									</h3>
								<?php else: ?>
									<h3>
										<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() );?>" class="featured-image">
											<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
										</a>
									</h3>
								<?php endif; ?>
								<?php get_template_part( 'partials/block', 'title' ); ?>
								<?php get_template_part( 'partials/meta', 'featured' ); ?>
								<div class="featured-meta">
									<span class="date"><?php echo get_the_date( 'F j, Y', $post->ID ); ?></span>
									<span class="hearts"></span>
								</div>
							</article>

					<?php endwhile; endif; //end if/while have_posts

					if ( function_exists( 'wp_pagenavi' ) ) {
						wp_pagenavi();
					} else {
						the_posts_navigation();
					}

					?>

				</div>
			</div>
		</div>
		<div class="col-sm-4 sidebar">
			<?php dynamic_sidebar( 'home-sidebar' ); ?>
		</div>
	</div>
</div>

<?php get_footer();
