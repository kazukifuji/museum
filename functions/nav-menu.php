<?php
//ナビゲーションメニューの設定
add_action( 'after_setup_theme', function() {
  register_nav_menu('sidebar', 'サイドバー');
} );

//li要素のidを削除
add_filter( 'nav_menu_item_id', function($id) {
  $id = null;
  return $id;
} );