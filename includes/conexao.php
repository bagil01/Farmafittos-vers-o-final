<?php
// Dados de acesso ao database$database de dados
$host = 'localhost';        // Ou o IP do servidor, ex: 127.0.0.1
$user = 'root';          // Nome do usuário do database$database
$password = '';                // Senha (vazia por padrão no XAMPP)
$database = 'farmafittos';     // Nome do database$database de dados

// Cria conexão
$conexao = new mysqli($host, $user, $password, $database);

// Verifica conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Define o charset como UTF-8
$conexao->set_charset("utf8");
?>
