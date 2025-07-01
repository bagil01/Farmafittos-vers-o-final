
const senhaCadastro = document.getElementById('senha');
const toggleCadastro = document.getElementById('toggleSenhaCadastro');
const senhaInput = document.getElementById('Confirmar_senha');
const toggleIcon = document.getElementById('toggleConfirmar_senha');

toggleCadastro.addEventListener('click', () => {
    const isSenha = senhaCadastro.type === 'password';
    senhaCadastro.type = isSenha ? 'text' : 'password';
    toggleCadastro.classList.toggle('fa-eye');
    toggleCadastro.classList.toggle('fa-eye-slash');
});

toggleIcon.addEventListener('click', () => {
    const isSenha = senhaInput.type === 'password';
    senhaInput.type = isSenha ? 'text' : 'password';
    toggleIcon.classList.toggle('fa-eye');
    toggleIcon.classList.toggle('fa-eye-slash');
});