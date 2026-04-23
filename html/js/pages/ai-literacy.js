document.addEventListener('DOMContentLoaded', function () {
  var tabs  = document.querySelectorAll('.level-tab');
  var cards = document.querySelectorAll('.ai-card');

  tabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      tabs.forEach(function (t) { t.classList.remove('active'); });
      tab.classList.add('active');

      var level = tab.dataset.level;

      cards.forEach(function (card) {
        if (level === 'all' || card.dataset.level === level) {
          card.classList.remove('hidden');
        } else {
          card.classList.add('hidden');
        }
      });
    });
  });
});
