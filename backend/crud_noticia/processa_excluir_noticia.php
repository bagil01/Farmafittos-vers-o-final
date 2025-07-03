<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_noticia = $_POST['id_noticia'] ?? null;
    $login = trim($_POST['login'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (!$id_noticia || empty($login) || empty($senha)) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_noticias.php?erro=campos_obrigatorios');
        exit;
    }

    // Verifica o login e senha do administrador
    $query = "SELECT senha FROM admins WHERE login = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_noticias.php?erro=login_invalido');
        exit;
    }

    $admin = $resultado->fetch_assoc();
    if (!password_verify($senha, $admin['senha'])) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_noticias.php?erro=senha_incorreta');
        exit;
    }

    // Soft delete: marca a notícia como "deletada"
    $deleteQuery = "UPDATE noticias SET deletado = 1 WHERE id = ?";
    $stmtDelete = $conexao->prepare($deleteQuery);
    $stmtDelete->bind_param("i", $id_noticia);

    if ($stmtDelete->execute()) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_noticias.php?sucesso=excluida');
    } else {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_noticias.php?erro=bd');
    }

    $stmtDelete->close();
    $stmt->close();
    $conexao->close();
} else {
    header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_noticias.php');
    exit;
}
?>
