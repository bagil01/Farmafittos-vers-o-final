function abrirModalEdicaoAtividade(atividade) {
  const modal = document.getElementById('modalEditarAtividade');
  if (!modal) return;

  document.getElementById('id_atividade').value = atividade.id || '';
  document.getElementById('titulo_editar').value = atividade.titulo || '';

  // Converter a data para o formato datetime-local
  const dataFormatada = new Date(atividade.data_publicacao).toISOString().slice(0, 16);
  document.getElementById('data_editar').value = dataFormatada;

  document.getElementById('destaque_editar').value = atividade.destaque || 'nao';
  document.getElementById('conteudo_editar').value = atividade.conteudo || '';

  modal.style.display = 'flex';
}

document.addEventListener('DOMContentLoaded', () => {
  const fecharModal = document.getElementById('fecharModalEditarAtividade');
  const modal = document.getElementById('modalEditarAtividade');

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
