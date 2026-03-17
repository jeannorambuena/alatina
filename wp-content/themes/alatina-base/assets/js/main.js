document.addEventListener('DOMContentLoaded', function () {
  var toggle = document.querySelector('[data-nav-toggle]');
  var navigation = document.getElementById('site-navigation');

  if (!toggle || !navigation) {
    return;
  }

  toggle.addEventListener('click', function () {
    var isOpen = navigation.classList.toggle('is-open');
    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
  });
});
