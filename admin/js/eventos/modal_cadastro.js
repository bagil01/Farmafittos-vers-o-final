document.addEventListener('DOMContentLoaded', () => {
    const botaoAbrir = document.getElementById('abrirModalEvento');
    const modalCadastro = document.getElementById('modalCadastro');
    const botaoFechar = document.getElementById('fecharModalCadastro');

    if (botaoAbrir && modalCadastro && botaoFechar) {
        // Abrir o modal ao clicar no botão '+'
        botaoAbrir.addEventListener('click', () => {
            modalCadastro.style.display = 'flex';
        });

        // Fechar o modal ao clicar no botão de fechar
        botaoFechar.addEventListener('click', () => {
            modalCadastro.style.display = 'none';

            // Limpar campos do formulário
            const form = document.getElementById('formCadastro');
            if (form) form.reset();
        });

        // Fechar o modal se clicar fora da área do formulário (overlay)
        modalCadastro.addEventListener('click', (e) => {
            if (e.target === modalCadastro) {
                modalCadastro.style.display = 'none';
                const form = document.getElementById('formCadastro');
                if (form) form.reset();
            }
        });
    }
});
