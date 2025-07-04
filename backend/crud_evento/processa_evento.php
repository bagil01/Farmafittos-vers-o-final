<?php
require_once('../../includes/conexao.php');

// Verifica se todos os campos obrigatórios foram preenchidos
if (
    empty($_POST['titulo']) ||
    empty($_POST['data_evento']) ||
    empty($_POST['hora']) ||
    empty($_POST['localizacao']) ||
    empty($_POST['descricao']) ||
    empty($_POST['formulario_inscricao']) ||
    empty($_POST['ingresso']) ||
    empty($_POST['whatsapp'])
) {
    echo "Preencha todos os campos obrigatórios.";
    exit;
}

// Captura e sanitiza os dados
$titulo = trim($_POST['titulo']);
$data_evento = $_POST['data_evento'];
$hora = $_POST['hora'];
$localizacao = trim($_POST['localizacao']);
$descricao = trim($_POST['descricao']);
$formulario = trim($_POST['formulario_inscricao']);
$ingresso = trim($_POST['ingresso']);
$whatsapp = trim($_POST['whatsapp']);
$instagram = !empty($_POST['instagram']) ? trim($_POST['instagram']) : null;

// Prepara a query
$stmt = $conexao->prepare("INSERT INTO eventos (titulo, formulario_inscricao, ingresso, data_evento, descricao, instagram, whatsapp, localizacao, hora) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param(
    "sssssssss",
    $titulo,
    $formulario,
    $ingresso,
    $data_evento,
    $descricao,
    $instagram,
    $whatsapp,
    $localizacao,
    $hora
);

// Executa e verifica o resultado
if ($stmt->execute()) {
    header("Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_eventos.php?sucesso=1");
    exit;
} else {
    echo "Erro ao cadastrar evento: " . $stmt->error;
    exit;
}
