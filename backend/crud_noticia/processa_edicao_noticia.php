<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_noticia'] ?? null;
    $titulo = trim($_POST['titulo'] ?? '');
    $data = trim($_POST['data'] ?? '');
    $destaque = ($_POST['destaque'] ?? 'nao') === 'sim' ? 'sim' : 'nao';
    $conteudo = trim($_POST['conteudo'] ?? '');

    if (!$id || empty($titulo) || empty($conteudo)) {
        header('Location: ../../admin/pages/gerenciador_noticias.php?erro=campos_obrigatorios');
        exit;
    }

    // Lida com a imagem de capa (opcional)
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

    if ($caminhoCapa) {
        // Atualiza também a capa
        $sql = "UPDATE noticias SET titulo = ?, data_publicacao = ?, destaque = ?, conteudo = ?, capa = ? WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        if (!$stmt) {
            die("Erro ao preparar SQL com capa: " . $conexao->error);
        }
        $stmt->bind_param("sssssi", $titulo, $data, $destaque, $conteudo, $caminhoCapa, $id);
    } else {
        // Não altera a capa
        $sql = "UPDATE noticias SET titulo = ?, data_publicacao = ?, destaque = ?, conteudo = ? WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        if (!$stmt) {
            die("Erro ao preparar SQL sem capa: " . $conexao->error);
        }
        $stmt->bind_param("ssssi", $titulo, $data, $destaque, $conteudo, $id);
    }

    if ($stmt->execute()) {
        header('Location: ../../admin/pages/gerenciador_noticias.php?sucesso=editada');
    } else {
        header('Location: ../../admin/pages/gerenciador_noticias.php?erro=bd_execucao');
    }

    $stmt->close();
    $conexao->close();
}
?>