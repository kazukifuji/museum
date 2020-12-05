import objectFitPolyfill from 'objectFitPolyfill';
import whatInput from 'what-input';

import hamburgerButton from './features/hamburgerButton';
import heroHeader from './features/heroHeader';
import postList from './features/postList';

//ハンバーガーボタンにサイドバー開閉機能を実装
hamburgerButton.implementFeature();

window.addEventListener( 'load', () => {
  //ヒーローヘッダーの高さを設定
  heroHeader.setHeight();
  
  //投稿リストにグリッドレイアウトを実装
  postList.implementGridLayout();

  //投稿リストに投稿のAjax追加機能を実装
  postList.implementAjaxPostAddition();
}, { once: true } );