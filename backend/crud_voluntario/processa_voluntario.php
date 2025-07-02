<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $curso = trim($_POST['curso'] ?? '');
    $curriculo_lattes = trim($_POST['curriculo_lattes'] ?? '');
    $fotoPath = '';

    // Verificação básica
    if (empty($nome) || empty($curso) || empty($curriculo_lattes)) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_voluntarios.php?erro=campos_obrigatorios');
        exit;
    }

    // Upload da foto (se fornecida)
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $pastaDestino = dirname(__DIR__, 2) . '/assets/uploads/voluntarios/';
        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0755, true);
        }

        $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $nomeArquivo = uniqid() . '.' . $extensao;
        $fotoPath = 'assets/uploads/voluntarios/' . $nomeArquivo;
        move_uploaded_file($_FILES['foto']['tmp_name'], $pastaDestino . $nomeArquivo);
    }

    // Inserir no banco de dados
    $query = "INSERT INTO voluntarios (nome, curso, curriculo_lattes, foto) VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("ssss", $nome, $curso, $curriculo_lattes, $fotoPath);

    if ($stmt->execute()) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_voluntarios.php?sucesso=cadastrado');
    } else {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_voluntarios.php?erro=bd');
    }

    $stmt->close();
    $conexao->close();
} else {
    header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_voluntarios.php');
    exit;
}
