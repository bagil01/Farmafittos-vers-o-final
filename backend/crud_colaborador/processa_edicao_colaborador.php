<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_colaborador'] ?? null;
    $nome = trim($_POST['nome'] ?? '');
    $formacao = trim($_POST['formacao'] ?? '');
    $curriculo_lattes = trim($_POST['curriculo_lattes'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');

    $fotoPath = '';

    error_log("ID: $id");
    error_log("NOME: $nome");
    error_log("FORMAÇÃO: $formacao");
    error_log("LATTES: $curriculo_lattes");
    error_log("DESCRIÇÃO: $descricao");

    // ✅ Verificação completa de campos obrigatórios
    if (!$id || empty($nome) || empty($formacao) || empty($curriculo_lattes) || empty($descricao)) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_colaboradores.php?erro=campos_obrigatorios');
        exit;
    }

    // ✅ Verifica se colaborador existe
    $verifica = $conexao->prepare("SELECT foto FROM colaboradores WHERE id = ?");
    $verifica->bind_param("i", $id);
    $verifica->execute();
    $resultado = $verifica->get_result();

    if ($resultado->num_rows === 0) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_colaboradores.php?erro=nao_encontrado');
        exit;
    }

    $colaboradorAntigo = $resultado->fetch_assoc();
    $verifica->close();

    // ✅ Upload da nova foto, se enviada
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $pastaDestino = dirname(__DIR__, 2) . '/assets/uploads/colaboradores/';
        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0755, true);
        }

        $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $nomeArquivo = uniqid() . '.' . $extensao;
        $fotoPath = 'assets/uploads/colaboradores/' . $nomeArquivo;
        move_uploaded_file($_FILES['foto']['tmp_name'], $pastaDestino . $nomeArquivo);
    }

    // ✅ Monta SQL
    $sql = "UPDATE colaboradores SET nome = ?, formacao = ?, curriculo_lattes = ?, descricao = ?";
    $tipos = "ssss";
    $params = [$nome, $formacao, $curriculo_lattes, $descricao];

    if (!empty($fotoPath)) {
        $sql .= ", foto = ?";
        $tipos .= "s";
        $params[] = $fotoPath;
    }

    $sql .= " WHERE id = ?";
    $tipos .= "i";
    $params[] = $id;

    $stmt = $conexao->prepare($sql);
    if (!$stmt) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_colaboradores.php?erro=bd_prepare');
        exit;
    }

    $stmt->bind_param($tipos, ...$params);

    if ($stmt->execute()) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_colaboradores.php?sucesso=editado');
    } else {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_colaboradores.php?erro=bd_execucao');
    }

    $stmt->close();
    $conexao->close();
}
