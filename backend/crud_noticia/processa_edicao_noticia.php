<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_noticia'] ?? null;
    $titulo = trim($_POST['titulo'] ?? '');
    $data = trim($_POST['data'] ?? '');
    $destaque = ($_POST['destaque'] ?? 'nao') === 'sim' ? 'sim' : 'não';
    $conteudo = trim($_POST['conteudo'] ?? '');

    // Verifica se todos os campos obrigatórios foram preenchidos
    if (!$id || empty($titulo) || empty($data) || empty($conteudo) ) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_noticias.php?erro=campos_obrigatorios');
        exit;
    }

    // Verifica se a notícia existe
    $verifica = $conexao->prepare("SELECT id FROM noticias WHERE id = ?");
    $verifica->bind_param("i", $id);
    $verifica->execute();
    $resultado = $verifica->get_result();

    if ($resultado->num_rows === 0) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_noticias.php?erro=nao_encontrado');
        exit;
    }

    $verifica->close();

    // Atualiza os dados da notícia
    $sql = "UPDATE noticias SET titulo = ?, data_publicacao = ?, destaque = ?, conteudo = ? WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    if (!$stmt) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_noticias.php?erro=bd_prepare');
        exit;
    }

    $stmt->bind_param("ssssi", $titulo, $data, $destaque, $conteudo, $id);

    if ($stmt->execute()) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_noticias.php?sucesso=editada');
    } else {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_noticias.php?erro=bd_execucao');
    }

    $stmt->close();
    $conexao->close();
}
?>
