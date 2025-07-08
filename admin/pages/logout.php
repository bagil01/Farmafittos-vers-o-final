<?php
session_start();
session_unset(); // Remove todas as variáveis de sessão
session_destroy(); // Destrói a sessão

// Redireciona para a página de login ou inicial
header('Location: ../index.php');
exit;
?>
