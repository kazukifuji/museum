<?php if ( is_attachment() ) wp_redirect( $post->guid ); ?>

<?php get_header(); ?>

  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>

      <div class="wrapper -no-side-space -sp">

        <article <?php post_class('post-single'); ?>>

          <?php if ( has_post_thumbnail() ) : ?>
            <figure class="post-single__featured-media">
              <?php the_post_thumbnail( 'post-thumbnail', [ 'data-object-fit' => 'cover' ] ); ?>
            </figure>
          <?php endif; ?>

          <div class="wrapper -no-side-space -pc -tc">
            <div class="post-single__body">

              <header class="post-single__header">
                <div class="post-single__date">
                  <span class="post-single__date-icon">
                    <svg class="post-single__date-icon-svg" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                      <circle cx="12" cy="12" r="10"></circle>
                      <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                  </span>

                  <time class="post-single__date-value"><?php echo esc_html( get_the_time( get_option('date_format') ) ); ?></time>
                </div><!--.post-single__date-->

                <?php the_title( '<h1 class="post-single__title">', '</h1>' ); ?>
              </header>

              <div class="post-single__content">
                <?php the_content( 'READ MORE', true ); ?>
                    
                <?php wp_link_pages([
                  'before' => '<div class="pagination">',
                  'after' => '</div>',
                ]); ?>
              </div><!--.post-single__content-->

              <footer class="post-single__footer">

                <?php $categories = get_the_category();
                if ( $categories ) : ?>
                  <div class="post-single__taxonomy">
                    <span class="post-single__taxonomy-icon">
                      <svg class="post-single__taxonomy-icon-svg" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                        <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                      </svg>
                    </span>

                    <ul class="post-single__taxonomy-list">
                      <?php foreach ( $categories as $category ) : ?>
                        <li class="post-single__taxonomy-list-item">
                          <a class="post-single__taxonomy-list-item-link" href="<?php echo esc_url( get_term_link($category) ); ?>">
                            <?php echo esc_html( $category->name ); ?>
                          </a>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div><!--.post-single__taxonomy-->
                <?php endif; ?>

                <?php $tags = get_the_tags();
                if ( $tags ) : ?>
                  <div class="post-single__taxonomy">
                    <span class="post-single__taxonomy-icon">
                      <svg class="post-single__taxonomy-icon-svg" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" >
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                        <line x1="7" y1="7" x2="7.01" y2="7"></line>
                      </svg>
                    </span>

                    <ul class="post-single__taxonomy-list">
                      <?php foreach ( $tags as $tag ) : ?>
                        <li class="post-single__taxonomy-list-item">
                          <a class="post-single__taxonomy-list-item-link" href="<?php echo esc_url( get_term_link($tag) ); ?>">
                            <?php echo esc_html( $tag->name ); ?>
                          </a>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div><!--.post-single__taxonomy-->
                <?php endif; ?>

              </footer>

            </div><!--.post-single__body-->
          </div><!--.wrapper-->

        </article>

      </div><!--.wrapper-->

    <?php endwhile; ?>
  <?php else : ?>

    <p class="main__error-text">No posts</p>

  <?php endif; ?>

  <?php if ( is_single() ) : ?>
    <div class="wrapper">
      <?php get_template_part('template_parts/posts-navigation'); ?>
    </div><!--.wrapper-->
  <?php endif; ?>
  
  <?php if ( comments_open() && !post_password_required() ) : ?>
    <div class="wrapper">
      <?php comments_template(); ?>
    </div><!--.wrapper-->
  <?php endif; ?>
  
<?php get_footer(); ?>