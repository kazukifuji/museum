import Masonry from 'masonry-layout';
import InfiniteScroll from 'infinite-scroll';
import ImagesLoaded from 'imagesloaded';

//投稿リストの機能を設定
export default () => {
  //グリッドレイアウト化
  const postList = document.getElementById('postList');
  if (!postList) return;

  const container = postList.querySelector('.post-list__posts');

  const masonry = new Masonry( container, {
    itemSelector: '.post',
    columnWidth: '.post-list__posts-sizer',
    percentPosition: true,
  } );

  //show-more-button要素にクリック時、投稿追加表示の機能を設定
  const nextPageLinkElemSelector = '.post-list__navigation-next-page-link > a';
  const showMoreButtonElemSelector = '.post-list__show-more-button';
  const postListStatusElemSelector = '.post-list__page-load-status';
  const postListNavElemSelector = '.post-list__navigation';
  
  const nextPageLinkElem = document.querySelector(nextPageLinkElemSelector);
  if ( nextPageLinkElem !== null ) {
    InfiniteScroll.imagesLoaded = ImagesLoaded;

    const nextPageURL = new URL( nextPageLinkElem.href );
    nextPageURL.searchParams.delete('load_count');
    nextPageLinkElem.href = nextPageURL.href;
    
    const infiniteScroll = new InfiniteScroll( container, {
      outlayer: masonry,
      path: nextPageLinkElemSelector,
      append: '.post',
      button: showMoreButtonElemSelector,
      scrollThreshold: false,
      status: postListStatusElemSelector,
      hideNav: postListNavElemSelector,
      history: false,
    } );

    let url = new URL( location.href );
    const startLoadCount = Number( url.searchParams.get('load_count') );
    infiniteScroll.on( 'load', function( document, path ) {
      url = new URL( path );
      url.searchParams.set( 'load_count', startLoadCount + this.loadCount );
      history.replaceState(null, '', url);
    } );

  } else {
    document.querySelector(showMoreButtonElemSelector).style.display = 'none';
    document.querySelector( postListStatusElemSelector ).style.display = 'block';
    document.querySelector( postListStatusElemSelector + ' > .infinite-scroll-request' ).style.display = 'none';
    document.querySelector( postListStatusElemSelector + ' > .infinite-scroll-error' ).style.display = 'none';
    document.querySelector( postListNavElemSelector ).style.display = 'none';
  }

}