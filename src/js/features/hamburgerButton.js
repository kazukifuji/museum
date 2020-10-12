export default () => {
  const hamburgerButton = document.getElementById('hamburgerButton');
  const sidebar = document.getElementById('sidebar');

  //クリックイベント
  hamburgerButton.addEventListener( 'click', function() {
    if ( this.classList.contains('-active') )  passive();
    else active();
  } );

  //アクティブ
  function active() {
    hamburgerButton.classList.add('-active');
    sidebar.classList.add('-open');
    document.body.style.overflow = 'hidden';
    //リサイズイベントを追加
    window.addEventListener( 'resize', monitor );
  }

  //パッシブ
  function passive() {
    hamburgerButton.classList.remove('-active');
    sidebar.classList.remove('-open');
    document.body.style.overflow = '';
    //リサイズイベントを削除
    window.removeEventListener( 'resize', monitor );
  }

  //監視
  function monitor() {
    //画面の幅がPC幅を越えたらパッシブ状態にする
    if ( window.innerWidth >= 1024 ) passive();
  }
}