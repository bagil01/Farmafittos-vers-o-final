<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_atividade'] ?? null;
    $titulo = trim($_POST['titulo'] ?? '');
    $data = trim($_POST['data'] ?? '');
    $destaque = ($_POST['destaque'] ?? 'nao') === 'sim' ? 'sim' : 'nao';
    $conteudo = trim($_POST['conteudo'] ?? '');

    if (!$id || empty($titulo) || empty($data) || empty($conteudo)) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_atividades.php?erro=campos_obrigatorios');
        exit;
    }

    $sql = "UPDATE atividades SET titulo = ?, data_publicacao = ?, destaque = ?, conteudo = ? WHERE id = ?";

    $stmt = $conexao->prepare($sql);
    if (!$stmt) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_atividades.php?erro=bd_prepare');
        exit;
    }

    $stmt->bind_param("ssssi", $titulo, $data, $destaque, $conteudo, $id);

    if ($stmt->execute()) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_atividades.php?sucesso=editada');
    } else {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_atividades.php?erro=bd_execucao');
    }

    $stmt->close();
    $conexao->close();
}
?>
