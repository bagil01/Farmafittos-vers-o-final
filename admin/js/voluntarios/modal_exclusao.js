function abrirModalExclusao(idVoluntario) {
  const modal = document.getElementById('modalExcluirVoluntario');
  const inputId = document.getElementById('id_voluntario_excluir');

  if (modal && inputId) {
    inputId.value = idVoluntario;
    modal.style.display = 'flex';
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const fechar = document.getElementById('fecharModalExcluir');
  const modal = document.getElementById('modalExcluirVoluntario');

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
