<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $formacao = trim($_POST['formacao'] ?? '');
    $curriculo_lattes = trim($_POST['curriculo_lattes'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $fotoPath = '';

    // Validação simples
    if (empty($nome) || empty($formacao) || empty($curriculo_lattes) || empty($descricao)) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_colaboradores.php?erro=campos_obrigatorios');
        exit;
    }

    // Upload da foto
    $fotoPath = '';

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        // Caminho correto relativo à raiz do projeto
        $pastaDestino = dirname(__DIR__, 2) . '/assets/uploads/colaboradores/';

        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0755, true);
        }

        $nomeArquivo = uniqid() . '-' . basename($_FILES['foto']['name']);
        $caminhoCompleto = $pastaDestino . $nomeArquivo;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoCompleto)) {
            // Caminho salvo no banco (para ser usado nas views)
            $fotoPath = 'assets/uploads/colaboradores/' . $nomeArquivo;
        } else {
            header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciar_colaboradores.php?erro=upload');
            exit;
        }
    }

    // Insere os dados no banco
    $sql = "INSERT INTO colaboradores (nome, formacao, curriculo_lattes, descricao, foto) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssss", $nome, $formacao, $curriculo_lattes, $descricao, $fotoPath);

        if ($stmt->execute()) {
            header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_colaboradores.php?sucesso=cadastrado');
        } else {
            header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_colaboradores.php?erro=bd');
        }

        $stmt->close();
    } else {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_colaboradores.php?erro=prepare');
    }

    $conexao->close();
} else {
    header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_colaboradores.php');
    exit;
}
