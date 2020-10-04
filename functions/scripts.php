<?php
//外部css, jsファイルの読み込み
add_action( 'wp_enqueue_scripts', function() {
  //css
  wp_enqueue_style( 'style', get_template_directory_uri() . '/dist/css/style.css' );
  //js
  wp_enqueue_script( 'script', get_template_directory_uri() . '/dist/js/script.js', [], false, true );
  
  if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
} );