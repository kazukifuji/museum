export default {
  //初期設定
  init: function() {
    this.element = document.getElementById('hamburgerButton');
    this.operateSidebarElem = document.getElementById('sidebar');
  },

  //クリックイベントを追加
  addClickEvent: function() {
    //アクティブ
    const active = () => {
      this.element.classList.add('-active');
      this.operateSidebarElem.classList.add('-open');
      this.operateSidebarElem.classList.remove('-close');
      //リサイズイベントを追加
      window.addEventListener( 'resize', monitor );
    };

    //パッシブ
    const passive = () => {
      this.element.classList.remove('-active');
      this.operateSidebarElem.classList.remove('-open');
      this.operateSidebarElem.classList.add('-close');
      //リサイズイベントを削除
      window.removeEventListener( 'resize', monitor );
    };

    //監視
    const monitor = () => {
      //画面の幅がPC幅を越えたらパッシブ状態にする
      if ( window.innerWidth >= 1024 ) passive();
    };

    //イベント追加
    this.element.addEventListener( 'click', function() {
      if ( this.classList.contains('-active') )  passive();
      else active();
    } );
  },
}