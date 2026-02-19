/* index.js – Homepage interactions */
document.addEventListener('DOMContentLoaded', function () {

  // Lesson 카테고리 탭 전환
  var buttons = document.querySelectorAll('.lesson-sidebar__item');
  var panels  = document.querySelectorAll('.lesson-panel');

  buttons.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var idx = btn.dataset.index;

      buttons.forEach(function (b) { b.classList.remove('is-active'); });
      panels.forEach(function (p) { p.classList.remove('is-active'); });

      btn.classList.add('is-active');
      var target = document.querySelector('.lesson-panel[data-panel="' + idx + '"]');
      if (target) target.classList.add('is-active');
    });
  });

  // Portfolio Swiper (슬라이더 요소가 있을 때만)
  var swiperEl = document.querySelector('.portfolio-grid.swiper');
  if (swiperEl) {
    new Swiper(swiperEl, {
      slidesPerView: 1,
      spaceBetween: 24,
      loop: true,
      autoplay: { delay: 4000, disableOnInteraction: false },
      pagination: { el: '.swiper-pagination', clickable: true },
      breakpoints: {
        768:  { slidesPerView: 2 },
        1200: { slidesPerView: 3 }
      }
    });
  }

});
