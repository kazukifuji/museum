<?php if ( is_attachment() ) wp_redirect( $post->guid ); ?>

<?php get_header(); ?>

  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>

    

    <?php endwhile; ?>
  <?php else : ?>

    <p class="main__error-text">No posts</p>

  <?php endif; ?>
  
<?php get_footer(); ?>