<?php if ( post_password_required() ) return; ?>

<aside class="comments">

  <?php comment_form([
    'comment_notes_before'  => '',
    'title_reply'           => 'コメント',
    'cancel_reply_link'     => 'キャンセル',
    'label_submit'          => '送信',
    'logged_in_as'          => '<p class="logged-in-as">' . sprintf( '<a href="%1$s">%2$s</a>としてログイン中です。<a class="logout-link" href="%3$s" title="Log out of this account">ログアウト</a>', admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>'
  ]); ?>

  <?php if ( have_comments() ) : ?>

    <div class="comment-list">

      <h3 class="comment-list-title">コメント一覧</h3>

      <ol class="comment-list-items">
        <?php wp_list_comments([
          'style' => 'ol',
          'callback'    => 'custom_list_comments',
        ]); ?>
      </ol>

    </div>

    <?php if ( get_comment_pages_count() > 1 ) : ?>
      <div class="pagination">
        <?php paginate_comments_links(); ?>
      </div>
    <?php endif; ?>

  <?php endif; ?>

</aside>