<?php
wp_reset_query();
get_header();
?>

<div class="container archive">
	<div class="row">


		<div class="col-sm-8">
			<div class="posts-wrapper">
				<div class="headline">
					<h2><?php _e( 'The WP Crowd <strong>Articles</strong>', 'wpcrowd' );?></h2>
				</div>
				<div class="row latest-entries <?php echo get_post_type(); ?> ">
					<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
						<article class="col-sm-4 single-entry">
							<a href="<?php the_permalink(); ?>" class="featured-image">
								<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
							</a>
							<h3>
								<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() );?>">
									<?php the_title(); ?>
								</a>
							</h3>
							<div class="featured-meta">
								<span class="date"><?php echo get_the_date( 'F j, Y', $post->ID ); ?></span>
								<span class="hearts"></span>
							</div>
						</article>
					<?php endwhile; endif; ?>

					<?php 

					if ( class_exists( 'PageNavi_Call' ) ) {
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