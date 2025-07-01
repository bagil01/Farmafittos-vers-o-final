<?php
require_once(__DIR__ . '/../includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $referencia = trim($_POST['referencia'] ?? '');
    $logoPath = '';

    // Verifica se os campos obrigatórios foram preenchidos
    if (empty($titulo) || empty($referencia)) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_referencias.php?erro=campos_obrigatorios');
        exit;
    }

    // Upload da imagem (logo)
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $pastaDestino = __DIR__ . '/../assets/uploads/referencias/';
        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0755, true);
        }

        $nomeArquivo = uniqid() . '-' . basename($_FILES['logo']['name']);
        $caminhoCompleto = $pastaDestino . $nomeArquivo;

        if (move_uploaded_file($_FILES['logo']['tmp_name'], $caminhoCompleto)) {
            $logoPath = 'assets/uploads/referencias/' . $nomeArquivo;
        } else {
            header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_referencias.php?erro=upload');
            exit;
        }
    } else {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_referencias.php?erro=sem_logo');
        exit;
    }

    // Insere no banco
    $sql = "INSERT INTO referencias (titulo, referencia, logo) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", $titulo, $referencia, $logoPath);

        if ($stmt->execute()) {
            header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_referencias.php?sucesso=1');
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
