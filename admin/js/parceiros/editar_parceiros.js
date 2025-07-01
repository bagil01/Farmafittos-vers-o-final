function abrirModalEdicao(parceiro) {
    const modal = document.getElementById('modalEditar');
    modal.style.display = 'flex';

    document.getElementById('id_parceiro').value = parceiro.id;
    document.getElementById('nome_editar').value = parceiro.nome;
    document.getElementById('referencia_editar').value = parceiro.referencia;
    document.getElementById('logo_editar').value = '';
}

document.getElementById('fecharModalEditar').addEventListener('click', () => {
    document.getElementById('modalEditar').style.display = 'none';
});
