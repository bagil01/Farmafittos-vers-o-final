<?php
require_once(__DIR__ . '/../includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_parceiro = $_POST['id_parceiro'] ?? null;
    $login = trim($_POST['login'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (!$id_parceiro || empty($login) || empty($senha)) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_parceiros.php?erro=campos_obrigatorios');
        exit;
    }

    // Verifica o login e senha do administrador
    $query = "SELECT senha FROM admins WHERE login = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_parceiros.php?erro=login_invalido');
        exit;
    }

    $admin = $resultado->fetch_assoc();
    if (!password_verify($senha, $admin['senha'])) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_parceiros.php?erro=senha_incorreta');
        exit;
    }

    // Exclusão do parceiro
    $deleteQuery = "DELETE FROM parceiros WHERE id = ?";
    $stmtDelete = $conexao->prepare($deleteQuery);
    $stmtDelete->bind_param("i", $id_parceiro);

    if ($stmtDelete->execute()) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_parceiros.php?sucesso=excluido');
    } else {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_parceiros.php?erro=bd');
    }

    $stmtDelete->close();
    $stmt->close();
    $conexao->close();
} else {
    header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_parceiros.php');
    exit;
}
?>
