<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $data = trim($_POST['data'] ?? '');
    $destaque = ($_POST['destaque'] ?? 'nao') === 'sim' ? 'sim' : 'não';
    $conteudo = trim($_POST['conteudo'] ?? '');

    if (empty($titulo) || empty($data) || empty($conteudo)) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_noticias.php?erro=campos_obrigatorios');
        exit;
    }

    $sql = "INSERT INTO noticias (titulo, data_publicacao, destaque, conteudo, deletado) VALUES (?, ?, ?, ?, 0)";
    
    $stmt = $conexao->prepare($sql);
    if (!$stmt) {
        die("Erro na preparação da SQL: " . $conexao->error);
    }

    $stmt->bind_param("ssss", $titulo, $data, $destaque, $conteudo);

    if ($stmt->execute()) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_noticias.php?sucesso=cadastrada');
    } else {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_noticias.php?erro=bd_execucao');
    }

    $stmt->close();
    $conexao->close();
}
?>
