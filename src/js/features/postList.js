import Masonry from 'masonry-layout';
import InfiniteScroll from 'infinite-scroll';
import ImagesLoaded from 'imagesloaded';

InfiniteScroll.imagesLoaded = ImagesLoaded;

//投稿リスト
const postList = document.getElementById('postList');

if ( postList ) {
  //投稿コンテナー
  var postContainer = postList.querySelector('.post-list__posts');

  //次のページリンク要素
  var nextPageLink = {
    selector: '.post-list__navigation-next-page-link > a',
    element: postList.querySelector('.post-list__navigation-next-page-link > a'),
    deleteURLParam: function(param) {
      const nextPageURL = new URL( this.element.href );
      nextPageURL.searchParams.delete( param );
      this.element.href = nextPageURL;
    }
  };

  //投稿追加表示ボタン
  var seeMoreButton = {
    selector: '.post-list__see-more-button',
    element: postList.querySelector('.post-list__see-more-button'),
  };

  //投稿リストのステータス要素
  var status = {
    selector: '.post-list__page-load-status',
    element: postList.querySelector('.post-list__page-load-status'),
  };

  //投稿リストのナビゲーション要素
  var navigation = {
    selector: '.post-list__navigation',
    element: postList.querySelector('.post-list__navigation'),
  };
}

let masonry, infiniteScroll;

export default {
  //グリッドレイアウトを実装
  implementGridLayout: () => {
    if ( !postList ) return;

    masonry = new Masonry( postContainer, {
      itemSelector: '.post-item',
      columnWidth: '.post-list__posts-sizer',
      hiddenStyle: {
        transform: 'translateY(50px)',
        opacity: 0,
      },
      percentPosition: true,
      stagger: 20,
      visibleStyle: {
        transform: 'translateY(0)',
        opacity: 1,
      },
    } );
  },

  //Ajaxによる投稿追加表示機能を実装
  implementAjaxPostAddition: () => {
    if ( !postList ) return;

    if ( nextPageLink.element ) {
      //次のページリンク要素のURLパラメータ「load_count」を削除
      nextPageLink.deleteURLParam('load_count');

      const loadCountParam = {
        start: Number( new URL( location.href ).searchParams.get('load_count') ),
        countUp: function( path, loadCount ) {
          const url = new URL( path );
          url.searchParams.set( 'load_count', this.start + loadCount );
          history.replaceState( null, '', url );
        },
      };

      infiniteScroll = new InfiniteScroll( postContainer, {
        outlayer: masonry,
        path: nextPageLink.selector,
        append: '.post-item',
        button: seeMoreButton.selector,
        scrollThreshold: false,
        status: status.selector,
        hideNav: navigation.selector,
        history: false,
      } );

      //ロード完了後にトリガーするイベント
      infiniteScroll.on( 'load', function( document, path ) {
        loadCountParam.countUp( path, this.loadCount );
      } );

    } else {
      seeMoreButton.element.style.display = 'none';
      status.element.style.display = 'block';
      document.querySelector( status.selector + ' > .infinite-scroll-request' ).style.display = 'none';
      document.querySelector( status.selector + ' > .infinite-scroll-error' ).style.display = 'none';
      if ( navigation.element ) navigation.element.style.display = 'none';
    }
  },
}