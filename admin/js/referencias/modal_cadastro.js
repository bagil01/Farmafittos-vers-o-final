document.addEventListener('DOMContentLoaded', () => {
    const botaoAbrir = document.getElementById('abrirModalNoticia'); // Botão "＋ Adicionar Referência"
    const modalCadastro = document.getElementById('modalCadastro');  // Modal de Cadastro
    const botaoFechar = document.getElementById('fecharModalCadastro'); // Botão X de fechar

    if (botaoAbrir && modalCadastro && botaoFechar) {
        // Abrir o modal
        botaoAbrir.addEventListener('click', () => {
            modalCadastro.style.display = 'flex';
        });

        // Fechar o modal ao clicar no botão X
        botaoFechar.addEventListener('click', () => {
            modalCadastro.style.display = 'none';
            const form = document.getElementById('formCadastro');
            if (form) form.reset();
        });

        // Fechar clicando fora da caixa do modal
        modalCadastro.addEventListener('click', (e) => {
            if (e.target === modalCadastro) {
                modalCadastro.style.display = 'none';
                const form = document.getElementById('formCadastro');
                if (form) form.reset();
            }
        });
    }
});
