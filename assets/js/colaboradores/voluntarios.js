
document.addEventListener("DOMContentLoaded", function () {
    const prevBtn = document.getElementById("prev");
    const nextBtn = document.getElementById("next");
    const carousel = document.querySelector('.carousel');
    const wrapper = document.querySelector(".cards-wrapper");
    const cards = document.querySelectorAll(".card-voluntarios");

    let index = 0;
    let isDragging = false;
    let startPos = 0;
    let currentTranslate = 0;
    let prevTranslate = 0;
    let animationID;
    
    const cardWidth = 210; // Largura do cartão + margem
    const visibleCards = 4.5;
    const totalCards = cards.length;

    function updateCarousel() {
        wrapper.style.transition = "transform 0.5s ease-in-out";
        wrapper.style.transform = `translateX(-${index * cardWidth}px)`;
        currentTranslate = -index * cardWidth;
        prevTranslate = currentTranslate;
    }

    nextBtn.addEventListener("click", () => {
        if (index < totalCards - visibleCards) {
            index++;
        } else {
            index = 0; // Volta ao primeiro
        }
        updateCarousel();
    });

    prevBtn.addEventListener("click", () => {
        if (index > 0) {
            index--;
        } else {
            index = totalCards - Math.floor(visibleCards); // Volta para o final (respeitando o número visível)
        }
        updateCarousel();
    });

    // Eventos de toque para mobile
    carousel.addEventListener('touchstart', touchStart);
    carousel.addEventListener('touchmove', touchMove);
    carousel.addEventListener('touchend', touchEnd);

    function touchStart(event) {
        isDragging = true;
        startPos = event.touches[0].clientX;
        animationID = requestAnimationFrame(animation);
        wrapper.style.transition = "none"; // tira a transição enquanto arrasta
    }

    function touchMove(event) {
        if (!isDragging) return;
        const currentPosition = event.touches[0].clientX;
        const diff = currentPosition - startPos;
        currentTranslate = prevTranslate + diff;
        setSliderPosition();
    }

    function touchEnd() {
        isDragging = false;
        cancelAnimationFrame(animationID);

        const movedBy = currentTranslate - prevTranslate;

        if (movedBy < -100) {
            if (index < totalCards - visibleCards) {
                index++;
            } else {
                index = 0;
            }
        } 
        if (movedBy > 100) {
            if (index > 0) {
                index--;
            } else {
                index = totalCards - Math.floor(visibleCards);
            }
        }
        updateCarousel();
    }

    function animation() {
        if (isDragging) {
            setSliderPosition();
            requestAnimationFrame(animation);
        }
    }

    function setSliderPosition() {
        wrapper.style.transform = `translateX(${currentTranslate}px)`;
    }
});

