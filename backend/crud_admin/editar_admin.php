<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');


if (!isset($_GET['id'])) {
    echo "ID do administrador não fornecido.";
    exit;
}

$id = intval($_GET['id']);

$query = "SELECT * FROM admins WHERE id = ?";
$stmt = $conexao->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Administrador não encontrado.";
    exit;
}

$admin = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Administrador</title>
    <link rel="stylesheet" href="../admin/css/editar_admin.css">
    <link rel="stylesheet" href="../assets/icons/fontawesome-free-6.5.2-web/css/all.css">
</head>

<body>
    <div class="voltar">
        <a href="../admin//pages/gerenciar_admin.php">
            <i class="fa-solid fa-circle-arrow-left"></i> VOLTAR
        </a>
    </div>
    <div class="container">
        <h1>Editar Administrador</h1>
        <form action="../backend/crud_admin/processa_edicao_admin.php" method="POST"
            enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $admin['id']; ?>">

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="Nome" value="<?php echo htmlspecialchars($admin['nome']); ?>" required>

            <label for="login">Login:</label>
            <input type="text" id="login" name="Login" value="<?php echo htmlspecialchars($admin['login']); ?>"
                readonly>


            <label for="Senha">Senha</label>
            <div style="position: relative;">
                <input type="password" name="Senha" id="senha" required>
                <i class="fa-solid fa-eye toggle-password" data-target="senha"
                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
            </div>

            <label for="Confirmar_senha">Confirmar senha</label>
            <div style="position: relative;">
                <input type="password" id="Confirmar_senha" name="Confirmar_senha" required>
                <i class="fa-solid fa-eye toggle-password" data-target="Confirmar_senha"
                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
            </div>
            <?php
            $foto = !empty($admin['foto']) ? $admin['foto'] : '../../assets/photos/user-default.jpg';
            ?>
            <img src="/<?php echo htmlspecialchars($foto); ?>"
                style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;"><br>


            <label for="foto">Alterar foto:</label>
            <input type="file" name="foto" id="foto">

            <button class="botao-salvar" type="submit">Salvar alterações</button>
        </form>
    </div>

    <script src="../admin/js/view_password.js"></script>

</body>

</html>