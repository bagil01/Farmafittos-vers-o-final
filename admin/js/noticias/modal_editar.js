function abrirModalEdicao(noticia) {
    const modal = document.getElementById('modalEditar');
    modal.style.display = 'flex';

    document.getElementById('id_noticia').value = noticia.id || '';
    document.getElementById('titulo').value = noticia.titulo || '';
    document.getElementById('data').value = noticia.data_publicacao || '';
    document.getElementById('destaque').value = noticia.destaque || 'nao';
    document.getElementById('conteudo').value = noticia.conteudo || '';
}

document.getElementById('fecharModalEditar').addEventListener('click', () => {
    document.getElementById('modalEditar').style.display = 'none';
});
