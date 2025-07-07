function abrirModalEdicao(referencia) {
    const modal = document.getElementById('modalEditar');
    modal.style.display = 'flex';

    document.getElementById('id_referencia').value = referencia.id || '';
    document.getElementById('titulo_editar').value = referencia.titulo || '';
    document.getElementById('referencia_editar').value = referencia.referencia || '';
    document.getElementById('descricao_editar').value = referencia.descricao || '';
    document.getElementById('logo_editar').value = ''; // limpa campo de logo (opcional)
}

// Fechar ao clicar no X
document.getElementById('fecharModalEditar').addEventListener('click', () => {
    const modal = document.getElementById('modalEditar');
    modal.style.display = 'none';

    // Opcional: limpar o formulário
    const form = document.getElementById('formEdicao');
    if (form) form.reset();
});

// Fechar clicando fora do modal
document.getElementById('modalEditar').addEventListener('click', (e) => {
    if (e.target.id === 'modalEditar') {
        document.getElementById('modalEditar').style.display = 'none';
        const form = document.getElementById('formEdicao');
        if (form) form.reset();
    }
});
