<?php
//テーマの初期設定
add_action( 'after_setup_theme', function() {
  //サポートを登録
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

  //デフォルトのヘッダー画像を登録
  register_default_headers([
    'default-image' => [
      'url' => esc_url( get_template_directory_uri() . '/assets/images/header.jpg' ),
      'thumbnail_url' => esc_url( get_template_directory_uri() . '/assets/images/header.jpg' ),
    ],
  ]);
} );

//$content_widthを設定
add_action( 'after_setup_theme', function() {
  $GLOBALS['content_width'] = apply_filters( 'mytheme_content_width', 740 );
}, 0 );