<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
  </head>
  <body <?php body_class( 'body' ); ?>>

    <?php if ( is_home() || is_fromt_page() ) get_template_part( 'template_parts/hero-header' ); ?>

    <div class="content">