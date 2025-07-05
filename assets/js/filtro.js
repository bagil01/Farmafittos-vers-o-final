function openModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.style.display = "block";

        // Foca automaticamente no input se existir
        const input = modal.querySelector('input[type="text"], input[type="search"]');
        if (input) {
            input.focus();
        }
    }
}

function closeModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.style.display = "none";
    }
}

// Fecha o modal se clicar fora do conteúdo
window.onclick = function (event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = "none";
    }
};

// Fecha o modal ao pressionar ESC
document.addEventListener('keydown', function (event) {
    if (event.key === "Escape") {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.style.display = "none";
        });
    }
});

// Envia o formulário de pesquisa ao pressionar Enter dentro do input
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('#modalSearch input[type="text"], #modalSearch input[type="search"]');
    if (searchInput) {
        searchInput.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                const form = this.closest('form');
                if (form) {
                    form.submit();
                } else {
                    // Alternativa: redirecionar manualmente com GET
                    const query = this.value.trim();
                    if (query) {
                        window.location.href = `prev_noticias.php?busca=${encodeURIComponent(query)}`;
                    }
                }
            }
        });
    }
});
