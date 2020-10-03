import objectFitPolyfill from 'objectFitPolyfill';
import whatInput from 'what-input';

import hamburgerButton from './features/hamburgerButton';
import setHeroHeaderHeight from './features/setHeroHeaderHeight';
import postList from './features/postList';

window.addEventListener( 'load', () => {
  //ハンバーガーボタンにサイドバー開閉機能を設定
  hamburgerButton();
  //ヒーローヘッダーの高さを設定
  setHeroHeaderHeight();
  //投稿リストの機能を設定
  postList();
}, { once: true } );