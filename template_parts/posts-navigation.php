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

      <div class="posts-navigation__item-flex-container">
          <span class="posts-navigation__item-icon">
            <svg class="posts-navigation__item-icon-svg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path d="M15 18l-6-6 6-6"></path>
            </svg>
          </span>

          <p class="posts-navigation__item-title">
            <?php echo $p['type'] === 'prev' ? 'Prev' : 'Next'; ?>
          </p>
      </div><!--.posts-navigation__item-flex-contaier-->

      <div class="posts-navigation__item-post">
        <a class="posts-navigation__item-post-link" href="<?php echo esc_url( get_permalink( $p['object'] ) ); ?>">

          <div class="posts-navigation__item-flex-container">

            <?php if ( has_post_thumbnail( $p['object']->ID ) ) : ?>
              <figure class="posts-navigation__item-post-thumbnail">
                <?php echo get_the_post_thumbnail( $p['object']->ID, 'post-thumbnail', [ 'data-object-fit' => 'cover' ] ); ?>
              </figure>
            <?php endif; ?>

            <h3 class="posts-navigation__item-post-title">
              <?php $title = esc_html( get_the_title( $p['object']->ID ) );
              if ( $title !== '' ) {
                echo $title;
              } else {
                echo 'No title';
              } ?>
            </h3>

          </div><!--.posts-navigation__item-flex-contaier-->

        </a>
      </div><!--.posts-navigation__item-post-->

    </div><!--.posts-navigation__item-->

  <?php endif; endforeach; ?>
</aside>