document.addEventListener('DOMContentLoaded', () => {
  const toggles = document.querySelectorAll('.toggle-password');

  toggles.forEach(toggle => {
    toggle.addEventListener('click', () => {
      const inputId = toggle.getAttribute('data-target');
      const input = document.getElementById(inputId);

      if (input) {
        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';

        toggle.classList.toggle('fa-eye');
        toggle.classList.toggle('fa-eye-slash');
      }
    });
  });
});
    