<?php if ( post_password_required() ) return; ?>

<div class="wrapper">
  <aside class="comments">

    <?php comment_form([
      'comment_notes_before'  => '',
      'title_reply'           => 'コメント',
      'cancel_reply_link'     => 'キャンセル',
      'label_submit'          => '送信',
    ]); ?>

    <?php if ( have_comments() ) : ?>

      <div class="comment-list">

        <h3 class="comment-list-title">コメント一覧</h3>

        <ol class="comment-list-items">
          <?php wp_list_comments([
            'style' => 'ol',
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
</div><!--.wrapper-->