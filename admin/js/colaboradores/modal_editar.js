function abrirModalEdicao(colaborador) {
  document.getElementById('id_colaborador').value = colaborador.id || '';
  document.getElementById('nome_editar').value = colaborador.nome || '';
  document.getElementById('formacao_editar').value = colaborador.formacao || '';
  document.getElementById('curriculo_lattes_editar').value = colaborador.curriculo_lattes || '';
  document.getElementById('descricao_editar').value = colaborador.descricao || '';
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
