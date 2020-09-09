//ヒーローヘッダーの高さをビューポートの高さに設定
export default () => {
  const heroHeader = document.getElementById('heroHeader');
  if (!heroHeader) return;

  heroHeader.style.height = window.innerHeight + 'px';
}