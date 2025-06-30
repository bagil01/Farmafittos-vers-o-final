<?php
require_once(__DIR__ . '/../includes/conexao.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Excluir a foto se existir
    $queryFoto = $conexao->prepare("SELECT foto FROM admins WHERE id = ?");
    $queryFoto->bind_param("i", $id);
    $queryFoto->execute();
    $result = $queryFoto->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && !empty($admin['foto']) && file_exists(__DIR__ . '/../' . $admin['foto'])) {
        unlink(__DIR__ . '/../' . $admin['foto']);
    }

    $query = $conexao->prepare("DELETE FROM admins WHERE id = ?");
    $query->bind_param("i", $id);
    if ($query->execute()) {
        header("Location: /Farmafittos-vers-o-final/admin/pages/gerenciar_admin.php?sucesso=excluido");
    } else {
        header("Location: /Farmafittos-vers-o-final/admin/pages/gerenciar_admin.php?erro=excluir");
    }
}
?>
