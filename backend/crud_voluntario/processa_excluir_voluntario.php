<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_voluntario = $_POST['id_voluntario'] ?? null;
    $login = trim($_POST['login'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (!$id_voluntario || empty($login) || empty($senha)) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_voluntarios.php?erro=campos_obrigatorios');
        exit;
    }

    // Verifica o login e senha do administrador
    $query = "SELECT senha FROM admins WHERE login = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_voluntarios.php?erro=login_invalido');
        exit;
    }

    $admin = $resultado->fetch_assoc();
    if (!password_verify($senha, $admin['senha'])) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_voluntarios.php?erro=senha_incorreta');
        exit;
    }

    // Exclusão do voluntario
    $deleteQuery = "DELETE FROM voluntarios WHERE id = ?";
    $stmtDelete = $conexao->prepare($deleteQuery);
    $stmtDelete->bind_param("i", $id_voluntario);

    if ($stmtDelete->execute()) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_voluntarios.php?sucesso=excluido');
    } else {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_voluntarios.php?erro=bd');
    }

    $stmtDelete->close();
    $stmt->close();
    $conexao->close();
} else {
    header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_voluntarios.php');
    exit;
}
?>
