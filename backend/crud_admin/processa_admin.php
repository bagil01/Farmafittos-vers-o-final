<?php
require_once(dirname(__DIR__, 2) . '/includes/conexao.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['Nome'] ?? '';
    $login = $_POST['Login'] ?? '';  // Agora pega o valor gerado no frontend
    $senha = $_POST['Senha'] ?? '';
    $confirmar_senha = $_POST['Confirmar_senha'] ?? '';

    if (empty($nome) || empty($login) || empty($senha) || empty($confirmar_senha)) {
        header('Location: ../../admin/pages/gerenciar_admin.php?erro=campos_vazios');
        exit;
    }
    // Validação de senha forte
    if (!preg_match('/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[\W_]).{6,10}$/', $senha)) {
        header('Location: ../../admin/pages/gerenciar_admin.php?erro=senha_fraca');
        exit;
    }

    if ($senha !== $confirmar_senha) {
        header('Location: ../../admin/pages/gerenciar_admin.php?erro=senhas_diferentes');
        exit;
    }

    // Upload da foto
    $fotoPath = '';

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        // Caminho correto relativo à raiz do projeto
        $pastaDestino = dirname(__DIR__, 2) . '/assets/uploads/admins/';

        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0755, true);
        }

        $nomeArquivo = uniqid() . '-' . basename($_FILES['foto']['name']);
        $caminhoCompleto = $pastaDestino . $nomeArquivo;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoCompleto)) {
            // Caminho salvo no banco (para ser usado nas views)
            $fotoPath = 'assets/uploads/admins/' . $nomeArquivo;
        } else {
            header('Location: ../admin/pages/gerenciar_admin.php?erro=upload');
            exit;
        }
    }


    // Criptografar senha
    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);


    // Inserção no banco
    $sql = "INSERT INTO admins (nome, login, senha, foto) VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);

    if ($stmt === false) {
        header('Location: ../../admin/pages/gerenciar_admin.php?erro=stmt_preparo_falhou');
        exit;
    }

    $stmt->bind_param("ssss", $nome, $login, $senhaCriptografada, $fotoPath);

    if ($stmt->execute()) {
        header('Location: ../../admin/pages/gerenciar_admin.php?sucesso=cadastro');
    } else {
        header('Location: ../../admin/pages/gerenciar_admin.php?erro=banco');
    }

    $stmt->close();
    $conexao->close();
}
?>