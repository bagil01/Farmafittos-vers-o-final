function abrirModalEdicao(admin) {
    console.log(admin);

    // Abre o modal correto
    document.getElementById('modalEditarCadastro').style.display = 'flex';

    // Preenche os campos do modal de edição
    document.getElementById('idAdmin').value = admin.id || '';
    document.getElementById('nomeEdicao').value = admin.nome || '';
    document.getElementById('loginEdicao').value = admin.login || '';

    // Limpa senhas e foto
    document.getElementById('senhaEdicao').value = '';
    document.getElementById('ConfirmarSenhaEdicao').value = '';
    document.getElementById('fotoEdicao').value = '';
}

// Fecha modal de edição
function fecharModalEdicao() {
    document.getElementById('modalEditarCadastro').style.display = 'none';
}