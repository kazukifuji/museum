export default () => {
  const hamburgerButton = document.getElementById('hamburgerButton');
  const sidebar = document.getElementById('sidebar');

  //クリックイベント
  hamburgerButton.addEventListener( 'click', function() {
    if ( this.classList.contains('-active') ) {
      this.classList.remove('-active');
      sidebar.classList.remove('-open');
      //リサイズイベントを追加
      window.addEventListener( 'resize', resize );
    } else {
      this.classList.add('-active');
      sidebar.classList.add('-open');
    }
  } );

  //リサイズ
  function resize() {
    //画面の幅がPC幅を越えたらクラスを取り除く
    if ( window.innerWidth >= 1024 ) {
      hamburgerButton.classList.remove('-active');
      sidebar.classList.remove('-open');
      //リサイズイベントを削除
      window.removeEventListener( 'resize', resize );
    }
  }
}