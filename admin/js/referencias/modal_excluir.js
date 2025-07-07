// Abrir modal de exclusão e preencher o ID
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

// Abrir modal de edição e preencher campos
function abrirModalEdicao(referencia) {
  const modal = document.getElementById('modalEditar');
  if (!modal) return;

  document.getElementById('id_referencia').value = referencia.id;
  document.getElementById('titulo_editar').value = referencia.titulo;
  document.getElementById('referencia_editar').value = referencia.referencia;
  document.getElementById('descricao_editar').value = referencia.descricao ?? '';

  modal.style.display = 'flex';
}

// Aguarda o DOM carregar
document.addEventListener('DOMContentLoaded', () => {
  // Exclusão
  const modalExcluir = document.getElementById('modalExcluirReferencia');
  const fecharExcluir = document.getElementById('fecharModalExcluir');
  if (modalExcluir && fecharExcluir) {
    fecharExcluir.addEventListener('click', () => {
      modalExcluir.style.display = 'none';
    });

    modalExcluir.addEventListener('click', (e) => {
      if (e.target === modalExcluir) {
        modalExcluir.style.display = 'none';
      }
    });
  }

  // Edição
  const modalEditar = document.getElementById('modalEditar');
  const fecharEditar = document.getElementById('fecharModalEditar');
  if (modalEditar && fecharEditar) {
    fecharEditar.addEventListener('click', () => {
      modalEditar.style.display = 'none';
    });

    modalEditar.addEventListener('click', (e) => {
      if (e.target === modalEditar) {
        modalEditar.style.display = 'none';
      }
    });
  }

  // Cadastro
  const modalCadastro = document.getElementById('modalCadastro');
  const fecharCadastro = document.getElementById('fecharModalCadastro');
  if (modalCadastro && fecharCadastro) {
    fecharCadastro.addEventListener('click', () => {
      modalCadastro.style.display = 'none';
    });

    modalCadastro.addEventListener('click', (e) => {
      if (e.target === modalCadastro) {
        modalCadastro.style.display = 'none';
      }
    });
  }
});
