// Abre o modal de exclusão e define o ID oculto
function abrirModalExclusao(id) {
  const modal = document.getElementById('modalExcluirReferencia');
  const inputId = document.getElementById('idReferenciaExcluir');

  if (modal && inputId) {
    inputId.value = id;
    modal.style.display = 'flex';

    // Limpa login e senha sempre que abrir
    const login = document.getElementById('loginExcluir');
    const senha = document.getElementById('senhaExcluir');
    if (login) login.value = '';
    if (senha) senha.value = '';
  }
}

// Aguarda carregamento do DOM para configurar eventos de fechar
document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('modalExcluirReferencia');
  const botaoFechar = document.getElementById('fecharModalExcluir');

  if (modal && botaoFechar) {
    // Fecha ao clicar no botão X
    botaoFechar.addEventListener('click', () => {
      modal.style.display = 'none';
    });

    // Fecha ao clicar fora da área do modal
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.style.display = 'none';
      }
    });
  }
});
