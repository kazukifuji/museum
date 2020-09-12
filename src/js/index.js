//object-fitポリフィル
import objectFitPolyfill from 'objectFitPolyfill';

import setHeroHeaderHeight from './features/setHeroHeaderHeight';
import postList from './features/postList';

window.addEventListener( 'load', () => {
  //ヒーローヘッダーの高さを設定
  setHeroHeaderHeight();
  //投稿リストの機能を設定
  postList();
}, { once: true } );