<?php
//カスタムナビゲーションメニューを登録
add_action( 'after_setup_theme', 'museum_nav_menu' );
function museum_nav_menu() {
  register_nav_menu( 'sidebar', 'サイドバー' );
}


//メニューのアイテム要素のidを削除
add_filter( 'nav_menu_item_id', 'remove_nav_menu_item_id' );
function remove_nav_menu_item_id( $id ) {
  $id = null;
  return $id;
}