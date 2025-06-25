// Seleciona o modal principal e os modais adicionais
const modalPrincipal = document.getElementById("modal");
const modalTelaAcessibilidade = document.getElementById("telaAcessibilidadeModal");
const modalAjudaSuporte = document.getElementById("ajudaSuporteModal");
const modalFeedback = document.getElementById("feedbackModal");

// Botões e elementos de navegação
const botaoTelaAcessibilidade = document.querySelector(".container-opcoes .opcao:nth-child(4)");
const botaoAjudaSuporte = document.querySelector(".container-opcoes .opcao:nth-child(3)");
const botaoFeedback = document.querySelector(".container-opcoes .opcao:nth-child(5)");

// Botões de voltar nos modais
const botaoVoltarTelaAcessibilidade = document.getElementById("voltarTelaAcessibilidade");
const botaoVoltarAjudaSuporte = document.getElementById("voltarAjudaSuporte");
const botaoVoltarFeedback = document.getElementById("voltarFeedbackModal");

// Funções para abrir e fechar os modais
// Abrir modal principal
document.getElementById("abrirModal").addEventListener("click", () => {
    modalPrincipal.style.display = "block";
});

// Fechar modal principal
document.getElementById("fecharModal").addEventListener("click", () => {
    modalPrincipal.style.display = "none";
});

// Abrir o modal de Tela e Acessibilidade
botaoTelaAcessibilidade.addEventListener("click", () => {
    modalPrincipal.style.display = "none"; // Fecha o modal principal
    modalTelaAcessibilidade.style.display = "block"; // Abre o modal de Tela e Acessibilidade
});

// Voltar ao modal principal a partir de Tela e Acessibilidade
botaoVoltarTelaAcessibilidade.addEventListener("click", () => {
    modalTelaAcessibilidade.style.display = "none"; // Fecha o modal de Tela e Acessibilidade
    modalPrincipal.style.display = "block"; // Reabre o modal principal
});

// Abrir o modal de Ajuda e Suporte
botaoAjudaSuporte.addEventListener("click", () => {
    modalPrincipal.style.display = "none"; // Fecha o modal principal
    modalAjudaSuporte.style.display = "block"; // Abre o modal de Ajuda e Suporte
});

// Voltar ao modal principal a partir de Ajuda e Suporte
botaoVoltarAjudaSuporte.addEventListener("click", () => {
    modalAjudaSuporte.style.display = "none"; // Fecha o modal de Ajuda e Suporte
    modalPrincipal.style.display = "block"; // Reabre o modal principal
});

// Abrir o modal de Feedback
botaoFeedback.addEventListener("click", () => {
    modalPrincipal.style.display = "none"; // Fecha o modal principal
    modalFeedback.style.display = "block"; // Abre o modal de Feedback
});

// Voltar ao modal principal a partir de Feedback
botaoVoltarFeedback.addEventListener("click", () => {
    modalFeedback.style.display = "none"; // Fecha o modal de Feedback
    modalPrincipal.style.display = "block"; // Reabre o modal principal
});

// Fechar o modal clicando fora dele
window.addEventListener("click", (e) => {
    if (e.target === modalPrincipal) {
        modalPrincipal.style.display = "none";
    }
    if (e.target === modalTelaAcessibilidade) {
        modalTelaAcessibilidade.style.display = "none";
    }
    if (e.target === modalAjudaSuporte) {
        modalAjudaSuporte.style.display = "none";
    }
    if (e.target === modalFeedback) {
        modalFeedback.style.display = "none"; // Fecha o modal de Feedback ao clicar fora
    }
});

// Habilitar/desabilitar o botão de envio conforme o campo de detalhes
const details1 = document.getElementById('details1');
const send1Button = document.getElementById('send1');
details1.addEventListener('input', () => {
    send1Button.disabled = details1.value.trim() === ''; // Desabilita o botão de envio se não houver texto
});

// Obter o botão
document.getElementById('ver-perfil').addEventListener('click', function(event) {
    event.preventDefault(); // Impede o comportamento padrão do link (navegação automática)
    
    // Redireciona para a página principal
    window.location.href = "09_perfil.html"; // Substitua "index.html" pelo URL desejado
});

document.addEventListener("DOMContentLoaded", function() {
    let dropdowns = document.querySelectorAll(".dropdown > a");

    dropdowns.forEach(dropdown => {
        dropdown.addEventListener("click", function(event) {
            event.preventDefault();
            let submenu = this.nextElementSibling;

            if (submenu.style.display === "block") {
                submenu.style.display = "none";
            } else {
                submenu.style.display = "block";
            }
        });
    });
});
