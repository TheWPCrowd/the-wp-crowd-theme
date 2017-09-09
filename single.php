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
			if ( 'podcast' == get_post_type() || 'showcase' === get_post_type() ) {

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

				<div class="embed-responsive embed-responsive-16by9"><iframe id="podcast" class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo get_field( 'youtube_video_id', $post->ID); ?>" frameborder="0" allowfullscreen></iframe></div>
                <?php if( 'showcase' !== get_post_type() ) : ?>
				    <div class="air-date text-right"><strong><?php _e( 'Aired:', 'wpcrowd' );?></strong> <?php if ( function_exists( 'get_field' ) ) { echo get_field( 'air_date' ); } ?></div>
                <?php endif; ?>

				<?php if ( ! empty( $podcasters ) && is_array( $podcasters ) ) : ?>
					<div class="podcast-people">
						<?php if( 'showcase' !== get_post_type() ) : ?>
                            <strong><?php _e( 'In This Episode', 'wpcrowd' );?></strong>
                        <?php endif; ?>
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

                <?php if( 'showcase' !== get_post_type() ) : ?>
				<div class="categories">
					<strong><?php _e( 'Topics:', 'wpcrowd' );?></strong>
					<?php $topics = wp_get_post_terms( $post->ID, 'topics', array( 'fields' => 'all' ) );
					if ( is_array( $topics ) ) {
					?>
					<ul>
							<?php
							foreach( $topics as $topic ) {
								echo '<li><a href="/topics/' . $topic->slug . '" class="person" title="' . esc_attr( $topic->name ) . '">' . $topic->name . '</a></li>';
							}
							?>
					</ul>
					<?php } ?>
				</div>
                <?php endif; ?>
			<?php

			} else {
				the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
				$user = get_user_by( 'id', $post->post_author );
			?>
				<div class="author-meta row">
					<div class="col-xs-2 author-avatar text-center">
						<a href="<?php echo get_author_posts_url( $user->ID ) ?>" title="<?php _e( 'Author Bio', 'wpcrowd' );?>" class="bio"><?php echo get_avatar( $post->post_author, 300, '', __( 'The WP Crowd', 'wpcrowd' ), array( 'class' => 'img-responsive' ) ); ?></a>
					</div>
					<div class="col-xs-7">

						<h3><a href="<?php echo get_author_posts_url( $user->ID ) ?>" title="<?php _e( 'Author Bio', 'wpcrowd' );?>" class="bio"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></a></h3>
						<?php if ( function_exists( 'get_field' ) && get_field( 'title', 'user_' . $post->post_author ) ) : ?>
							<h5>
							<?php echo $my_theme->format_title( $post->post_author ); ?>
							</h5>

						<?php endif;
//					Removed for compatibility with Roys work
//						if ( function_exists( 'wpcrowd_author_follow' ) ) {
//							wpcrowd_author_follow();
//						} else {
							if ( function_exists( 'get_field' ) && get_field( 'biography', 'user_' . $user->ID ) ) : ?>
									<a href="<?php echo get_author_posts_url( $user->ID ) ?>" title="<?php _e( 'Author Bio', 'wpcrowd' );?>" class="bio circle">
											<i><?php _e( 'BIO', 'wpcrowd' );?></i>
									</a>
							<?php endif;
							if ( function_exists( 'get_field' ) && get_field( 'twitter_handle', 'user_' . $user->ID ) ) : ?>
									<a href="<?php echo esc_url( 'https://twitter.com/' . get_field( 'twitter_handle', 'user_' . $user->ID ) ); ?>" title="<?php _e( 'Twitter', 'wpcrowd' );?>" target="_blank" class="circle">
											<i class="fa fa-twitter" aria-hidden="true"></i>
									</a>
							<?php endif;
							if ( function_exists( 'get_field' ) && get_field( 'facebook_url', 'user_' . $user->ID ) ) : ?>
							<a href="<?php echo esc_url( get_field( 'facebook_url', 'user_' . $user->ID ) ); ?>" title="<?php _e( 'Facebook', 'wpcrowd' );?>" target="_blank" class="circle">
											<i class="fa fa-facebook" aria-hidden="true"></i>
									</a>
							<?php endif;
							if ( $user->user_url ) : ?>
									<a href="<?php $user->user_url ?>" title="<?php _e( 'Website', 'wpcrowd' );?>" target="_blank" class="circle">
											<i class="fa fa-home" aria-hidden="true"></i>
									</a>
							<?php endif;

					// }?>
					</div>
					<div class="col-xs-3 date"><strong><?php _e( 'Published:', 'wpcrowd' );?> </strong><?php echo get_the_date( 'F j, Y' ) ?></div>
				</div>
				<div class="categories">
					<strong><?php _e( 'Topics:', 'wpcrowd' );?></strong>
					<?php echo get_the_category_list() ?>
				</div>
		<?php	} ?>




			</div>
			<div class="content-container">
				<?php
				if ( function_exists( 'wpcrowd_share' ) ) {
					wpcrowd_share();
				}

				the_content();

                if( 'showcase' === get_post_type() && $site = get_field('showcase_website_url' ) ) {
                    echo '<a class="btn btn-primary btn-block" target="_blank" href="' . $site . '">WEBSITE</a>';
                }
				if ( ( 'podcast' == get_post_type() || 'showcase' === get_post_type() ) && has_post_thumbnail() ) {
					the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
				}

                if ('showcase' !== get_post_type() ) {
                    comments_template();
                }


				?>
			</div>
		</div>
		<div class="col-sm-4 sidebar">
			<?php dynamic_sidebar( 'single-sidebar' ); ?>
		</div>
	</div>
</div>
<?php
get_footer();