<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador</title>
    <link rel="stylesheet" href="/Farmafittos-vers-o-final/assets/icons/fontawesome-free-6.5.2-web/css/all.css">
    <link rel="stylesheet" href="/Farmafittos-vers-o-final/admin/css/gerenciador.css">
</head>

<body>
    <div class="voltar">
        <a href="/Farmafittos-vers-o-final/admin/">
            <i class="fa-solid fa-circle-arrow-left"></i> VOLTAR
        </a>
    </div>

    <div class="container">
        <div class="container-controle">
            <div class="adicionar-noticia" id="abrirModalNoticia">
                <span>＋</span>
                <p>Adicionar Administrador</p>
            </div>

            <div class="lixeira">
                <i class="fa-solid fa-trash"></i>
                <h2>Lixeira</h2>
            </div>
        </div>

        <div class="container-gerenciador">
            <h1>Gerenciador de Administradores</h1>

            <?php
            require_once('../../includes/conexao.php');
            $query = "SELECT * FROM admins";
            $resultado = $conexao->query($query);
            while ($admin = $resultado->fetch_assoc()) {
                $foto = !empty($admin['foto']) ? '/Farmafittos-vers-o-final/' . htmlspecialchars($admin['foto']) : '/Farmafittos-vers-o-final/assets/photos/user-default.jpg';

                echo '<div class="opcao">';
                echo '<div style="display: flex; align-items: center; gap: 10px;">';
                echo '<img src="' . $foto . '" alt="Foto" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">';
                echo '<div>';
                echo '<h2 style="margin: 0;">' . htmlspecialchars($admin['nome']) . '</h2>';
                echo '<p style="margin: 0; font-size: 0.9em; color: #555;">' . htmlspecialchars($admin['login']) . '</p>';
                echo '</div>';
                echo '</div>';
                echo '<div class="incons">';
                echo '<a href="/Farmafittos-vers-o-final/backend/editar_admin.php?id=' . $admin['id'] . '" title="Editar">';
                echo '<i class="fa-solid fa-pen-to-square"></i>';
                echo '</a>';
                echo '<a href="/Farmafittos-vers-o-final/backend/excluir_admin.php?id=' . $admin['id'] . '" onclick="return confirm(\'Tem certeza que deseja excluir este administrador?\');" title="Excluir">';
                echo '<i class="fa-solid fa-trash"></i>';
                echo '</a>';
                echo '</div>';
                echo '</div>';


            }
            ?>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal-overlay" id="modalCadastro">
        <div class="modal">
            <span class="fechar-modal" id="fecharModal">&times;</span>
            <h2>Cadastrar Novo Administrador</h2>

            <form id="formCadastro" action="/Farmafittos-vers-o-final/backend/processa_admin.php" method="POST"
                enctype="multipart/form-data">
                <label for="Nome">Nome:</label>
                <input type="text" id="nome" name="Nome" required>

                <label for="login">Login gerado:</label>
                <input type="text" id="login" name="Login" readonly style="background-color: #e9ecef;">

                <label for="Senha">Senha</label>
                <input type="password" name="Senha" id="senha" required>

                <label for="Confirmar_senha">Confirmar senha</label>
                <input type="password" name="Confirmar_senha" id="confirmar_senha" required>

                <label for="foto">Adicionar foto</label>
                <input type="file" name="foto" id="foto">

                <button type="submit" class="botao-salvar">Salvar</button>
            </form>
        </div>
    </div>

    <script src="/Farmafittos-vers-o-final/admin/js/gerenciador.js"></script>
    <script>
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
    </script>

    <?php if (isset($_GET['erro']) && $_GET['erro'] === 'senha_fraca'): ?>
        <div
            style="background-color: #ffdddd; color: #a94442; border: 1px solid #a94442; padding: 10px; margin: 15px; border-radius: 5px;">
            ⚠️ A senha deve ter entre <strong>6 e 10 caracteres</strong>, conter <strong>letras</strong>,
            <strong>números</strong> e pelo menos <strong>um caractere especial</strong>.
        </div>
    <?php endif; ?>

</body>

</html>