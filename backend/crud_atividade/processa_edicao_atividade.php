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

    $caminhoCapa = null;

    // Verifica se nova capa foi enviada
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
        // Atualiza todos os campos incluindo nova capa
        $sql = "UPDATE atividades SET titulo = ?, capa = ?, data_publicacao = ?, destaque = ?, conteudo = ? WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("sssssi", $titulo, $caminhoCapa, $data, $destaque, $conteudo, $id);
    } else {
        // Atualiza os campos sem alterar a capa
        $sql = "UPDATE atividades SET titulo = ?, data_publicacao = ?, destaque = ?, conteudo = ? WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ssssi", $titulo, $data, $destaque, $conteudo, $id);
    }

    if (!$stmt) {
        die("Erro na preparação da SQL: " . $conexao->error);
    }

    if ($stmt->execute()) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_atividades.php?sucesso=editada');
    } else {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_atividades.php?erro=bd_execucao');
    }

    $stmt->close();
    $conexao->close();
}
?>
