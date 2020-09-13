<div id="sidebar" class="sidebar">
  <div class="sidebar__inner">
    <?php 

    echo '<h4 class="sidebar__logo">';
    get_template_part('template_parts/logo');
    echo '</h4>';

    //ナビゲーションメニュー
    wp_nav_menu([
      'container'       => 'nav',
      'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
    ]);

    //ウィジェット
    if (is_active_sidebar('sidebar')) {
      dynamic_sidebar('sidebar');
    }
    ?>
    
  </div><!--.sidebar__inner-->
</div><!--.sidebar-->