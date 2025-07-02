<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_referencia'] ?? null;
    $titulo = trim($_POST['titulo'] ?? '');
    $referencia = trim($_POST['referencia'] ?? '');
    $logoPath = '';

    // Validação
    if (empty($id) || !is_numeric($id) || empty($titulo) || empty($referencia)) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_referencias.php?erro=campos_obrigatorios');
        exit;
    }

    // Se nova logo enviada
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $extensoesPermitidas = ['image/jpeg', 'image/png', 'image/webp'];
        if (!in_array($_FILES['logo']['type'], $extensoesPermitidas)) {
            header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_referencias.php?erro=tipo_arquivo');
            exit;
        }

       $pastaDestino = dirname(__DIR__, 2) . '/assets/uploads/referencias/';
        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0755, true);
        }

        $nomeArquivo = uniqid() . '-' . preg_replace('/[^a-zA-Z0-9\.-]/', '_', $_FILES['logo']['name']);
        $caminhoCompleto = $pastaDestino . $nomeArquivo;

        if (move_uploaded_file($_FILES['logo']['tmp_name'], $caminhoCompleto)) {
            $logoPath = 'assets/uploads/referencias/' . $nomeArquivo;
        } else {
            header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_referencias.php?erro=upload');
            exit;
        }
    }

    // Monta SQL
    $sql = "UPDATE referencias SET titulo = ?, referencia = ?";
    $tipos = "ss";
    $params = [$titulo, $referencia];

    if (!empty($logoPath)) {
        $sql .= ", logo = ?";
        $tipos .= "s";
        $params[] = $logoPath;
    }

    $sql .= " WHERE id = ?";
    $tipos .= "i";
    $params[] = $id;

    $stmt = $conexao->prepare($sql);
    if ($stmt) {
        $stmt->bind_param($tipos, ...$params);
        if ($stmt->execute()) {
            header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_referencias.php?sucesso=editado');
        } else {
            header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_referencias.php?erro=bd');
        }
        $stmt->close();
    } else {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_referencias.php?erro=prepare');
    }

    $conexao->close();
} else {
    header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_referencias.php');
    exit;
}
