<?php
session_start();
require_once(__DIR__ . '/../includes/conexao.php');

$erro = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if (empty($login) || empty($senha)) {
        $erro = "Preencha todos os campos.";
    } else {
        $stmt = $conexao->prepare("SELECT id, nome, senha FROM admins WHERE login = ?");
        $stmt->bind_param('s', $login);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $admin = $resultado->fetch_assoc();
            if (password_verify($senha, $admin['senha'])) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_nome'] = $admin['nome'];
                header("Location: ../admin/pages/gerenciador.php");
                exit();
            } else {
                $erro = "Senha incorreta.";
            }
        } else {
            $erro = "Usuário não encontrado.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin</title>
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <div class="login-container">
        <h2>Login Administrativo</h2>
        <?php if ($erro): ?>
            <p class="erro"><?= htmlspecialchars($erro) ?></p>
        <?php endif; ?>
        <form class="formulario" method="POST">
            <div class="login">
                <label for="login">Login:</label>
                <input type="text" name="login" id="login" placeholder="Login" required>
            </div>

            <div class="senha">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" placeholder="Senha" required>
            </div>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>

</html>