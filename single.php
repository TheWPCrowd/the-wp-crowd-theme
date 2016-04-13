<?php get_header(); the_post(); ?>
	
	<div class="col-sm-8 content">
		<h2 class="page_title"><?php the_title(); ?></h2>
		<?php 
			the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
			the_content(); 
			?>
			
			<div class="post-meta">
				<dl>
					<dt>Written by:</dt>
					<dd><?php echo get_the_author() ?></dd>
					<dt>Published: </dt>
					<dd><?php the_date( 'F j, Y'); ?></dd>
				</dl>
			</div>
		<?php
			comments_template();			
		?>
	</div>
	<div class="col-sm-4">
		<?php if ( is_active_sidebar( 'default-sidebar' ) ) : ?>
			<ul class="sidebar">
				<?php dynamic_sidebar( 'default-sidebar' ); ?>
			</ul>
		<?php endif; ?>
	</div>

<?php get_footer(); ?>