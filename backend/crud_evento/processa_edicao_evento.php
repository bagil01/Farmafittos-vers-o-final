<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_evento'] ?? null;

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

    if (!$id || empty($titulo) || empty($data_evento) || empty($hora) || empty($localizacao) || empty($descricao) || empty($ingresso) || empty($whatsapp)) {
        header('Location: ../../admin/pages/gerenciador_eventos.php?erro=campos_obrigatorios');
        exit;
    }

    // Verifica se uma nova imagem de capa foi enviada
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
        }
    }

    // Monta SQL com ou sem nova capa
    if ($caminhoCapa) {
        $sql = "UPDATE eventos SET 
            titulo = ?, capa = ?, formulario_inscricao = ?, ingresso = ?, 
            data_evento = ?, descricao = ?, instagram = ?, whatsapp = ?, 
            localizacao = ?, hora = ?, link_maps = ?
            WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param(
            "sssssssssssi",
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
            $link_maps,
            $id
        );
    } else {
        $sql = "UPDATE eventos SET 
            titulo = ?, formulario_inscricao = ?, ingresso = ?, 
            data_evento = ?, descricao = ?, instagram = ?, whatsapp = ?, 
            localizacao = ?, hora = ?, link_maps = ?
            WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param(
            "ssssssssssi",
            $titulo,
            $formulario,
            $ingresso,
            $data_evento,
            $descricao,
            $instagram,
            $whatsapp,
            $localizacao,
            $hora,
            $link_maps,
            $id
        );
    }

    // Executa e redireciona
    if ($stmt->execute()) {
        header('Location: ../../admin/pages/gerenciador_eventos.php?sucesso=editado');
    } else {
        header('Location: ../../admin/pages/gerenciador_eventos.php?erro=bd_execucao');
    }

    $stmt->close();
    $conexao->close();
}
?>
