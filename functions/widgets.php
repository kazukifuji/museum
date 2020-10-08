<?php
//ウィジェットを登録
add_action( 'widgets_init', 'museum_widgets' );
function museum_widgets() {
  register_sidebar([
    'name' => 'サイドバー',
    'id' => 'sidebar',
    'description' => 'サイドバーに表示されるウィジェットの設定です',
    'before_widget' => '<aside class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ]);
}