<form id="searchform" class="searchform" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <div class="searchform__flex-container">

    <input id="s" class="searchform__textbox" type="text" value="" name="s" placeholder="キーワード検索">

    <button  id="searchsubmit" class="searchform__submit" type="submit" value="Search">
      <svg class="searchform__submit-icon" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
        <circle cx="11" cy="11" r="8"></circle>
        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
      </svg>
    </button>

  </div><!--.searchform__flex-container-->
</form>