<?php
require_once(__DIR__ . '/../includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $nome = trim($_POST['Nome'] ?? '');
    $senha = $_POST['Senha'] ?? '';
    $fotoPath = '';
    $erro = false;

    if (!$id || empty($nome)) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciar_admin.php?erro=campos_obrigatorios');
        exit;
    }

    // Gerar login novamente com base no nome (caso tenha sido alterado)
    $primeiro_nome = explode(" ", $nome)[0];
    $login = strtolower($primeiro_nome . '@Farma.fittos');

    // Atualização de senha apenas se fornecida
    $senhaAtualizada = '';
    if (!empty($senha)) {
        if (strlen($senha) < 6 || strlen($senha) > 10 || 
            !preg_match('/[a-zA-Z]/', $senha) || 
            !preg_match('/\d/', $senha) || 
            !preg_match('/[\W_]/', $senha)) {
            header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciar_admin.php?erro=senha_invalida');
            exit;
        }

        $senhaAtualizada = password_hash($senha, PASSWORD_DEFAULT);
    }

    // Upload da nova foto (se fornecida)
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $pastaDestino = __DIR__ . '/../assets/uploads/admins/';
        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0755, true);
        }

        $nomeArquivo = uniqid() . '-' . basename($_FILES['foto']['name']);
        $fotoPath = 'assets/uploads/admins/' . $nomeArquivo;
        move_uploaded_file($_FILES['foto']['tmp_name'], $pastaDestino . $nomeArquivo);
    }

    // Construir SQL dinamicamente
    $sql = "UPDATE admins SET nome = ?, login = ?";
    $tipos = "ss";
    $params = [$nome, $login];

    if (!empty($senhaAtualizada)) {
        $sql .= ", senha = ?";
        $tipos .= "s";
        $params[] = $senhaAtualizada;
    }

    if (!empty($fotoPath)) {
        $sql .= ", foto = ?";
        $tipos .= "s";
        $params[] = $fotoPath;
    }

    $sql .= " WHERE id = ?";
    $tipos .= "i";
    $params[] = $id;

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param($tipos, ...$params);

    if ($stmt->execute()) {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciar_admin.php?sucesso=editado');
    } else {
        header('Location: /Farmafittos-vers-o-final/admin/pages/gerenciar_admin.php?erro=bd');
    }

    $stmt->close();
    $conexao->close();
}
?>
