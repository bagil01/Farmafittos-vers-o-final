function abrirModalEdicao(voluntario) {
  const modal = document.getElementById('modalEditar');

  if (!modal) return;

  // Preenche os campos do modal com os dados do voluntário
  document.getElementById('id_voluntario').value = voluntario.id || '';
  document.getElementById('nome_editar').value = voluntario.nome || '';
  document.getElementById('curso_editar').value = voluntario.curso || '';
  document.getElementById('curriculo_lattes_editar').value = voluntario.curriculo_lattes || '';

  // Mostra o modal
  modal.style.display = 'flex';
}

document.addEventListener('DOMContentLoaded', () => {
  const fecharModal = document.getElementById('fecharModalEditar');
  const modal = document.getElementById('modalEditar');

  if (fecharModal && modal) {
    fecharModal.addEventListener('click', () => {
      modal.style.display = 'none';
    });

    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.style.display = 'none';
      }
    });
  }
});
