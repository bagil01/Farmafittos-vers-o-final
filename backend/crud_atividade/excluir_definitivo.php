<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_atividade'] ?? null;

    if (!$id) {
        header('Location: ../../admin/pages/lixeira_atividades.php?erro=id_invalido');
        exit;
    }

    // Excluir definitivamente
    $sql = "DELETE FROM atividades WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header('Location: ../../admin/pages/lixeira_atividades.php?sucesso=apagada');
}
