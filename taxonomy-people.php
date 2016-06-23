<?php 
	global $wp_query;
	get_header();
	
	$term_id = $wp_query->get_queried_object_id();
	$meta = Taxonomy_MetaData::get( 'people', $term_id );
	
	$profile_pic = get_stylesheet_directory_uri(). '/build/img/wp_crowd_logo.jpg';
	if( isset( $meta['person-profile'] )  ) {
		$profile_pic = $meta['person-profile'];
	}
	
?>
	
	<div class="col-sm-8 content list">
		<h1 class="page-title">Crowd Member: <?php echo $wp_query->get_queried_object()->name; ?></h1>
		<div class="row person-profile">
			<div class="col-sm-4">
				<img src="<?php echo $profile_pic; ?>" alt="The WP Crowd" class="img-responsive profile-pic" />
			</div>
			<div class="col-sm-8">
				<ul>
					<?php if( isset( $meta['person_bio'] ) ): ?>
						<li>
							<strong>BIO</strong>
							<p><?php echo $meta['person_bio']; ?></p>
						</li>
					<?php endif; ?>
					<?php if( isset( $meta['person_twitter'] ) ): ?>
						<li class="social twitter">
 							<a target="_blank" href="https://www.twitter.com/<?php echo $meta['person_twitter']; ?>" class="btn btn-primary">
								<i class="fa fa-twitter"></i> <?php echo $meta['person_twitter']; ?>
							</a>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
		<?php if( have_posts() ) : ?>
		<h1 class="page-title">Podcasts with <?php echo $wp_query->get_queried_object()->name; ?></h1>
		<?php while( have_posts() ): the_post(); ?>
		<article>
			<h2 class="page-title"><?php the_title(); ?></h2>
			<div class="row" style="margin-bottom:10px;">
				<div class="col-sm-6">
					<div class="embed-responsive embed-responsive-16by9">
						<iframe id="podcast" class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo get_field( 'youtube_video_id', $post->ID); ?>" frameborder="0" allowfullscreen></iframe>
					</div>
					<div class="meta">Running Time: <?php echo get_field( 'runtime', $post->ID); ?></div>
				</div>
				<div class="col-sm-6">
					<?php the_excerpt(); ?>
				</div>
			</div>
			<a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block"><?php the_title(); ?></a>
		</article>
		<?php endwhile; endif;?>
	</div>
	<div class="col-sm-4">
		<?php if ( is_active_sidebar( 'default-sidebar' ) ) : ?>
			<ul class="sidebar">
				<?php dynamic_sidebar( 'default-sidebar' ); ?>
			</ul>
		<?php endif; ?>
	</div>

<?php get_footer(); ?>