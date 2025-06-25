const leafContainer = document.querySelector('.leaf-background');
const greenDark = '#008000';     // Verde escuro
const greenLight = '#7CFC00';    // Verde claro vibrante


// Função que cria e solta folhas infinitamente
function createLeaf() {
  const leaf = document.createElement('i');
  leaf.classList.add('fa-solid', 'fa-leaf', 'leaf');

  const size = Math.random() * 20 + 10;
  leaf.style.setProperty('--size', `${size}px`);
  leaf.style.left = `${Math.random() * 100}%`;
  leaf.style.animationDuration = `${Math.random() * 5 + 5}s`; // duração da queda
  leaf.style.opacity = Math.random();
  leafContainer.appendChild(leaf);

  // Remove a folha após a animação e cria outra
  leaf.addEventListener('animationend', () => {
    leaf.remove();
    createLeaf(); // cria uma nova folha após a anterior sair
  });
}

// Cria várias folhas iniciais
for (let i = 0; i < 60; i++) {
  setTimeout(createLeaf, i * 200); // espaça a criação para efeito contínuo
}

// Círculo invisível e detecção de folhas
const circle = document.createElement('div');
circle.classList.add('mouse-circle');
document.body.appendChild(circle);

document.querySelector('.painel').addEventListener('mousemove', (e) => {
  circle.style.left = `${e.pageX}px`;
  circle.style.top = `${e.pageY}px`;

  document.querySelectorAll('.leaf').forEach((leaf) => {
    const rect = leaf.getBoundingClientRect();
    const dx = e.clientX - rect.left;
    const dy = e.clientY - rect.top;
    const distance = Math.sqrt(dx * dx + dy * dy);
    leaf.style.color = distance < 100 ? greenLight : greenDark;
  });
});