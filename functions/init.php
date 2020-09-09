<?php
//テーマの初期設定
add_action( 'after_setup_theme', function() {
  //サポートを登録
  add_theme_support( 'title-tag' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'automatic-feed-links' );
} );

//$content_widthを設定
add_action( 'after_setup_theme', function() {
  $GLOBALS['content_width'] = apply_filters( 'mytheme_content_width', 740 );
}, 0 );