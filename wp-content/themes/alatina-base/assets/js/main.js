document.addEventListener('DOMContentLoaded', function () {
  var primaryMenu = document.getElementById('primary-menu');

  if (primaryMenu) {
    var desktopMedia = window.matchMedia('(min-width: 1200px)');

    var closeSiblingDropdowns = function (activeItem) {
      primaryMenu.querySelectorAll('.menu-item-has-children.is-open').forEach(function (item) {
        if (item !== activeItem) {
          item.classList.remove('is-open');
          var itemLink = item.querySelector(':scope > a');
          var itemToggle = item.querySelector(':scope > .menu-dropdown-toggle');
          if (itemLink) itemLink.setAttribute('aria-expanded', 'false');
          if (itemToggle) itemToggle.setAttribute('aria-expanded', 'false');
        }
      });
    };

    primaryMenu.querySelectorAll('.menu-item-has-children').forEach(function (item) {
      item.classList.add('dropdown');
      var link = item.querySelector(':scope > a');
      var submenu = item.querySelector(':scope > .sub-menu');
      var toggle = item.querySelector(':scope > .menu-dropdown-toggle');

      if (link && submenu) {
        link.classList.add('nav-link');
        link.setAttribute('aria-haspopup', 'true');
        link.setAttribute('aria-expanded', item.classList.contains('is-open') ? 'true' : 'false');
        submenu.classList.add('dropdown-menu');
        submenu.querySelectorAll('a').forEach(function (subLink) {
          subLink.classList.add('dropdown-item');
        });

        item.addEventListener('mouseenter', function () {
          if (!desktopMedia.matches) return;
          closeSiblingDropdowns(item);
          item.classList.add('is-open');
          link.setAttribute('aria-expanded', 'true');
          if (toggle) toggle.setAttribute('aria-expanded', 'true');
        });

        item.addEventListener('mouseleave', function () {
          if (!desktopMedia.matches) return;
          item.classList.remove('is-open');
          link.setAttribute('aria-expanded', 'false');
          if (toggle) toggle.setAttribute('aria-expanded', 'false');
        });
      }

      if (toggle && link && submenu) {
        toggle.setAttribute('aria-haspopup', 'true');
        toggle.setAttribute('aria-expanded', 'false');

        toggle.addEventListener('click', function (event) {
          event.preventDefault();
          event.stopPropagation();
          var willOpen = !item.classList.contains('is-open');
          closeSiblingDropdowns(item);
          item.classList.toggle('is-open', willOpen);
          link.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
          toggle.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
        });
      }
    });

    primaryMenu.querySelectorAll(':scope > .menu-item > a').forEach(function (link) {
      if (!link.classList.contains('nav-link')) {
        link.classList.add('nav-link');
      }
    });

    document.addEventListener('click', function (event) {
      if (!primaryMenu.contains(event.target)) {
        closeSiblingDropdowns(null);
      }
    });

    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') {
        closeSiblingDropdowns(null);
      }
    });
  }

  var carousel = document.getElementById('featuredEventsCarousel');
  if (carousel && window.bootstrap && window.bootstrap.Carousel) {
    new window.bootstrap.Carousel(carousel, {
      interval: 5500,
      ride: 'carousel',
      pause: 'hover'
    });
  }

  var heroCarousel = document.getElementById('heroVisualCarousel');
  if (heroCarousel && window.bootstrap && window.bootstrap.Carousel) {
    new window.bootstrap.Carousel(heroCarousel, {
      interval: 4600,
      ride: 'carousel',
      pause: false,
      touch: true,
      wrap: true
    });
  }
});
