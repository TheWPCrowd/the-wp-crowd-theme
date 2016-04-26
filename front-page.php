<?php 
	get_header();
	$podcasts = new WP_Query( array( 'post_type' => 'podcast', 'paged' => $paged, 'posts_per_page' => 5 ) );
	$blog = new WP_Query( array( 'post_type' => 'post', 'paged' => $paged, 'posts_per_page' => 5 ) );
?>
	<div class="col-sm-9 content list">
		<div class="row">
			<div class="col-sm-6">
				<h1>WordPress Podcast</h1>
				<?php while( $podcasts->have_posts() ): $podcasts->the_post(); ?>
				<article>
					<h2 class="page_title">
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h2>
					<div class="row">
						<div class="col-sm-12">
							<div class="embed-responsive embed-responsive-16by9">
								<iframe id="podcast" class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo get_field( 'youtube_video_id', $post->ID); ?>" frameborder="0" allowfullscreen></iframe>
							</div>
							<div class="meta"><em>Air Date: <?php the_field( 'air_date' ); ?> @ <?php the_field( 'air_time' ); ?></em></div>
							<div class="meta">Running Time: <?php echo get_field( 'runtime', $post->ID); ?></div>
						</div>
					</div>
					<div class="row buffer">
						<div class="col-sm-12">
							<a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block">Watch Now</a>
						</div>
					</div>
				</article>
				<?php endwhile; ?>
				<div class="navigation">
					<hr />
					<a href="http://www.thewpcrowd.com/podcast/" class="btn btn-primary btn-block">Older Shows</a>
				</div>
			</div>
			<div class="col-sm-6">
				<h1>WordPress Blog</h1>
				<?php while( $blog->have_posts() ): $blog->the_post(); ?>
				<article>
					<h2 class="page_title">
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h2>
					<div class="row">
						<div class="col-sm-12">
							<div class="meta"><em>Published: <?php the_date( 'F j, Y' ); ?></em></div>
							<?php the_excerpt(); ?>
						</div>
					</div>
					<div class="row buffer">
						<div class="col-sm-12">
							<a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block">Read Blog</a>
						</div>
					</div>
				</article>
				<?php endwhile; ?>
				<div class="navigation">
					<hr />
					<a href="http://www.thewpcrowd.com/podcast/" class="btn btn-primary btn-block">Older Shows</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<?php if ( is_active_sidebar( 'default-sidebar' ) ) : ?>
			<ul class="sidebar">
				<?php dynamic_sidebar( 'default-sidebar' ); ?>
			</ul>
		<?php endif; ?>
	</div>

<?php get_footer(); ?>