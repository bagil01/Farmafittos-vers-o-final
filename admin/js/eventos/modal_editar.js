function abrirModalEdicao(evento) {
    const modal = document.getElementById('modalEditar');
    if (!modal) return;

    modal.style.display = 'flex';

    // Preenche os campos do formulário com os dados do evento
    document.getElementById('id_evento').value = evento.id || '';
    document.getElementById('titulo_editar').value = evento.titulo || '';
    document.getElementById('formulario_editar').value = evento.formulario_inscricao || '';
    document.getElementById('ingresso_editar').value = evento.ingresso || '';
    document.getElementById('data_evento_editar').value = evento.data_evento?.slice(0, 10) || ''; // yyyy-mm-dd
    document.getElementById('hora_editar').value = evento.hora || '';
    document.getElementById('descricao_editar').value = evento.descricao || '';
    document.getElementById('instagram_editar').value = evento.instagram || '';
    document.getElementById('whatsapp_editar').value = evento.whatsapp || '';
    document.getElementById('localizacao_editar').value = evento.localizacao || '';
    document.getElementById('link_maps_editar').value = evento.link_maps || '';

    // Limpa o campo de upload de capa (não preenchido automaticamente)
    document.getElementById('capa_editar').value = '';
}

// Fecha o modal ao clicar no "X"
document.getElementById('fecharModalEditar')?.addEventListener('click', () => {
    document.getElementById('modalEditar').style.display = 'none';
});

// Fecha o modal ao clicar fora dele
document.getElementById('modalEditar')?.addEventListener('click', (e) => {
    if (e.target.id === 'modalEditar') {
        document.getElementById('modalEditar').style.display = 'none';
    }
});
