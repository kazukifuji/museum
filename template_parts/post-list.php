<article id="postList" class="post-list">

    <?php if ( is_archive() || is_search() ) : ?>
      <div class="wrapper">
        <div class="post-list__heading">

            <p class="post-list__heading-subtitle">
              <?php if ( is_search() ) echo 'search';
              elseif ( is_date() ) echo 'date';
              elseif ( is_author() ) echo 'author';
              elseif ( is_category() ) echo 'category';
              elseif ( is_tag() ) echo 'tag';
              elseif ( is_tax() ) echo esc_html( get_query_var('taxonomy') );
              ?>
            </p>

          <?php the_archive_title( '<h1 class="post-list__heading-title">', '</h1>' ); ?>

          <?php if ( is_category() || is_tag() || is_tax() ) : ?>
            <?php $desc_text = esc_html( get_queried_object()->description );
            if ( $desc_text !== '' ) : ?>

              <p class="post-list__heading-description"><?php echo $desc_text; ?></p>

            <?php endif; ?>
          <?php endif; ?>

        </div><!--.post-list__heading-->
      </div><!--.wrapper-->
    <?php endif; ?>

    <?php if ( have_posts() ) : ?>

      <div class="post-list__posts">

        <div class="post-list__posts-sizer"></div>

        <?php the_prev_post_list_items(); ?>

        <?php while ( have_posts() ) : the_post(); ?>
          
          <?php the_post_list_item( $post->ID ); ?>

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

</article><!--.post-list-->