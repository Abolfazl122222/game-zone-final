(function () {
  const toggler = document.querySelector('.menu-toggle');
  const menu = document.getElementById('mainNavbar');

  if (!toggler || !menu) return;

  toggler.addEventListener('click', function () {
    const expanded = this.getAttribute('aria-expanded') === 'true';
    this.setAttribute('aria-expanded', expanded ? 'false' : 'true');
    menu.classList.toggle('open');
  });
})();
