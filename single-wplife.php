<?php
get_header();
the_post();
?>

<div class="container single-container">
	<div class="row">
		<div class="col-sm-8 content">
			<h2 class="single-title"><?php the_title(); ?></h2>
			<div class="single-top">
			<?php
				$people_terms = wp_get_post_terms( $post->ID, 'people', array( 'fields' => 'all' ) );
				$podcasters = array();

				if ( ! empty( $people_terms ) ) {
					foreach( $people_terms as $person ) {
						if ( function_exists( 'get_field' ) ) {
							$associated_user = get_field( 'associated_user', $person->taxonomy . '_' . $person->term_id );
							if ( $associated_user ) {
								$podcasters[] = $associated_user['ID'];
							}
						}
					}
				}

				$guests = wp_get_post_terms( $post->ID, 'guest', array( 'fields' => 'all' ) );
				?>

				<div class="embed-responsive embed-responsive-16by9"><iframe id="podcast" class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo get_field( 'youtube_id', $post->ID); ?>" frameborder="0" allowfullscreen></iframe></div>
				<div class="air-date text-right"><strong><?php _e( 'Aired:', 'wpcrowd' );?></strong> <?php echo the_date('M jS, Y'); ?></div>

				<?php if ( ! empty( $podcasters ) && is_array( $podcasters ) ) : ?>
					<div class="podcast-people">
						<strong><?php _e( 'In This Episode', 'wpcrowd' );?></strong>
						<?php
							foreach( $podcasters as $user ) {

								$usermeta = get_user_meta( $user );
								$username = $usermeta['first_name'][0] . ' ' . $usermeta['last_name'][0];

							?>
								<a href="<?php echo get_author_posts_url( $user ); ?>" title="<?php echo esc_attr( $username ) ;?>">
								<?php
									echo get_avatar( $user, 300, '', __( 'The WP Crowd', 'wpcrowd' ), array( 'class' => 'img-responsive' ) );
									echo esc_html( $username );
								?>
								</a>
							<?php

							} /* foreach */
						?>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $guests ) && is_array( $guests ) ) : ?>
					<div class="podcast-people guests">
						<strong><?php _e( 'Special Guests', 'wpcrowd' );?></strong>
						<?php
						foreach( $guests as $guest) {
							echo '<span>' . esc_html( $guest->name ) . '</span>';
						} /* foreach */
						?>
					</div>
				<?php endif; ?>

			</div>
			<div class="content-container">
				<?php
				if ( function_exists( 'wpcrowd_share' ) ) {
					wpcrowd_share();
				}

				the_content();
				?>
				<h2>Join the WPLife Conversation</h2>
				<p>
					Add your comments on <a href="https://www.youtube.com/watch?v=<?php echo get_field( 'youtube_id' ); ?>">YouTube</a>.
				</p>
			</div>
		</div>
		<div class="col-sm-4 sidebar">
			<?php dynamic_sidebar( 'single-sidebar' ); ?>
		</div>
	</div>
</div>
<?php
get_footer();