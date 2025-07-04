<?php
require_once('../../includes/conexao.php');

// Verifica se o ID do evento foi informado
if (empty($_POST['id_evento'])) {
    echo "ID do evento não fornecido.";
    exit;
}

$id = intval($_POST['id_evento']);

// Verifica se os campos obrigatórios foram preenchidos
if (
    empty($_POST['titulo']) ||
    empty($_POST['localizacao']) ||
    empty($_POST['descricao']) ||
    empty($_POST['formulario_inscricao']) ||
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

// Prepara a query de atualização
$stmt = $conexao->prepare("
    UPDATE eventos 
    SET titulo = ?, formulario_inscricao = ?, ingresso = ?, data_evento = ?, descricao = ?, instagram = ?, whatsapp = ?, localizacao = ?, hora = ? 
    WHERE id = ?
");

$stmt->bind_param(
    "sssssssssi",
    $titulo,
    $formulario,
    $ingresso,
    $data_evento,
    $descricao,
    $instagram,
    $whatsapp,
    $localizacao,
    $hora,
    $id
);

// Executa e verifica o resultado
if ($stmt->execute()) {
    header("Location: /Farmafittos-vers-o-final/admin/pages/gerenciador_eventos.php?editado=1");
    exit;
} else {
    echo "Erro ao editar evento: " . $stmt->error;
    exit;
}
