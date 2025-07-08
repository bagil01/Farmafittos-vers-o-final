<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_noticia'] ?? null;

    if (!$id) {
        header('Location: ../../admin/pages/lixeira_noticias.php?erro=id_invalido');
        exit;
    }

    $sql = "UPDATE noticias SET deletado = 0 WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header('Location: ../../admin/pages/lixeira_noticias.php?sucesso=restaurada');
}
