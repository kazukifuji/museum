//ヒーローヘッダー
const heroHeader = document.getElementById('heroHeader');
//ヘッダー
const header = document.getElementById('header');

export default {
  //ヒーローヘッダーの高さを設定
  setHeight: () => {
    if ( !heroHeader ) return;
    heroHeader.style.height = window.innerHeight - header.offsetHeight + 'px';
  }
}