import setHeroHeaderHeight from './features/setHeroHeaderHeight';

window.addEventListener( 'load', () => {
  //ヒーローヘッダーの高さを設定
  setHeroHeaderHeight();
}, { once: true } );