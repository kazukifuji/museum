<?php get_header(); ?>

  <?php if ( !is_home() && !is_front_page() ) : ?>
    <div class="wrapper">
      <h1 class="main__heading-1" data-subtitle="<?php
      if ( is_search() ) echo '- search -';
      elseif ( is_date() ) echo '- date -';
      elseif ( is_author() ) echo '- author -';
      elseif ( is_category() ) echo '- category -';
      elseif ( is_tag() ) echo '- tag -';
      elseif ( is_tax() ) echo '- ' . esc_html( get_query_var('taxonomy') ) . ' -';
      ?>">

        <?php the_archive_title(); ?>

      </h1><!--.main__heading-->
    </div><!--.wrapper-->
  <?php endif; ?>

  <article>
  
    <?php get_template_part('template_parts/post-list'); ?>

  </article>

<?php get_footer(); ?>