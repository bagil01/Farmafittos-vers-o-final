function abrirModalExclusao(idEvento) {
  const modal = document.getElementById('modalExcluirEvento');
  const inputId = document.getElementById('idEventoExcluir');

  if (modal && inputId) {
    inputId.value = idEvento;
    modal.style.display = 'flex';
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const fechar = document.getElementById('fecharModalExcluir');
  const modal = document.getElementById('modalExcluirEvento');

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
