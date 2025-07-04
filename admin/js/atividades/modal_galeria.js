
function abrirModalGaleria(idAtividade) {
    const modal = document.getElementById('modalGaleriaImagens');
    const galeria = document.getElementById('conteudoGaleria');

    galeria.innerHTML = '<p>Carregando imagens...</p>';

    fetch(`/Farmafittos-vers-o-final/backend/crud_atividade/listar_imagens.php?id_atividade=${idAtividade}`)
        .then(response => response.text())
        .then(data => {
            galeria.innerHTML = data;
            modal.style.display = 'flex';
        })
        .catch(error => {
            galeria.innerHTML = '<p>Erro ao carregar imagens.</p>';
            console.error(error);
        });
}

document.getElementById('fecharModalGaleria').addEventListener('click', () => {
    document.getElementById('modalGaleriaImagens').style.display = 'none';
});

document.getElementById('modalGaleriaImagens').addEventListener('click', (e) => {
    if (e.target.id === 'modalGaleriaImagens') {
        e.target.style.display = 'none';
    }
});

