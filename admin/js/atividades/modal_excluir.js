function abrirModalExclusao(idAtividade) {
  const modal = document.getElementById('modalExcluirAtividade');
  const inputId = document.getElementById('idAtividadeExcluir');

  if (modal && inputId) {
    inputId.value = idAtividade;
    modal.style.display = 'flex';
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const fechar = document.getElementById('fecharModalExcluir');
  const modal = document.getElementById('modalExcluirAtividade');

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
