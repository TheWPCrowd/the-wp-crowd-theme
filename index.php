<?php 

	get_header(); 
	global $wp_query; 

	$cattitle = ( is_tax() && 'podcast' == get_post_type() ? 'Videos' : 'Articles');
						
	$caturl = ( is_tax() && 'podcast' == get_post_type() ? get_bloginfo('wpurl') . '/podcast' : get_bloginfo('wpurl') .'/thewpcrowd-blog' );

	$singletitle = ( is_singular('podcast') ? 'Videos' : 'Articles' );

	$singleurl = ( is_singular('podcast') ? get_bloginfo('wpurl') . '/podcast' : get_bloginfo('wpurl') .'/thewpcrowd-blog' );

        
        
?>

<div class="container archive">
	<div class="row">
		<div class="col-sm-8">
			<div class="posts-wrapper">
				<div class="headline">

					<?php if( is_tax() || is_archive() || is_category() ) : 

							if ( is_tax() ) {
								$term = $wp_query->get_queried_object();
								$title = $term->name;
							}
						?>
						<h2>Latest <?php echo $title; ?> <strong><?php echo $cattitle; ?></strong></h2>
						<a href="<?php echo $caturl; ?>">See All <strong><?php echo $cattitle; ?></strong></a>

					<?php elseif( is_singular(array('podcast', 'post') ) ) : ?>
						<h2>Latest <strong><?php echo $singletitle; ?></strong></h2>
						<a href="<?php echo $singleurl; ?>">See All <strong><?php echo $singletitle; ?></strong></a>
					<?php endif; ?>
				</div>
				<div class="row latest-entries <?php if( 'podcast' == get_post_type() ) { echo 'podcast'; } ?> ">
					<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
							<article class="col-sm-4 single-entry">
								<?php if( 'podcast' === get_post_type() ): ?>
								<a href="<?php the_permalink(); ?>" class="featured-image">
									<img src="<?php echo get_protocol() ?>img.youtube.com/vi/<?php echo get_field( 'youtube_video_id', $post->ID ); ?>/hqdefault.jpg" class="img-responsive" alt="<?php echo get_the_title(); ?> Podcast" />
								</a>
							<?php else: ?>
								<a href="<?php the_permalink(); ?>" class="featured-image">
									<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
								</a>
							<?php endif; ?>
								<?php get_template_part( 'partials/block', 'title' ); ?>
								<?php get_template_part( 'partials/meta', 'featured' ); ?>
							</article>
					
					<?php endwhile; endif; //end if/while have_posts

					if ( class_exists('PageNavi_Call') ) {
						wp_pagenavi(  );
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