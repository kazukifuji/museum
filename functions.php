<?php
/*-------------------------------------------

＊＊＊目次＊＊＊

＊初期設定
-テーマサポートを登録
-デフォルトのヘッダー画像を登録
-テーマのcontent_widthを設定

＊css, jsファイルの読み込み

＊ウィジェット関連

＊ナビゲーションメニュー関連

＊コメント欄関連

＊その他カスタマイズ  
-term_description()からpタグを削除
-投稿の先頭固定表示機能を無効化
-アーカイブタイトルをカスタマイズ
-パスワード保護ページの記事タイトルの「保護中：」の文言を削除
-パスワード保護ページの内容をカスタマイズ

＊独自関数
-投稿リストの投稿アイテムを出力
-'load_count'URLパラメータを元に、前のページの投稿リストの投稿アイテムを出力

-------------------------------------------*/
/*-------------------------

初期設定

-------------------------*/
//テーマサポートを登録
add_action( 'after_setup_theme', 'museum_theme_supports' );
function museum_theme_supports() {
  add_theme_support( 'editor-styles' );
  add_editor_style( '/dist/css/editor-style.css' );
  add_theme_support( 'title-tag' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'custom-header', [
    'default-image' => esc_url( get_template_directory_uri() . '/assets/images/header.jpg' ),
    'width'              => '1200',
    'height'             => '800',
    'flex-width'         => true,
    'flex-height'        => true,
    'header-text'        => false,
    'default-text-color' => 'FFF',
    'video'              => false,
    'uploads'            => false,
    'random-default'     => false,
  ] );
}


//デフォルトのヘッダー画像を登録
add_action( 'after_serup_theme', 'museum_default_headers' );
function museum_default_headers() {
  register_default_headers([
    'default-image' => [
      'url' => esc_url( get_template_directory_uri() . '/assets/images/header.jpg' ),
      'thumbnail_url' => esc_url( get_template_directory_uri() . '/assets/images/header.jpg' ),
    ],
  ]);
}


//テーマのcontent_widthを設定
add_action( 'after_setup_theme', 'museum_content_width', 0 );
function museum_content_width() {
  $GLOBALS['content_width'] = apply_filters( 'museum_content_width', 850 );
}



/*-------------------------

css, jsファイルの読み込み

-------------------------*/



/*-------------------------

ウィジェット関連

-------------------------*/



/*-------------------------

ナビゲーションメニュー関連

-------------------------*/



/*-------------------------

コメント欄関連

-------------------------*/



/*-------------------------

その他カスタマイズ

-------------------------*/
//term_description()からpタグを削除
remove_filter( 'term_description', 'wpautop' );


//投稿の先頭固定表示機能を無効化
add_action( 'pre_get_posts', 'disable_post_top_display' );
function disable_post_top_display( $query ) {
  if ( is_admin() || !$query->is_main_query() ) return;
  $query->set( 'ignore_sticky_posts', true );
}


//アーカイブタイトルをカスタマイズ
add_filter( 'get_the_archive_title', 'museum_archive_title' );
function museum_archive_title( $title ) {
  //ホームページ
  if ( is_home() || is_front_page() ) {
    $title = '最近の投稿';

  //カテゴリー、タグアーカイブ
  } elseif ( is_category() || is_tag() || is_tax() ) {
    $title = single_cat_title('', false);
    
  //日時アーカイブ
  } else if ( is_date() ) {
    //年別
    if ( is_year() ) {
      $title = get_the_time('Y年');
    //月別
    } elseif ( is_month() ) {
      $title = get_the_time('Y年m月');
    //日別
    } else {
      $title = get_the_time('Y年m月d日');
    }

  //投稿著者アーカイブ
  } else if ( is_author() ) {
    $title = get_queried_object()->data->display_name;

  //検索結果ページ
  } else if ( is_search() ) {
    $title = '「' . esc_html( get_search_query() ) . '」の検索結果';
  }

  return $title;
}


//パスワード保護ページの記事タイトルの「保護中：」の文言を削除
add_filter( 'protected_title_format', 'remove_protected_text' );
function remove_protected_text( $title ) {
  return '%s';;
}


//パスワード保護ページの内容をカスタマイズ
add_filter( 'the_password_form', 'museum_password_form' );
function museum_password_form() {
  ?>

  <form class="post-password-form" action="<?php echo esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ); ?>" method="post">
    <p class="post-passsword-form__text">
      <?php _e( 'This content is password protected. To view it please enter your password below:' ); ?>
    </p>

    <div class="post-password-form__flex-container">
      <input class="post-password-form__textbox" name="post_password" type="password" size="20" placeholder="パスワード">
      <input class="post-password-form__submit" type="submit" name="Submit" value="<?php echo esc_attr_x( 'Enter', 'post password form' ); ?>">
    </div><!--.post-password-form__flex-container-->
  </form>

  <?php
}



/*-------------------------

独自関数

-------------------------*/
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
                <svg class="post-item__content-taxonomy-icon-svg" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" >
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

locate_template('./functions/nav-menu.php', true);  //ナビゲーションメニューの設定
locate_template('./functions/widgets.php', true);   //ウィジェットの設定
locate_template('./functions/comments.php', true);  //コメント欄の設定
locate_template('./functions/scripts.php', true);   //外部css, jsファイルの読み込み