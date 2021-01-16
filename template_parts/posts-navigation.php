<aside class="posts-navigation">
  <?php
  $posts = [
   [
    'type'   => 'prev',
    'object' => get_adjacent_post( false, '', true ),
   ],
   [
    'type'   => 'next',
    'object' => get_adjacent_post( false, '', false ),
   ],
  ];
  
  foreach ( $posts as $p ) : if ( $p['object'] ) : ?>

    <div class="posts-navigation__item -<?php echo $p['type']; ?>">
      <p class="posts-navigation__item-type">
        <span class="posts-navigation__item-type-icon">
          <svg class="posts-navigation__item-type-icon-svg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M15 18l-6-6 6-6"></path>
          </svg>
        </span>

        <span class="posts-navigation__item-type-name">
          <?php echo $p['type'] === 'prev' ? 'Prev' : 'Next'; ?>
        </span>
      </p>

      <div class="posts-navigation__item-post">
        <a class="posts-navigation__item-post-link" href="<?php echo esc_url( get_permalink( $p['object'] ) ); ?>">
          <div class="posts-navigation__item-post-inner">

            <?php if ( has_post_thumbnail( $p['object']->ID ) ) : ?>
              <figure class="posts-navigation__item-post-thumbnail">
                <?php echo get_the_post_thumbnail( $p['object']->ID, 'post-thumbnail', [ 'data-object-fit' => 'cover' ] ); ?>
              </figure>
            <?php endif; ?>

            <div class="posts-navigation__item-post-container">
              <?php if ( $p['object']->post_title !== '' ) : ?>
                <h3 class="posts-navigation__item-post-title"><?php echo $p['object']->post_title; ?></h3>
              <?php endif; ?>

              <?php $excerpt = wp_html_excerpt( strip_shortcodes( $p['object']->post_content ), 40, '...' );
              if ( $excerpt !== '' ) : ?>
                <p class="posts-navigation__item-post-excerpt"><?php echo $excerpt; ?></p>
              <?php endif; ?>
            </div><!--.posts-navigation__item-post-container-->

          </div><!--.posts-navigation__item-post-inner-->
        </a>
      </div><!--.posts-navigation__item-post-->
    </div><!--.posts-mavigation__item-->

  <?php endif; endforeach; ?>
</aside>