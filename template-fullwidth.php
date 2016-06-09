<?php
/**
 * Template Name: Full Width
 */
get_header();
the_post();
?>

<div class="container single-container">
	<div class="row">
		<div class="col-sm-12 content">
			<h2 class="single-title"><?php the_title(); ?></h2>
			<div class="single-top">
				<?php if( has_post_thumbnail() ) { the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); } ?>
			</div>
			<div class="content-container">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer();