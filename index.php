<?php get_header(); the_post(); ?>
	
	<div class="col-sm-8 content">
		<h2 class="page_title"><?php the_title(); ?></h2>
		<?php the_content(); ?>
	</div>
	<div class="col-sm-4">
		<?php if ( is_active_sidebar( 'default-sidebar' ) ) : ?>
			<ul class="sidebar">
				<?php dynamic_sidebar( 'default-sidebar' ); ?>
			</ul>
		<?php endif; ?>
	</div>

<?php get_footer(); ?>