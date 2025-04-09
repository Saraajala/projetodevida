<?php
session_start();
require_once '../config.php';
require_once '../controller/ProjetoController.php';

$controller = new ProjetoController($pdo);

// Verifica se os dados foram enviados corretamente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $dataNascimento = $_POST['data_nascimento'] ?? '';

    $resultado = $controller->cadastrar($nome, $email, $senha, $dataNascimento);

    if ($resultado['sucesso']) {
        $_SESSION['msg'] = $resultado['mensagem'];
        $_SESSION['tipo_msg'] = 'sucesso';
        header("Location: ../view/login.php");
    } else {
        $_SESSION['msg'] = $resultado['mensagem'];
        $_SESSION['tipo_msg'] = 'erro';
        header("Location: ../view/cadastro.php");
    }
    exit;
}
