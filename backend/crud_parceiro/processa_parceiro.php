<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $referencia = trim($_POST['referencia'] ?? '');
    $logoPath = '';

    // Validação básica
    if (empty($nome) || empty($referencia)) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciar_parceiros.php?erro=campos_obrigatorios');
        exit;
    }

    // Upload da logo (se fornecida)
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $pastaDestino = dirname(__DIR__, 2) . '/assets/uploads/parceiros/';
        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0755, true);
        }

        $nomeArquivo = uniqid() . '-' . basename($_FILES['logo']['name']);
        $logoPath = 'assets/uploads/parceiros/' . $nomeArquivo;
        move_uploaded_file($_FILES['logo']['tmp_name'], $pastaDestino . $nomeArquivo);
    }


    // Insere no banco de dados
    $query = "INSERT INTO parceiros (nome, referencia, logo) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("sss", $nome, $referencia, $logoPath);

    if ($stmt->execute()) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_parceiros.php?sucesso=cadastrado');
    } else {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_parceiros.php?erro=bd');
    }

    $stmt->close();
    $conexao->close();
}
