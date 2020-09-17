//ヒーローヘッダーの高さをビューポートの高さに設定
export default () => {
  const heroHeader = document.getElementById('heroHeader');
  if (!heroHeader) return;

  const header = document.getElementById('header');

  heroHeader.style.height = window.innerHeight - header.offsetHeight + 'px';
}