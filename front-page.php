<?php 
	get_header();
	$podcasts = new WP_Query( array( 'post_type' => 'podcast', 'paged' => $paged, 'posts_per_page' => 5 ) );
	$blog = new WP_Query( array( 'post_type' => 'post', 'paged' => $paged, 'posts_per_page' => 5 ) );
?>
	<div class="col-sm-9 content list">
		<div class="row">
			<div class="col-sm-6">
				<h1><?php _e( 'WordPress Podcast', 'thewpcrowd' );?></h1>
				<?php while( $podcasts->have_posts() ): $podcasts->the_post(); ?>
				<article>
					<h2 class="page-title">
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h2>
					<div class="row">
						<div class="col-sm-12">
							<div class="embed-responsive embed-responsive-16by9">
								<iframe id="podcast" class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo get_field( 'youtube_video_id', $post->ID); ?>" frameborder="0" allowfullscreen></iframe>
							</div>
							<div class="meta"><em><?php _e( 'Air Date:', 'thewpcrowd' );?> <?php the_field( 'air_date' ); ?> @ <?php the_field( 'air_time' ); ?></em></div>
							<div class="meta"><?php _e( 'Running Time:', 'thewpcrowd' );?> <?php echo get_field( 'runtime', $post->ID); ?></div>
						</div>
					</div>
					<div class="row buffer">
						<div class="col-sm-12">
							<a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block"><?php _e( 'Watch Now', 'thewpcrowd' );?></a>
						</div>
					</div>
				</article>
				<?php endwhile; ?>
				<div class="navigation">
					<hr />
					<a href="http://www.thewpcrowd.com/podcast/" class="btn btn-primary btn-block"><?php _e( 'Older Shows', 'thewpcrowd' );?></a>
				</div>
			</div>
			<div class="col-sm-6">
				<h1><?php _e( 'WordPress Blog', 'thewpcrowd' );?></h1>
				<?php while( $blog->have_posts() ): $blog->the_post(); ?>
				<article>
					<h2 class="page-title">
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h2>
					<div class="row">
						<div class="col-sm-12">
							<div class="meta"><em><?php _e( 'Published:', 'thewpcrowd' );?> <?php the_date( 'F j, Y' ); ?></em></div>
							<?php the_excerpt(); ?>
						</div>
					</div>
					<div class="row buffer">
						<div class="col-sm-12">
							<a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block"><?php _e( 'Read Blog', 'thewpcrowd' );?></a>
						</div>
					</div>
				</article>
				<?php endwhile; ?>
				<div class="navigation">
					<hr />
					<a href="http://www.thewpcrowd.com/thewpcrowd-blog/" class="btn btn-primary btn-block"><?php _e( 'Older Posts', 'thewpcrowd' );?></a>
				</div>
			</div>
		</div>
	</div>
	
<?php get_footer(); ?>