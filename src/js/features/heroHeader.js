export default {
  //初期設定
  init: function() {
    //ヒーローヘッダー
    this.element = document.getElementById('heroHeader');
    //ヘッダー
    this.headerElem = document.getElementById('header');
  },

  //高さを設定
  setHeight: function() {
    if ( !this.element ) return;
    this.element.style.height = window.innerHeight - this.headerElem.offsetHeight + 'px';
  },
}