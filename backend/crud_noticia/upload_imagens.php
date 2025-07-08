<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_noticia = $_POST['id_noticia'] ?? null;

    if (!$id_noticia || empty($_FILES['imagens'])) {
        header('Location: ../../admin/pages/gerenciador_noticias.php?erro=upload_vazio');
        exit;
    }

    $pastaDestino = dirname(__DIR__, 2) . "/assets/uploads/noticias/";
    if (!is_dir($pastaDestino)) {
        mkdir($pastaDestino, 0755, true);
    }

    foreach ($_FILES['imagens']['tmp_name'] as $index => $tmpName) {
        $nomeOriginal = $_FILES['imagens']['name'][$index];
        $extensao = pathinfo($nomeOriginal, PATHINFO_EXTENSION);
        $nomeArquivo = uniqid() . '.' . $extensao;
        $caminho = "assets/uploads/noticias/" . $nomeArquivo;

        if (move_uploaded_file($tmpName, $pastaDestino . $nomeArquivo)) {
            $stmt = $conexao->prepare("INSERT INTO fotos_noticias (noticia_id, caminho) VALUES (?, ?)");

            if (!$stmt) {
                // Mostra o erro de SQL diretamente e para a execução
                die("Erro ao preparar statement: " . $conexao->error);
            }

            $stmt->bind_param("is", $id_noticia, $caminho);
            $stmt->execute();
            $stmt->close();
        }

    }

    $conexao->close();
    header("Location: ../../admin/pages/gerenciador_noticias.php?sucesso=imagens_enviadas");
}
?>