<?php
//コンテンツ部分の関数

//メイクエリの制御
add_action( 'pre_get_posts', function($query) {
  if ( is_admin() || !$query->is_main_query() ) return;

  //投稿の先頭固定表示設定を反映させない
  $query->set( 'ignore_sticky_posts', true );
} );

//投稿リストの投稿アイテムを出力
//※引数「$post_id」を指定しない場合、現在の投稿を取得。
function the_post_list_item( $post_id = null ) {
  //投稿オブジェクトを取得
  $post_obj = get_post( $post_id );
  ?>

  <article <?php post_class('post-item'); ?>>
          
    <a class="post-item__link" href="<?php the_permalink( $post_obj ); ?>">
    
      <?php if ( has_post_thumbnail( $post_obj->ID ) ) : ?>
        <figure class="post-item__featured-media">
          <?php echo get_the_post_thumbnail( $post_obj->ID, 'post-thumbnail', [ 'data-object-fit' => 'cover' ] ); ?>
        </figure><!--post-item__featured-media-->
      <?php endif; ?>

      <div class="post-item__content">

        <?php $post_title = esc_html( get_the_title( $post_obj ) );
        if ( $post_title !== '' ) : ?>
          <div class="post-item__content-header">
            <h2 class="post-item__content-title">
              <?php echo $post_title; ?>
            </h2>
          </div><!--post-item__content-header-->
        <?php endif; ?>
        
        <div class="post-item__content-footer">

          <?php $categories = get_the_category( $post_obj->ID );
          if ( $categories ) : ?>
            <div class="post-item__content-taxonomy">
              <span class="post-item__content-taxonomy-icon">
                <svg class="post-item__content-taxonomy-icon-svg" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                  <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                </svg>
              </span>

              <ul class="post-item__content-taxonomy-list">
                <?php foreach ( $categories as $category ) : ?>
                  <li class="post-item__content-taxonomy-list-item"><?php echo esc_html( $category->name ); ?></li>
                <?php endforeach; ?>
              </ul>

            </div><!--.post-item__content-taxonomy-->
          <?php endif; ?>

          <?php $tags = get_the_tags( $post_obj->ID );
          if ( $tags ) : ?>
            <div class="post-item__content-taxonomy">
              <span class="post-item__content-taxonomy-icon">
                <svg class="post-item__content-taxonomy-icon-svg" xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" >
                  <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                  <line x1="7" y1="7" x2="7.01" y2="7"></line>
                </svg>
              </span>

              <ul class="post-item__content-taxonomy-list">
                <?php foreach ( $tags as $tag ) : ?>
                  <li class="post-item__content-taxonomy-list-item"><?php echo esc_html( $tag->name ); ?></li>
                <?php endforeach; ?>
              </ul>

            </div><!--.post-item__content-taxonomy-->
          <?php endif; ?>
        
        </div><!--post-item_content-footer-->
      
      </div><!--.post-item__content-->

    </a>

  </article><!--.post-item-->

  <?php
}

//'load_count'URLパラメータを元に、前のページの投稿リストの投稿アイテムを出力
function the_prev_post_list_items() {
  global $wp_query;

  if ( !isset( $_GET['load_count'] ) ) return;

  $load_count = (int) wp_unslash( $_GET['load_count'] );
  if ( $load_count <= 0 ) return;

  $current_page = (int) get_query_var('paged');
  if ( $current_page <= 0 ) $current_page = 1;

  $load_page = $current_page - $load_count;
  if ( $load_page <= 0 ) return;

  $args = $wp_query->query_vars;
  $args['paged'] = $load_page;
  $args['posts_per_page'] = $load_count * (int) get_option('posts_per_page');

  $query = new WP_Query( $args );

  if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
      $query->the_post();
      the_post_list_item( $query->post->ID );
    }
    wp_reset_postdata();
  }
}