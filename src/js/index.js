import objectFitPolyfill from 'objectFitPolyfill';
import whatInput from 'what-input';

import hamburgerButton from './features/hamburgerButton';
import heroHeader from './features/heroHeader';
import postList from './features/postList';

//ハンバーガーボタンの初期設定
hamburgerButton.init();

//ヒーローヘッダーの初期設定
heroHeader.init();

//投稿リストの初期設定
postList.init();

window.addEventListener( 'load', () => {
  //ハンバーガーボタンにクリックイベントを追加。
  hamburgerButton.addClickEvent();

  //ヒーローヘッダーの高さを設定
  heroHeader.setHeight();
  
  //投稿リストにグリッドレイアウトを実装
  postList.implementGridLayout();

  //投稿リストに投稿のAjax追加機能を実装
  postList.implementAjaxPostAddition();
}, { once: true } );