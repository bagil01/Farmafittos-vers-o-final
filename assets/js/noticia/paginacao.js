        const botoes = document.querySelectorAll(".pagina-btn");
        const paginas = document.querySelectorAll(".pagina");

        botoes.forEach(botao => {
            botao.addEventListener("click", () => {
                const paginaSelecionada = botao.getAttribute("data-pagina");

                // Esconde todas as páginas
                paginas.forEach(p => p.style.display = "none");

                // Mostra a página selecionada
                document.querySelector(".pagina-" + paginaSelecionada).style.display = "block";

                // Remove classe 'ativo' de todos os botões
                botoes.forEach(btn => btn.classList.remove("ativo"));

                // Adiciona classe 'ativo' no botão clicado
                botao.classList.add("ativo");
            });
        });