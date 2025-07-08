document.addEventListener("DOMContentLoaded", () => {
    const carrossel = document.querySelector(".carousel");
    const cards = document.querySelectorAll(".card-parceiros");
    const cardWidth = cards[0].offsetWidth + 16; // inclui espaçamento entre cards
    let rolagemAtiva = true;
    let intervalo;

    function moverCarrossel() {
        if (!rolagemAtiva) return;

        carrossel.style.transition = "transform 0.5s ease-in-out";
        carrossel.style.transform = `translateX(-${cardWidth}px)`;
    }

    function iniciarRolagem() {
        intervalo = setInterval(moverCarrossel, 2000);
    }

    function pausarRolagem() {
        rolagemAtiva = false;
        clearInterval(intervalo);
    }

    function retomarRolagem() {
        rolagemAtiva = true;
        iniciarRolagem();
    }

    // Quando a transição termina, reorganiza os cards
    carrossel.addEventListener("transitionend", () => {
        // move o primeiro para o final
        const primeiroCard = carrossel.querySelector(".card-parceiros");
        carrossel.appendChild(primeiroCard);

        // reseta posição e remove transição para não dar pulo
        carrossel.style.transition = "none";
        carrossel.style.transform = "translateX(0)";
        // força reflow para garantir que o navegador aplique o estilo acima
        void carrossel.offsetWidth;

        // reativa a transição para a próxima rolagem
        if (rolagemAtiva) {
            carrossel.style.transition = "transform 0.5s ease-in-out";
        }
    });

    carrossel.addEventListener("mouseenter", pausarRolagem);
    carrossel.addEventListener("mouseleave", retomarRolagem);

    iniciarRolagem();
});
