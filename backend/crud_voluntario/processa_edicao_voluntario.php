<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_voluntario'] ?? null;
    $nome = trim($_POST['nome'] ?? '');
    $curso = trim($_POST['curso'] ?? '');
    $curriculo_lattes = trim($_POST['curriculo_lattes'] ?? '');
    $fotoPath = '';

    // Validação dos campos obrigatórios
    if (!$id || empty($nome) || empty($curso) || empty($curriculo_lattes)) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_voluntarios.php?erro=campos_obrigatorios');
        exit;
    }

    // Verifica se o voluntário existe
    $verifica = $conexao->prepare("SELECT foto FROM voluntarios WHERE id = ?");
    $verifica->bind_param("i", $id);
    $verifica->execute();
    $resultado = $verifica->get_result();

    if ($resultado->num_rows === 0) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_voluntarios.php?erro=nao_encontrado');
        exit;
    }

    $voluntarioAntigo = $resultado->fetch_assoc();
    $verifica->close();

    // Upload da nova foto (se fornecida)
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

    // Monta a SQL dinamicamente
    $sql = "UPDATE voluntarios SET nome = ?, curso = ?, curriculo_lattes = ?";
    $tipos = "sss";
    $params = [$nome, $curso, $curriculo_lattes];

    if (!empty($fotoPath)) {
        $sql .= ", foto = ?";
        $tipos .= "s";
        $params[] = $fotoPath;
    }

    $sql .= " WHERE id = ?";
    $tipos .= "i";
    $params[] = $id;

    // Executa o UPDATE
    $stmt = $conexao->prepare($sql);
    if (!$stmt) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_voluntarios.php?erro=bd_prepare');
        exit;
    }

    $stmt->bind_param($tipos, ...$params);

    if ($stmt->execute()) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_voluntarios.php?sucesso=editado');
    } else {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_voluntarios.php?erro=bd_execucao');
    }

    $stmt->close();
    $conexao->close();
}
