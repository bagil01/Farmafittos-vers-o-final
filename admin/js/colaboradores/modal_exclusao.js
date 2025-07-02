function abrirModalExclusao(idColaborador) {
const modal = document.getElementById('modalExcluirColaborador');
const inputId = document.getElementById('idColaboradorExcluir');

  if (modal && inputId) {
    inputId.value = idColaborador;
    modal.style.display = 'flex';
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const fechar = document.getElementById('fecharModalExcluir');
  const modal = document.getElementById('modalExcluirColaborador');

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
