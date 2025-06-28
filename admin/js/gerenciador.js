
  const modal = document.getElementById('modalCadastro');
  const abrirBtn = document.getElementById('abrirModalNoticia');
  const fecharBtn = document.getElementById('fecharModal');

  abrirBtn.addEventListener('click', () => {
    modal.style.display = 'flex';
  });

  fecharBtn.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  window.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });

