<?php get_header(); the_post(); ?>
	
	<div class="col-sm-8 content">
		<h2 class="page-title"><?php the_title(); ?></h2>
		<?php 
			the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
			the_content(); 
			
	
			$url = get_the_author_meta( 'user_url' );
			//make sure is URL or not getting trolled by Roy
			if( empty( $url ) || ! filter_var(  $url, FILTER_VALIDATE_URL ) || false != strpos( $url, 'pornhub.ca' ) ){
				$url = get_author_posts_url( get_the_author( ) );
			
			}
			?>
			<dl>
				<dt><?php _e( 'Written by:', 'thewpcrowd' );?></dt>
				<dd><?php printf( '<a href="%s" rel="author" title="%s" target="_blank">%s</a>', esc_url( $url ), esc_attr( __( 'Learn about ', 'thewpcrowd' ) . get_the_author()  ), esc_html( get_the_author() ) ); ?></dd>
				<dt><?php _e( 'Published:', 'thewpcrowd' );?> </dt>
				<dd><?php the_date( 'F j, Y'); ?></dd>
			</dl>
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
