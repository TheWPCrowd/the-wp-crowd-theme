<?php get_header();?>
	
	
	<div class="col-sm-8 content list">
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
					<div class="meta"><em><?php _e( 'Air Date:', 'thewpcrowd' );?> <?php the_field( 'air_date' ); ?> @ <?php the_field( 'air_time' ); ?></em></div>
					<div class="meta"><?php _e( 'Running Time:', 'thewpcrowd' );?> <?php echo get_field( 'runtime', $post->ID); ?></div>
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
					<a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block visible-sm visible-xs"><?php _e( 'Watch Now', 'thewpcrowd' );?></a>
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
<?php get_footer(); ?>