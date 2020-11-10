import Masonry from 'masonry-layout';
import InfiniteScroll from 'infinite-scroll';
import ImagesLoaded from 'imagesloaded';

InfiniteScroll.imagesLoaded = ImagesLoaded;

export default {
  //初期設定
  init: function() {
    //投稿リスト
    this.element = document.getElementById('postList');
    console.dir(this.element);
    if ( !this.element ) return;

    //投稿コンテナー
    this.postsContainerElem = this.element.querySelector('.post-list__posts');

    //次のページリンク要素
    this.nextPageLink = {
      selector: '.post-list__navigation-next-page-link > a',
      element: this.element.querySelector('.post-list__navigation-next-page-link > a'),
      deleteURLParam: function(param) {
        const nextPageURL = new URL( this.element.href );
        nextPageURL.searchParams.delete( param );
        this.element.href = nextPageURL;
      }
    };

    //投稿追加表示ボタン
    this.showMoreButton = {
      selector: '.post-list__show-more-button',
      element: this.element.querySelector('.post-list__show-more-button'),
    };

    //投稿リストのステータス要素
    this.status = {
      selector: '.post-list__page-load-status',
      element: this.element.querySelector('.post-list__page-load-status'),
    };

    //投稿リストのナビゲーション要素
    this.navigation = {
      selector: '.post-list__navigation',
      element: this.element.querySelector('.post-list__navigation'),
    };
  },


  //グリッドレイアウトを実装
  implementGridLayout: function() {
    if ( !this.postsContainerElem ) return;

    this.masonry = new Masonry( this.postsContainerElem, {
      itemSelector: '.post-item',
      columnWidth: '.post-list__posts-sizer',
      percentPosition: true,
    } );
  },


  //投稿のAjax追加機能を実装
  implementAjaxPostAddition: function() {
    if ( !this.postsContainerElem ) return;

    if ( this.nextPageLink.element ) {
      //次のページリンク要素のURLパラメータ「load_count」を削除
      this.nextPageLink.deleteURLParam('load_count');

      const loadCountParam = {
        start: Number( new URL( location.href ).searchParams.get('load_count') ),
        countUp: function( path, loadCount ) {
          const url = new URL( path );
          url.searchParams.set( 'load_count', this.start + loadCount );
          history.replaceState( null, '', url );
        },
      };

      this.infiniteScroll = new InfiniteScroll( this.postsContainerElem, {
        outlayer: this.masonry,
        path: this.nextPageLink.selector,
        append: '.post-item',
        button: this.showMoreButton.selector,
        scrollThreshold: false,
        status: this.status.selector,
        hideNav: this.navigation.selector,
        history: false,
      } );

      //ロード完了後にトリガーするイベント
      this.infiniteScroll.on( 'load', function( document, path ) {
        loadCountParam.countUp( path, this.loadCount );
      } );

    } else {
      this.showMoreButton.element.style.display = 'none';
      this.status.element.style.display = 'block';
      document.querySelector( this.status.selector + ' > .infinite-scroll-request' ).style.display = 'none';
      document.querySelector( this.status.selector + ' > .infinite-scroll-error' ).style.display = 'none';
      this.navigation.element.style.display = 'none';
    }
  }, 
}