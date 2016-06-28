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
                                if( 'podcast' == get_post_type() ) {
						$people_terms = wp_get_post_terms( $post->ID, 'people', array( 'fields' => 'all' ) );
						$podcasters = array();
						if( !empty( $people_terms ) ) {
							foreach( $people_terms as $person ) {
                                                            if(function_exists('get_field')){
								$associated_user = get_field( 'associated_user', $person->taxonomy . '_' . $person->term_id );
								if( $associated_user ) {
									$podcasters[] = $associated_user['ID'];
								}
                                                            }
							}
						}
                                ?>
                                <div class="embed-responsive embed-responsive-16by9"><iframe id="podcast" class="embed-responsive-item" src="https://www.youtube.com/embed/' . get_field( 'youtube_video_id', $post->ID) . '" frameborder="0" allowfullscreen></iframe></div>
                                <div class="air-date text-right"><strong>Aired:</strong> <?php if(function_exists('get_field')){ echo get_field( 'air_date' ); } ?></div>
                                <div class="podcast-people">
                                        <strong>In This Episode</strong>
                                        <?php    
                                            if(!empty($podcasters) && is_array($podcasters)) {
                                                foreach( $podcasters as $user ) { ?>
                                                    <a href="<?php echo get_author_posts_url( $user ); ?>">
                                                    <?php 
                                                        echo get_avatar( $user, 300, '', 'The WP Crowd', array( 'class' => 'img-responsive' ) ); 
                                                        $usermeta = get_user_meta( $user );
                                                        echo $usermeta['first_name'][0] . ' ' . $usermeta['last_name'][0];
                                                    ?>
                                                    </a>
                                        <?php 
                                                } 
                                            } 
                                        ?>
                                        </div>
                                        <div class="categories">
                                                <strong>Topics:</strong>
                                                <?php $topics = wp_get_post_terms( $post->ID, 'topics', array( 'fields' => 'all' ) );
                                                if(is_array($topics)) {
                                                ?>
                                                <ul>
                                                        <?php foreach( $topics as $topic ) {
                                                                echo '<li><a href="/topics/' . $topic->slug. '" class="person">' . $topic->name . '</a></li>';
                                                        } ?>
                                                </ul>
                                                <?php } ?>
                                        </div>
					<?php 
                                        
                                            } else { 
                                            the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
                                            
                                        ?>
						<div class="author-meta row">
							<div class="col-xs-2 author-avatar text-center">
								<?php echo get_avatar( $post->post_author, 300, '', 'The WP Crowd', array( 'class' => 'img-responsive' ) ); ?>
							</div>
							<div class="col-xs-7">
                                                               
								<h3><?php echo get_the_author_meta( 'display_name' ) ?></h3>
								<?php if( function_exists('get_field') && get_field( 'title', 'user_'.$post->post_author ) ) : ?>
									<h5>
										<?php 
                                                                                $title = get_field( 'title', 'user_'.$post->post_author );
										$title = str_replace( '-', ' ', $title );
										$title = str_replace( '_', ' ', $title );
										echo $title;
                                                                                ?>
									</h5>
                                                                
								<?php endif; 
                                                                
//                                                                if(function_exists('wpcrowd_author_follow')){
//                                                                    wpcrowd_author_follow();
//                                                                } else {    
                                                                        $user = get_user_by( 'id', $post->post_author );
                                                                        if( function_exists('get_field') && get_field( 'biography', 'user_'.$user->ID ) ) : ?>
                                                                                <a href="<?php echo get_author_posts_url( $user->ID ) ?>" class="bio circle">
                                                                                        <i>BIO</i>
                                                                                </a>
                                                                        <?php endif; 
                                                                        if( function_exists('get_field') && get_field( 'twitter_handle', 'user_'.$user->ID ) ) : ?>
                                                                                <a href="https://twitter.com/' <?php echo get_field( 'twitter_handle', 'user_'.$user->ID ) ?>" target="_blank" class="circle">
                                                                                        <i class="fa fa-twitter" aria-hidden="true"></i>
                                                                                </a>
                                                                        <?php endif; 
                                                                        if( function_exists('get_field') && get_field( 'facebook_url', 'user_'.$user->ID ) ) : ?>
                                                                        <a href="<?php echo get_field( 'facebook_url', 'user_'.$user->ID ) ?>" target="_blank" class="circle">
                                                                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                                                                </a>
                                                                        <?php endif;
                                                                        if( $user->user_url ) : ?>
                                                                                <a href="<?php $user->user_url ?>" target="_blank" class="circle">
                                                                                        <i class="fa fa-home" aria-hidden="true"></i>
                                                                                </a>
                                                                        <?php endif;
                                                                        
//                                                                }        ?>
							</div>
							<div class="col-xs-3 date"><strong>Published: </strong><?php echo get_the_date( 'F j, Y' ) ?></div>
						</div>
						<div class="categories">
							<strong>Topics:</strong>
							<?php echo get_the_category_list() ?>
						</div>
				<?php 	} ?>				
			</div>
			<div class="content-container">
				<?php
                                     if(function_exists('wpcrowd_share')){
                                            wpcrowd_share();
                                     }
                                
					the_content();
					if( 'podcast' == get_post_type() && has_post_thumbnail() ) {
						the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
					}
                                        
    
                                       
    
					comments_template();
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