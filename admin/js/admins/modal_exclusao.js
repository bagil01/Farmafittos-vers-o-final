function abrirModalExclusao(id) {
  document.getElementById('idAdminExcluir').value = id;
  document.getElementById('modalConfirmarExclusao').style.display = 'flex';
}

function fecharModalExclusao() {
  document.getElementById('modalConfirmarExclusao').style.display = 'none';
}