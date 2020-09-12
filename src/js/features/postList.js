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
  InfiniteScroll.imagesLoaded = ImagesLoaded;
  const infiniteScroll = new InfiniteScroll( container, {
    outlayer: masonry,
    path: '.post-list__navigation-next-page-link > a',
    append: '.post',
    button: '.post-list__show-more-button',
    scrollThreshold: false,
    hideNav: '.post-list__navigation',
    status: '.post-list__page-load-status',
  } );

}