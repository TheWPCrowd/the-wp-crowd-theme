<?php get_header(); the_post(); global $wp_query; ?>

<div class="container archive">
	<div class="row">
		<div class="col-sm-8">
			<div class="posts-wrapper">
				<div class="headline">
					<?php if( is_tax() && 'podcast' == get_post_type() ) : ?>
						<?php
							$term = $wp_query->get_queried_object();
							$title = $term->name;
						?>
						<h2>Latest <?php echo $title; ?> <strong>Videos</strong></h2>
						<a href="<?php echo get_bloginfo('wpurl'); ?>/podcast">See All <strong>Videos</strong></a>
					<?php elseif( is_tax() || is_category() && 'post' === get_post_type() ) : ?>
						<?php
						$term = $wp_query->get_queried_object();
						$title = $term->name;
						?>
						<h2>Latest <?php echo $title; ?> <strong>Articles</strong></h2>
						<a href="<?php echo get_bloginfo('wpurl'); ?>/thewpcrowd-blog">See All <strong>articles</strong></a>
					<?php elseif( 'podcast' === get_post_type() && !is_tax() || !is_category() ) : ?>
						<h2>Latest <strong>Videos</strong></h2>
						<a href="<?php echo get_bloginfo('wpurl'); ?>/podcast">See All <strong>Videos</strong></a>
					<?php elseif( 'post' === get_post_type() && !is_tax() || !is_category() ) : ?>
						<h2>Latest <strong>Articles</strong></h2>
						<a href="<?php echo get_bloginfo('wpurl'); ?>/thewpcrowd-blog">See All <strong>articles</strong></a>
					<?php endif; ?>
				</div>
				<div class="row latest-entries <?php if( 'podcast' == get_post_type() ) { echo 'podcast'; } ?> ">
					<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
						<?php if( 'podcast' === get_post_type() ): ?>
							<article class="col-sm-4 single-entry">
								<a href="<?php the_permalink(); ?>" class="featured-image">
									<img src="http://img.youtube.com/vi/<?php echo get_field( 'youtube_video_id', $post->ID ); ?>/hqdefault.jpg" class="img-responsive" alt="<?php echo get_the_title(); ?> Podcast" />
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
						<?php else: ?>
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
						<?php endif; ?>
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