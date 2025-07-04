function toggleTexto(id) {
    const resumo = document.getElementById(`resumo-${id}`);
    const completo = document.getElementById(`completo-${id}`);
    const botao = event.target;

    if (completo.style.display === 'none') {
        resumo.style.display = 'none';
        completo.style.display = 'block';
        botao.innerText = 'Ver menos';
    } else {
        resumo.style.display = 'block';
        completo.style.display = 'none';
        botao.innerText = 'Ver mais';
    }
}