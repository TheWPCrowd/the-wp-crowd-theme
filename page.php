<?php
get_header();
the_post();
?>

<div class="container single-container">
	<div class="row">
		<div class="col-sm-8 content">
			<h2 class="single-title"><?php the_title(); ?></h2>
			<?php if( has_post_thumbnail() ) { ?>
			<div class="single-top">
				<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
			</div>
			<?php } ?>
			<div class="content-container">
				<?php the_content(); ?>
			</div>
		</div>
		<div class="col-sm-4 sidebar">
			<?php dynamic_sidebar( 'single-sidebar' ); ?>
		</div>
	</div>
</div>

<?php get_footer();