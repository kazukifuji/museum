//ハンバーガーボタン
const hamburgerButton = document.getElementById('hamburgerButton');
//サイドバー
const sidebar = document.getElementById('sidebar');

export default {
  //ハンバーガーボタンにサイドバー開閉機能を実装
  implementFeature: () => {
    //ハンバーガーボタンにクリックイベントを追加
    hamburgerButton.addEventListener( 'click', function() {
      if ( this.classList.contains('-active') )  passive();
      else active();
    } );

    //アクティブ
    function active() {
      hamburgerButton.classList.add('-active');
      sidebar.classList.add('-open');
      sidebar.classList.remove('-close');
      //リサイズイベントを追加
      window.addEventListener( 'resize', monitor );
    }
    
    //パッシブ
    function passive() {
      hamburgerButton.classList.remove('-active');
      sidebar.classList.remove('-open');
      sidebar.classList.add('-close');
      //リサイズイベントを削除
      window.removeEventListener( 'resize', monitor );
    }
    
    //監視
    function monitor() {
      //画面の幅がPC幅を越えたらパッシブ状態にする
      if ( window.innerWidth >= 1024 ) passive();
    }
  },
}