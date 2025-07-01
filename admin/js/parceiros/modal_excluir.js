function abrirModalExclusao(idParceiro) {
  const modal = document.getElementById('modalExcluirParceiro');
  const inputId = document.getElementById('idParceiroExcluir');

  if (modal && inputId) {
    inputId.value = idParceiro;
    modal.style.display = 'flex';
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const fechar = document.getElementById('fecharModalExcluir');
  const modal = document.getElementById('modalExcluirParceiro');

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
