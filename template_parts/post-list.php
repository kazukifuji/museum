<div id="postList" class="post-list">

    <?php if ( have_posts() ) : ?>

      <div class="post-list__posts">

        <div class="post-list__posts-sizer"></div>

        <?php while ( have_posts() ) : the_post(); ?>
          
          <article <?php post_class(); ?>>
          
            <a class="post__link" href="<?php the_permalink(); ?>">
            
              <?php if ( has_post_thumbnail() ) : ?>
                <figure class="post__featured-media">
                  <?php the_post_thumbnail( 'post-thumbnail', [ 'data-object-fit' => 'cover' ] ); ?>
                </figure><!--post__featured-media-->
              <?php endif; ?>

              <div class="post__content">

                <?php if ( esc_html( get_the_title() ) !== '' ) : ?>
                  <div class="post__content-header">
                    <?php the_title( '<h2 class="post__content-title">', '</h2>' ); ?>
                  </div><!--post__content-header-->
                <?php endif; ?>
                
                <div class="post__content-footer">

                  <?php $categories = get_the_category();
                  if ( $categories ) : ?>
                    <div class="post__content-taxonomy">
                      <span class="post__content-taxonomy-icon">
                        <svg class="post__content-taxonomy-icon-svg" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                          <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                        </svg>
                      </span>

                      <ul class="post__content-taxonomy-list">
                        <?php foreach ( $categories as $category ) : ?>
                          <li class="post__content-taxonomy-list-item"><?php echo esc_html( $category->name ); ?></li>
                        <?php endforeach; ?>
                      </ul>

                    </div><!--.post__content-taxonomy-->
                  <?php endif; ?>

                  <?php $tags = get_the_tags();
                  if ( $tags ) : ?>
                    <div class="post__content-taxonomy">
                      <span class="post__content-taxonomy-icon">
                        <svg class="post__content-taxonomy-icon-svg" xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" >
                          <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                          <line x1="7" y1="7" x2="7.01" y2="7"></line>
                        </svg>
                      </span>

                      <ul class="post__content-taxonomy-list">
                        <?php foreach ( $tags as $tag ) : ?>
                          <li class="post__content-taxonomy-list-item"><?php echo esc_html( $tag->name ); ?></li>
                        <?php endforeach; ?>
                      </ul>

                    </div><!--.post__content-taxonomy-->
                  <?php endif; ?>
                
                </div><!--post_content-footer-->
              
              </div><!--.post__content-->

            </a>

          </article><!--.post-->

        <?php endwhile; ?>

      </div><!--.post-list__posts-->

      <button class="post-list__show-more-button" type="button">SEE MORE</button>

      <div class="post-list__page-load-status">
        <div class="infinite-scroll-request">
          <div class="loader-ellips">
            <span class="loader-ellips__dot"></span>
            <span class="loader-ellips__dot"></span>
            <span class="loader-ellips__dot"></span>
            <span class="loader-ellips__dot"></span>
          </div>
        </div>
        <p class="infinite-scroll-last">End of content</p>
        <p class="infinite-scroll-error">No more pages to load</p>
      </div>

      <?php if ( $wp_query->max_num_pages > 1 ) : ?>
        <div class="post-list__navigation">

          <span class="post-list__navigation-prev-page-link">
            <?php previous_posts_link( '&lt; PREV PAGE' ); ?>
          </span>

          <span class="post-list__navigation-next-page-link">
            <?php next_posts_link( 'NEXT PAGE &gt;' ); ?>
          </span>

        </div><!--.post-list__navigation-->
      <?php endif; ?>

    <?php else : ?>

      <p class="post-list__no-posts-text">No posts</p>

    <?php endif; ?>

</div><!--.post-list-->