<?php
wp_reset_query();
get_header();
?>

<div class="container archive">
	<div class="row">
		<div class="col-sm-8">
			<div class="posts-wrapper">
				<div class="headline">
					<h2>The WP Crowd <strong>Articles</strong></h2>
				</div>
				<div class="row latest-entries <?php if( 'podcast' == get_post_type() ) { echo 'podcast'; } ?> ">
					<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
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
					<?php endwhile; endif; ?>
					<?php wp_pagenavi(  ); ?>
				</div>
			</div>
		</div>
		<div class="col-sm-4 sidebar">
			<?php dynamic_sidebar( 'home-sidebar' ); ?>
		</div>
	</div>
</div>

<?php get_footer();