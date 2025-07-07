const imagens = document.querySelectorAll('.midias img');
const modal = document.getElementById('modal-foto');
const imagemModal = document.getElementById('imagem-modal');
const overlay = document.getElementById('overlay');
const fechar = document.getElementById('fechar');
const anterior = document.getElementById('anterior');
const proximo = document.getElementById('proximo');

let indiceAtual = 0;
const srcs = Array.from(imagens).map(img => img.src);

// Abrir modal
imagens.forEach((img, index) => {
  img.addEventListener('click', () => {
    indiceAtual = index;
    abrirModal();
  });
});

function abrirModal() {
  imagemModal.src = srcs[indiceAtual];
  modal.style.display = 'flex';
  document.body.style.overflow = 'hidden'; // trava scroll da página
  // Tenta entrar em tela cheia
  if (modal.requestFullscreen) {
    modal.requestFullscreen().catch(() => {});
  }
}

// Fechar modal
function fecharModal() {
  modal.style.display = 'none';
  document.body.style.overflow = 'auto';
  // Sai do modo tela cheia
  if (document.fullscreenElement) {
    document.exitFullscreen().catch(() => {});
  }
}

fechar.addEventListener('click', fecharModal);
overlay.addEventListener('click', fecharModal);

// Navegação
anterior.addEventListener('click', () => {
  indiceAtual = (indiceAtual - 1 + srcs.length) % srcs.length;
  imagemModal.src = srcs[indiceAtual];
});

proximo.addEventListener('click', () => {
  indiceAtual = (indiceAtual + 1) % srcs.length;
  imagemModal.src = srcs[indiceAtual];
});

// Teclado: ESC, ← e →
document.addEventListener('keydown', (e) => {
  if (modal.style.display === 'flex') {
    if (e.key === 'Escape') fecharModal();
    if (e.key === 'ArrowLeft') anterior.click();
    if (e.key === 'ArrowRight') proximo.click();
  }
});
