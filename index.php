<?php get_header(); ?>

  <?php if ( !is_home() && !is_front_page() ) : ?>
    <div class="wrapper">
      <div class="main__heading">

          <p class="main__heading-subtitle">
            <?php if ( is_search() ) echo 'search';
            elseif ( is_date() ) echo 'date';
            elseif ( is_author() ) echo 'author';
            elseif ( is_category() ) echo 'category';
            elseif ( is_tag() ) echo 'tag';
            elseif ( is_tax() ) echo esc_html( get_query_var('taxonomy') );
            ?>
          </p>

          <h1 class="main__heading-title">
            <?php //ページごとに決められたアイコンを表示

              //カテゴリー、タグアーカイブ
              if ( is_category() || is_tag() || is_tax() ) {
            
                if ( is_category() || is_tax() ) {
                  $icon = <<<EOD
                  <svg class="main__heading-icon-svg" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                    <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                  </svg>
                  EOD;
            
                } else if ( is_tag() ) {
                  $icon = <<<EOD
                  <svg class="main__heading-icon-svg" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" >
                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                    <line x1="7" y1="7" x2="7.01" y2="7"></line>
                  </svg>
                  EOD;
                }
                
              //日時アーカイブ
              } else if ( is_date() ) {
                $icon = <<<EOD
                <svg class="main__heading-icon-svg" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                  <circle cx="12" cy="12" r="10"></circle>
                  <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                EOD;

              //投稿著者アーカイブ
              } else if ( is_author() ) {
                $icon = <<<EOD
                <svg class="main__heading-icon-svg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle>
                </svg>
                EOD;
            
              //検索結果ページ
              } else if ( is_search() ) {
                $icon = <<<EOD
                <svg class="main__heading-icon-svg" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                  <circle cx="11" cy="11" r="8"></circle>
                  <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                EOD;
              }
            
              if ( isset( $icon ) ) echo '<span class="main__heading-icon">' . $icon . '</span>';
            ?>

            <?php the_archive_title(); ?>
          </h1>

          <?php if ( is_category() || is_tag() || is_tax() ) : ?>
            <?php $desc_text = esc_html( get_queried_object()->description );
            if ( $desc_text !== '' ) : ?>

              <p class="main__heading-description"><?php echo $desc_text; ?></p>

            <?php endif; ?>
          <?php endif; ?>
      
      </div><!--.main__heading-->
    </div><!--.wrapper-->
  <?php endif; ?>

  <article>
  
    <?php get_template_part('template_parts/post-list'); ?>

  </article>

<?php get_footer(); ?>