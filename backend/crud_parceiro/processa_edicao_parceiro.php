<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_parceiro'] ?? null;
    $nome = trim($_POST['nome'] ?? '');
    $referencia = trim($_POST['referencia'] ?? '');
    $logoPath = '';

    if (!$id || empty($nome) || empty($referencia)) {
        header('Location: ../../admin/pages/gerenciador_parceiros.php?erro=campos_obrigatorios');
        exit;
    }

    // Verifica se o parceiro existe
    $verifica = $conexao->prepare("SELECT logo FROM parceiros WHERE id = ?");
    $verifica->bind_param("i", $id);
    $verifica->execute();
    $resultado = $verifica->get_result();

    if ($resultado->num_rows === 0) {
        header('Location: ../../admin/pages/gerenciador_parceiros.php?erro=nao_encontrado');
        exit;
    }

    $parceiroAntigo = $resultado->fetch_assoc();
    $verifica->close();

    // Upload da nova logo, se fornecida
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === 0) {
        $pastaDestino = dirname(__DIR__, 2) . '/assets/uploads/parceiros/';
        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0755, true);
        }

        $extensao = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
        $nomeArquivo = uniqid() . '.' . $extensao;
        $logoPath = 'assets/uploads/parceiros/' . $nomeArquivo;
        move_uploaded_file($_FILES['logo']['tmp_name'], $pastaDestino . $nomeArquivo);
    }

    // Monta SQL dinamicamente
    $sql = "UPDATE parceiros SET nome = ?, referencia = ?";
    $tipos = "ss";
    $params = [$nome, $referencia];

    if (!empty($logoPath)) {
        $sql .= ", logo = ?";
        $tipos .= "s";
        $params[] = $logoPath;
    }

    $sql .= " WHERE id = ?";
    $tipos .= "i";
    $params[] = $id;

    $stmt = $conexao->prepare($sql);
    if (!$stmt) {
        header('Location: ../../admin/pages/gerenciador_parceiros.php?erro=bd_prepare');
        exit;
    }

    $stmt->bind_param($tipos, ...$params);

    if ($stmt->execute()) {
        header('Location: ../../admin/pages/gerenciador_parceiros.php?sucesso=editado');
    } else {
        header('Location: ../../admin/pages/gerenciador_parceiros.php?erro=bd_execucao');
    }

    $stmt->close();
    $conexao->close();
}
