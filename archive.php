<?php get_header();?>
	
	
	<div class="col-sm-8 content list">
		<?php while( have_posts() ): the_post(); ?>
		<article>
			<h2 class="page_title">
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
					<?php the_excerpt(); ?>
				</div>
			</div>
			<div class="row buffer">
				<div class="col-sm-12">
					<a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block"><?php the_title(); ?></a>	
				</div>
			</div>
		</article>
		<?php endwhile; ?>
		<div class="navigation">
			<p>
				<?php posts_nav_link( ' | ', 'Newer Podcasts', 'Older Podcasts' ); ?>
			</p>
		</div>
	</div>
	<div class="col-sm-4">
		<?php if ( is_active_sidebar( 'default-sidebar' ) ) : ?>
			<ul class="sidebar">
				<?php dynamic_sidebar( 'default-sidebar' ); ?>
			</ul>
		<?php endif; ?>
	</div>

<?php get_footer(); ?>