//ハンバーガーボタン
const hamburgerButton = document.getElementById('hamburgerButton');
//サイドバー
const sidebar = document.getElementById('sidebar');
//コンテンツ
const content = document.getElementById('content');
//WordPressの管理バー
const wpAdminBar = document.getElementById('wpadminbar');

//縦スクロール量
let scrollLengY = 0;

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
      //モーダルを有効
      enableModal();
      hamburgerButton.classList.add('-active');
      sidebar.classList.add('-open');
      sidebar.classList.remove('-close');
      //リサイズイベントを追加
      window.addEventListener( 'resize', monitor );
    }
    
    //パッシブ
    function passive() {
      //モーダルを無効
      disableModal();
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

    //モーダルを有効
    function enableModal() {
      const wpAdminBarHeight = ( wpAdminBar ) ? wpAdminBar.offsetHeight : 0;
      //現在スクロールバーが表示されていればそのまま表示させる
      if ( window.innerHeight < content.offsetHeight + wpAdminBarHeight ) {        document.body.style.overflowY = 'scroll';
        document.body.style.overflowY = 'scroll';
      }
      //縦スクロール量を保存
      scrollLengY = window.pageYOffset;
      content.style.top = ( -1 * scrollLengY + wpAdminBarHeight ) + 'px';
      content.style.position = 'fixed';
    }

    //モーダルを無効
    function disableModal() {
      content.style.top = '';
      content.style.position = '';
      document.body.style.overflowY = '';
      //スクロール位置が一番上まで移動しているので、
      //保存していたスクロール量分、移動させる
      window.scrollTo( 0, scrollLengY );
    }
  },
}