<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_atividade = $_POST['id_atividade'] ?? null;

    if (!$id_atividade || empty($_FILES['imagens'])) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_atividades.php?erro=upload_vazio');
        exit;
    }

    $pastaDestino = dirname(__DIR__, 2) . "/assets/uploads/atividades/";
    if (!is_dir($pastaDestino)) {
        mkdir($pastaDestino, 0755, true);
    }

    foreach ($_FILES['imagens']['tmp_name'] as $index => $tmpName) {
        $nomeOriginal = $_FILES['imagens']['name'][$index];
        $extensao = pathinfo($nomeOriginal, PATHINFO_EXTENSION);
        $nomeArquivo = uniqid() . '.' . $extensao;
        $caminho = "assets/uploads/atividades/" . $nomeArquivo;

        if (move_uploaded_file($tmpName, $pastaDestino . $nomeArquivo)) {
            $stmt = $conexao->prepare("INSERT INTO fotos_atividades (atividade_id, caminho) VALUES (?, ?)");

            if (!$stmt) {
                // Mostra o erro de SQL diretamente e para a execução
                die("Erro ao preparar statement: " . $conexao->error);
            }

            $stmt->bind_param("is", $id_atividade, $caminho);
            $stmt->execute();
            $stmt->close();
        }

    }

    $conexao->close();
    header("Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_atividades.php?sucesso=imagens_enviadas");
}
?>