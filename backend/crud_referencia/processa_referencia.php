<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $referencia = trim($_POST['referencia'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $logoPath = '';

    // Verifica se os campos obrigatórios foram preenchidos
    if (empty($titulo) || empty($referencia)) {
        header('Location: ../../admin/pages/gerenciador_referencias.php?erro=campos_obrigatorios');
        exit;
    }

    // Upload da logo (se fornecida)
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $pastaDestino = dirname(__DIR__, 2) . '/assets/uploads/referencias/';
        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0755, true);
        }

        $nomeArquivo = uniqid() . '-' . basename($_FILES['logo']['name']);
        $logoPath = 'assets/uploads/referencias/' . $nomeArquivo;
        move_uploaded_file($_FILES['logo']['tmp_name'], $pastaDestino . $nomeArquivo);
    }

    // Insere no banco com o campo descricao
    $sql = "INSERT INTO referencias (titulo, referencia, descricao, logo) VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssss", $titulo, $referencia, $descricao, $logoPath);

        if ($stmt->execute()) {
            header('Location: ../../admin/pages/gerenciador_referencias.php?sucesso=1');
        } else {
            header('Location: ../../admin/pages/gerenciador_referencias.php?erro=bd');
        }

        $stmt->close();
    } else {
        header('Location: ../../admin/pages/gerenciador_referencias.php?erro=prepare');
    }

    $conexao->close();
} else {
    header('Location: ../../admin/pages/gerenciador_referencias.php');
    exit;
}
