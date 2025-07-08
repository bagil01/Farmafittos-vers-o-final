<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $data = trim($_POST['data'] ?? '');
    $destaque = ($_POST['destaque'] ?? 'nao') === 'sim' ? 'sim' : 'não';
    $conteudo = trim($_POST['conteudo'] ?? '');

    if (empty($titulo) || empty($data) || empty($conteudo)) {
        header('Location: ../../admin/pages/gerenciador_noticias.php?erro=campos_obrigatorios');
        exit;
    }

    // Verifica se foi enviada uma imagem de capa
    $caminhoCapa = null;

    if (isset($_FILES['capa']) && $_FILES['capa']['error'] === UPLOAD_ERR_OK) {
        $pastaDestino = 'uploads/capas/';
        if (!is_dir('../../' . $pastaDestino)) {
            mkdir('../../' . $pastaDestino, 0777, true);
        }

        $nomeArquivo = uniqid() . '_' . basename($_FILES['capa']['name']);
        $caminhoRelativo = $pastaDestino . $nomeArquivo;

        if (move_uploaded_file($_FILES['capa']['tmp_name'], '../../' . $caminhoRelativo)) {
            $caminhoCapa = $caminhoRelativo;
        }
    }

    $sql = "INSERT INTO noticias (titulo, capa, data_publicacao, destaque, conteudo, deletado) VALUES (?, ?, ?, ?, ?, 0)";
    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die("Erro na preparação da SQL: " . $conexao->error);
    }

    $stmt->bind_param("sssss", $titulo, $caminhoCapa, $data, $destaque, $conteudo);

    if ($stmt->execute()) {
        header('Location: ../../admin/pages/gerenciador_noticias.php?sucesso=cadastrada');
    } else {
        header('Location: ../../admin/pages/gerenciador_noticias.php?erro=bd_execucao');
    }

    $stmt->close();
    $conexao->close();
}
?>
