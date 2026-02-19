/* lesson.js – Index-based category tab switching */
document.addEventListener('DOMContentLoaded', function () {
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
});
