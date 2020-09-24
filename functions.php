<?php
locate_template('./functions/init.php', true);      //テーマの初期設定
locate_template('./functions/content.php', true);   //コンテンツ部分の関数など
locate_template('./functions/nav-menu.php', true);  //ナビゲーションメニューの設定
locate_template('./functions/widgets.php', true);   //ウィジェットの設定
locate_template('./functions/comments.php', true);  //コメント欄の設定
locate_template('./functions/scripts.php', true);   //外部css, jsファイルの読み込み