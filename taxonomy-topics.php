<?php 
	global $wp_query;
	get_header();
	
?>
	
	<div class="col-sm-8 content list">
		<h1 class="page_title">Topic: <?php echo $wp_query->get_queried_object()->name; ?></h1>
		<?php if( have_posts() ) : ?>
		<?php while( have_posts() ): the_post(); ?>
		<article>
			<h2 class="page_title"><?php the_title(); ?></h2>
			<div class="row" style="margin-bottom:10px;">
				<div class="col-sm-6">
					<div class="embed-responsive embed-responsive-16by9">
						<iframe id="podcast" class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo get_field( 'youtube_video_id', $post->ID); ?>" frameborder="0" allowfullscreen></iframe>
					</div>
					<div class="meta">Running Time: <?php echo get_field( 'runtime', $post->ID); ?></div>
				</div>
				<div class="col-sm-6">
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php the_title(); ?></a>
				</div>
			</div>
		</article>
		<?php endwhile; ?>
		<?php else: ?>
			<h2 class="page_title">Empty Topic... we will likely be talking about this stuff at some point maybe later</h2>
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