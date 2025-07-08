<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Campos do formulário
    $titulo = trim($_POST['titulo'] ?? '');
    $data_evento = $_POST['data_evento'] ?? '';
    $hora = $_POST['hora'] ?? '';
    $localizacao = trim($_POST['localizacao'] ?? '');
    $link_maps = trim($_POST['link_maps'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $formulario = trim($_POST['formulario_inscricao'] ?? '');
    $ingresso = trim($_POST['ingresso'] ?? '');
    $whatsapp = trim($_POST['whatsapp'] ?? '');
    $instagram = trim($_POST['instagram'] ?? '');

    // Verifica campos obrigatórios
    if (empty($titulo) || empty($data_evento) || empty($hora) || empty($localizacao) || empty($descricao) || empty($ingresso) || empty($whatsapp)) {
        header('Location: ../../admin/pages/gerenciador_eventos.php?erro=campos_obrigatorios');
        exit;
    }

    // Upload da imagem de capa
    $caminhoCapa = null;
    if (isset($_FILES['capa']) && $_FILES['capa']['error'] === UPLOAD_ERR_OK) {
        $pastaDestino = 'uploads/capas_eventos/';
        if (!is_dir('../../' . $pastaDestino)) {
            mkdir('../../' . $pastaDestino, 0777, true);
        }

        $nomeArquivo = uniqid() . '_' . basename($_FILES['capa']['name']);
        $caminhoRelativo = $pastaDestino . $nomeArquivo;

        if (move_uploaded_file($_FILES['capa']['tmp_name'], '../../' . $caminhoRelativo)) {
            $caminhoCapa = $caminhoRelativo;
        } else {
            header('Location: ../../admin/pages/gerenciador_eventos.php?erro=upload_imagem');
            exit;
        }
    } else {
        header('Location: ../../admin/pages/gerenciador_eventos.php?erro=capa_obrigatoria');
        exit;
    }

    // Inserção no banco
    $sql = "INSERT INTO eventos (
                titulo, capa, formulario_inscricao, ingresso,
                data_evento, descricao, instagram, whatsapp,
                localizacao, hora, link_maps
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die("Erro na preparação da SQL: " . $conexao->error);
    }

    $stmt->bind_param(
        "sssssssssss",
        $titulo,
        $caminhoCapa,
        $formulario,
        $ingresso,
        $data_evento,
        $descricao,
        $instagram,
        $whatsapp,
        $localizacao,
        $hora,
        $link_maps
    );

    if ($stmt->execute()) {
        header('Location: ../../admin/pages/gerenciador_eventos.php?sucesso=cadastrado');
    } else {
        header('Location: ../../admin/pages/gerenciador_eventos.php?erro=bd_execucao');
    }

    $stmt->close();
    $conexao->close();
}
?>
