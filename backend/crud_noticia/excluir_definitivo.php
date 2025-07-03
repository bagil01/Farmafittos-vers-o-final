<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_noticia'] ?? null;

    if (!$id) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/lixeira_noticias.php?erro=id_invalido');
        exit;
    }

    // Excluir definitivamente
    $sql = "DELETE FROM noticias WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header('Location: /Farmafittos-vers-o-final/admin/pages/lixeira_noticias.php?sucesso=apagada');
}
