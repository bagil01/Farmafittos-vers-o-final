
  const toggle = document.getElementById('menuToggle');
  const menu = document.getElementById('menuMobile');

  toggle.addEventListener('click', () => {
    toggle.classList.toggle('active');
    menu.classList.toggle('show');
  });

