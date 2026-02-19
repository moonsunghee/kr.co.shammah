/* main.js – GNB interactions */
document.addEventListener('DOMContentLoaded', function () {
  var gnb = document.getElementById('gnb');
  var hamburger = document.getElementById('gnbHamburger');
  var nav = document.getElementById('gnbNav');

  // Hamburger toggle
  if (hamburger && nav) {
    hamburger.addEventListener('click', function () {
      hamburger.classList.toggle('open');
      nav.classList.toggle('open');
    });
  }

  // Scroll – add .scrolled class to GNB
  if (gnb) {
    window.addEventListener('scroll', function () {
      gnb.classList.toggle('scrolled', window.scrollY > 10);
    });
  }

  // Active link highlight based on current path
  var path = window.location.pathname;
  var links = document.querySelectorAll('.gnb__menu a');
  links.forEach(function (link) {
    var href = link.getAttribute('href');
    if (href === path || (href === '/' && (path === '/' || path === '/index.php'))) {
      link.classList.add('active');
    }
  });
});
