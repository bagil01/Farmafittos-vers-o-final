<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_colaborador = $_POST['id_colaborador'] ?? null;
    $login = trim($_POST['login'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (!$id_colaborador || empty($login) || empty($senha)) {
        header('Location: ../../admin/pages/gerenciador_colaboradores.php?erro=campos_obrigatorios');
        exit;
    }

    // Verifica o login e senha do administrador
    $query = "SELECT senha FROM admins WHERE login = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_colaboradores.php?erro=login_invalido');
        exit;
    }

    $admin = $resultado->fetch_assoc();
    if (!password_verify($senha, $admin['senha'])) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_colaboradores.php?erro=senha_incorreta');
        exit;
    }

    // Exclusão do colaborador
    $deleteQuery = "DELETE FROM colaboradores WHERE id = ?";
    $stmtDelete = $conexao->prepare($deleteQuery);
    $stmtDelete->bind_param("i", $id_colaborador);

    if ($stmtDelete->execute()) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_colaboradores.php?sucesso=excluido');
    } else {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_colaboradores.php?erro=bd');
    }

    $stmtDelete->close();
    $stmt->close();
    $conexao->close();
} else {
    header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_colaboradores.php');
    exit;
}
?>
