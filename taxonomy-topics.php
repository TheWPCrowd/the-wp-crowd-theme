<?php 
	global $wp_query;
	get_header();
	
?>
	
	<div class="col-sm-8 content list">
		<h1 class="page-title">Topic: <?php echo $wp_query->get_queried_object()->name; ?></h1>
		<?php if( have_posts() ) : ?>
		<?php while( have_posts() ): the_post(); ?>
			<article>
				<h2 class="page-title">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>
				<div class="row">
					<div class="col-sm-6">
						<div class="embed-responsive embed-responsive-16by9">
							<iframe id="podcast" class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo get_field( 'youtube_video_id', $post->ID); ?>" frameborder="0" allowfullscreen></iframe>
						</div>
						<div class="meta"><em>Air Date: <?php the_field( 'air_date' ); ?> @ <?php the_field( 'air_time' ); ?></em></div>
						<div class="meta">Running Time: <?php echo get_field( 'runtime', $post->ID); ?></div>
					</div>
					<div class="col-sm-6">
						<div class="hidden-xs hidden-sm">
							<?php the_excerpt(); ?>
						</div>
					</div>
				</div>
				<div class="row buffer">
					<div class="col-sm-12">
						<a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block hidden-sm hidden-xs"><?php the_title(); ?></a>
						<a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block visible-sm visible-xs">Watch Now</a>
					</div>
				</div>
			</article>
		<?php endwhile; ?>
		<?php else: ?>
			<h2 class="page-title">Empty Topic... we will likely be talking about this stuff at some point maybe later</h2>
		<?php endif;?>
	</div>
	<div class="col-sm-4">
		<?php if ( is_active_sidebar( 'default-sidebar' ) ) : ?>
			<ul class="sidebar">
				<?php dynamic_sidebar( 'default-sidebar' ); ?>
			</ul>
		<?php endif; ?>
	</div>

<?php get_footer(); ?>