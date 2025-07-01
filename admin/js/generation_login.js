const nomeInput = document.getElementById('nome');
const loginInput = document.getElementById('login');

nomeInput.addEventListener('input', () => {
    const nome = nomeInput.value.trim().split(" ")[0];
    if (nome.length > 0) {
        loginInput.value = nome.toLowerCase() + "@Farma.fittos";
    } else {
        loginInput.value = "";
    }
});
