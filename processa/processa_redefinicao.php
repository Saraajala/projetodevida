<?php
session_start();
require_once '../config.php';
require_once '../controller/ProjetoController.php';

$controller = new ProjetoController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $novaSenha = $_POST['nova_senha'] ?? '';
    $confirmarSenha = $_POST['confirmar_senha'] ?? '';

    if ($novaSenha !== $confirmarSenha) {
        $_SESSION['msg'] = "As senhas não coincidem!";
        header("Location: ../view/redefinir_senha.php");
        exit;
    }

    $resultado = $controller->redefinirSenhaDireta($email, $novaSenha);

    if ($resultado['sucesso']) {
        $_SESSION['msg'] = $resultado['mensagem'];
        header("Location: ../view/redefinir_senha.php");
    } else {
        $_SESSION['msg'] = $resultado['mensagem'];
        header("Location: ../view/login.php");
    }
    exit;
}
