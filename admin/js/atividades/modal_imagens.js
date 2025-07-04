function abrirModalImagens(idAtividade) {
  const modal = document.getElementById('modalImagens');
  const inputId = document.getElementById('idAtividadeImagens');

  if (modal && inputId) {
    inputId.value = idAtividade;
    modal.style.display = 'flex';
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const fechar = document.getElementById('fecharModalImagens');
  const modal = document.getElementById('modalImagens');

  if (fechar && modal) {
    fechar.addEventListener('click', () => {
      modal.style.display = 'none';
    });

    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.style.display = 'none';
      }
    });
  }
});
