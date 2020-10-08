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

＊独自関数

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



/*-------------------------

独自関数

-------------------------*/

locate_template('./functions/content.php', true);   //コンテンツ部分の関数など
locate_template('./functions/nav-menu.php', true);  //ナビゲーションメニューの設定
locate_template('./functions/widgets.php', true);   //ウィジェットの設定
locate_template('./functions/comments.php', true);  //コメント欄の設定
locate_template('./functions/scripts.php', true);   //外部css, jsファイルの読み込み