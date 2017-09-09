<?php

	get_header();
	global $wp_query;


?>

<div class="container archive">
	<div class="row">
		<div class="col-sm-8">
			<div class="posts-wrapper">
				<div class="headline">
                    <h2><?php _e( 'Showcase', 'wpcrowd' );?></h2>
				</div>
                <p>
                    <strong>The WP Crowd Showcase</strong> is a place for our members to show of the projects, services, and other things they offer and work on.
                </p>
				<div class="row latest-entries showcase">
					<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
                        <?php
                            $author = get_user_by( 'id', $post->post_author );

                        ?>
							<article class="col-sm-6 single-entry">
                                <h3>
                                    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() );?>" class="featured-image">
                                        <?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
                                    </a>
                                    <?php the_title(); echo ($author->user_nicename) ? ' by: ' . $author->user_nicename : ''; ?>
                                </h3>
                                <?php the_excerpt(); ?>
							</article>

					<?php endwhile; endif; //end if/while have_posts

					if ( function_exists( 'wp_pagenavi' ) ) {
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
