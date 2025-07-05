<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $data = trim($_POST['data'] ?? '');
    $destaque = ($_POST['destaque'] ?? 'nao') === 'sim' ? 'sim' : 'não';
    $conteudo = trim($_POST['conteudo'] ?? '');

    if (empty($titulo) || empty($data) || empty($conteudo)) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_atividades.php?erro=campos_obrigatorios');
        exit;
    }

    // Tratamento da imagem de capa
    $caminhoCapa = null;
    if (isset($_FILES['capa']) && $_FILES['capa']['error'] === UPLOAD_ERR_OK) {
        $pastaDestino = '../../uploads/capas/';
        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0777, true);
        }

        $nomeArquivo = uniqid() . '_' . basename($_FILES['capa']['name']);
        $caminhoCompleto = $pastaDestino . $nomeArquivo;
        $caminhoRelativo = 'uploads/capas/' . $nomeArquivo;

        if (move_uploaded_file($_FILES['capa']['tmp_name'], $caminhoCompleto)) {
            $caminhoCapa = $caminhoRelativo;
        }
    }

    $sql = "INSERT INTO atividades (titulo, capa, data_publicacao, destaque, conteudo, deletado) VALUES (?, ?, ?, ?, ?, 0)";
    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die("Erro na preparação da SQL: " . $conexao->error);
    }

    $stmt->bind_param("sssss", $titulo, $caminhoCapa, $data, $destaque, $conteudo);

    if ($stmt->execute()) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_atividades.php?sucesso=cadastrada');
    } else {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_atividades.php?erro=bd_execucao');
    }

    $stmt->close();
    $conexao->close();
}
?>
