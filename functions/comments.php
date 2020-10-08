<?php
//コメントのオートリンク機能を無効化
remove_filter( 'comment_text', 'make_clickable', 9 );


//コメントフォームの内容をカスタマイズ
add_filter( 'comment_form_defaults', 'museum_comment_form_default' );
function museum_comment_form_default( $args ) {
  unset($args['fields']['email']);
  unset($args['fields']['url']);
  $args['fields']['author'] = '<p class="comment-form-author"><label for="author">名前</label> ' .
                                '<input id="author" name="author" type="text" value="名無しさん" size="30" maxlength="30">' .
                              '</p>';
  $args['submit_button'] = '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s">%4$s</button>';
  return $args;
}


//コメントフォームのコメントフィールドを一番下に移動
add_filter( 'comment_form_fields', 'move_comment_field_bottom' );
function move_comment_field_bottom( $fields ) {
  $comment_field = $fields['comment'];
  unset( $fields['comment'] );
  $fields['comment'] = $comment_field;
  return $fields;
}


//コメントでタグの使用を無効にする
add_filter( 'comment_text', 'invalidate_comment_tags', 9 );
add_filter( 'comment_text_rss', 'invalidate_comment_tags', 9 );
add_filter( 'comment_excerpt', 'invalidate_comment_tags', 9 );
function invalidate_comment_tags( $comment ) {
  if ( get_comment_type() == 'comment' ) {
    $comment = htmlspecialchars( $comment, ENT_QUOTES );
  }
  return $comment;
}


//名前フィールドの初期値に「名無しさん」を設定
add_filter( 'get_comment_author', 'name_field_initial_value' );
function name_field_initial_value( $author ) {
  if ( $author == __('Anonymous') ) $author = '名無しさん';
  return $author;
}


//コメントリストをカスタマイズ
function custom_list_comments( $comment, $args, $depth ) {
  ?>

  <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?> >

    <article class="comment-content">

      <div class="comment-head">
        <?php echo get_avatar($comment, 36); ?>
        <p class="comment-author"><?php comment_author(); ?></p>
      </div>

      <div class="comment-body">
        <?php comment_text(); ?>
      </div>

      <div class="comment-foot">
        <span class="comment-date">
          <?php comment_date(); ?>
          <?php comment_time(); ?>
        </span>

        <div class="comment-reply">
          <?php
          comment_reply_link( array_merge( $args, [
            'reply_text' => '返信',
            'depth'      => $depth,
            'max_depth'  => $args['max_depth'],
          ] ) );
          ?>
        </div>
      </div>
    
    </article>

  <?php
}