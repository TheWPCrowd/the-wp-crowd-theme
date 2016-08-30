<?php
/**
 * Template Name: Support The Crowd
 */
get_header(); the_post(); ?>

	<div class="col-sm-4">
		<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
		<?php if ( is_active_sidebar( 'default-sidebar' ) ) : ?>
			<ul class="sidebar">
				<?php dynamic_sidebar( 'default-sidebar' ); ?>
			</ul>
		<?php endif; ?>
	</div>
	<div class="col-sm-8 content">
		<h2 class="page_title"><?php the_title(); ?></h2>
		<?php
			the_content();
		?>
	</div>

<?php get_footer(); ?>