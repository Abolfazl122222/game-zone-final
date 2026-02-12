(function () {
  const toggler = document.querySelector('.navbar-toggler');
  const menu = document.querySelector('#mainNavbar');

  if (!toggler || !menu) return;

  const isShown = () => menu.classList.contains('show');

  const setExpanded = (expanded) => {
    toggler.setAttribute('aria-expanded', expanded ? 'true' : 'false');
  };

  toggler.addEventListener('click', function () {
    menu.classList.toggle('show');
    setExpanded(isShown());
  });

  menu.querySelectorAll('.nav-link').forEach((link) => {
    link.addEventListener('click', function () {
      if (window.innerWidth < 992 && isShown()) {
        menu.classList.remove('show');
        setExpanded(false);
      }
    });
  });
})();
