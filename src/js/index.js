import objectFitPolyfill from 'objectFitPolyfill';
import whatInput from 'what-input';

import hamburgerButton from './features/hamburgerButton';
import heroHeader from './features/heroHeader';
import postList from './features/postList';

//ハンバーガーボタンの初期設定
hamburgerButton.init();

//ヒーローヘッダーの初期設定
heroHeader.init();

window.addEventListener( 'load', () => {
  //ハンバーガーボタンにクリックイベントを追加。
  hamburgerButton.addClickEvent();
  //ヒーローヘッダーの高さを設定
  heroHeader.setHeight();
  //投稿リストの機能を設定
  postList();
}, { once: true } );