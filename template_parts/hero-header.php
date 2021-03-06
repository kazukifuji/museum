<div id="heroHeader" class="hero-header">

  <div class="hero-header__bg">
    <?php $url = has_header_image() ? get_header_image() : get_theme_support( 'custom-header', 'default-image' ); ?>
    <img class="hero-header__bg-img" src="<?php echo esc_url( $url ); ?>" data-object-fit="cover">

    <svg class="hero-header__bg-grid-line-svg" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1000 1000" height="1000" width="1000">
      <path d="M 200,0 V 1000"></path>
      <path d="M 400,0 V 1000"></path>
      <path d="M 600,0 V 1000"></path>
      <path d="M 800,0 V 1000"></path>
      <path d="M 0,200 H 1000"></path>
      <path d="M 0,400 H 1000"></path>
      <path d="M 0,600 H 1000"></path>
      <path d="M 0,800 H 1000"></path>
    </svg>
  </div><!--.hero-header__bg-->

  <div class="hero-header__heading">
    <div class="wrapper">
      <h1 class="hero-header__heading-logo">
        <?php get_template_part('template_parts/logo'); ?>
      </h1>

      <p class="hero-header__heading-catch-copy">
        <?php bloginfo('description'); ?>
      </p>
    </div>
  </div><!--.hero-header__heading-->

</div><!--.hero-header-->