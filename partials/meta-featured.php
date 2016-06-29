<div class="featured-meta">
    <span class="date"><?php echo get_the_date( 'F j, Y', $post->ID  ); ?></span>
    <?php if( function_exists( 'wpcrowd_engage' ) ) { wpcrowd_engage(); } ?>
</div>