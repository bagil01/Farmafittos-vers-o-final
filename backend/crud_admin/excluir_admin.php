<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idAdmin = $_POST['id_admin'] ?? null;
    $login = $_POST['login'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if (!$idAdmin || empty($login) || empty($senha)) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciar_admin.php?erro=confirmacao_invalida');
        exit;
    }

    // Verificar se login e senha estão corretos
    $sql = "SELECT senha FROM admins WHERE login = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->bind_result($senhaHash);

    if ($stmt->fetch() && password_verify($senha, $senhaHash)) {
        $stmt->close();

        // Agora sim, excluir o admin com ID informado
        $delete = $conexao->prepare("DELETE FROM admins WHERE id = ?");
        $delete->bind_param("i", $idAdmin);
        $delete->execute();

        if ($delete->affected_rows > 0) {
            header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciar_admin.php?sucesso=excluido');
        } else {
            header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciar_admin.php?erro=erro_exclusao');
        }

        $delete->close();
    } else {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciar_admin.php?erro=credenciais_invalidas');
    }

    $conexao->close();
}
?>
