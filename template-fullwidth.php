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
			
			<h2 class="single-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get)the_title() ); ?>"><?php the_title(); ?></a></h2>
			

			<?php if( has_post_thumbnail() ) { ?>
			<div class="single-top">
				<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
			</div>
			<?php } ?>

			<div class="content-container">
				<?php the_content(); ?>
			</div>
			
		</div>
	</div>
</div>

<?php get_footer();