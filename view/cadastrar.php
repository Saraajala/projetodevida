<?php
require_once 'C:\Turma2\xampp\htdocs\projetodevida\controller\ProjetoController.php';
require_once 'C:\Turma2\xampp\htdocs\projetodevida\config.php'; 

$controller = new ProjetoController($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); 

    $controller->cadastrar($nome, $email, $data_nascimento, $senha);

    // Redireciona para a página inicial após cadastro
    header("Location: ../index.php?");
    exit();
    
}
