<?php
//cssファイルの読み込み
add_action( 'wp_enqueue_scripts', 'museum_enqueue_styles' );
function museum_enqueue_styles() {
  wp_enqueue_style( 'style', get_template_directory_uri() . '/dist/css/style.css' );
}

//jsファイルの読み込み
add_action( 'wp_enqueue_scripts', 'museum_enqueue_scripts' );
function museum_enqueue_scripts() {
  wp_enqueue_script( 'script', get_template_directory_uri() . '/dist/js/script.js', [], false, true );

  ///wp-includes/js/comment-reply.js
  if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
}