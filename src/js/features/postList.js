import Masonry from 'masonry-layout';

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
}