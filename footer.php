      </main><!--.main-->

      <footer class="footer">
        <small class="footer__copyright">&copy; <?php echo date('Y'); ?> <?php echo esc_url( home_url() ); ?> All rights reserved.</small>
      </footer>

    </div><!--.content-->

    <?php get_sidebar(); ?>

    <?php wp_footer(); ?>
  </body>
</html>