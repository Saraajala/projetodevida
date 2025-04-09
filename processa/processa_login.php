<?php
session_start();
require_once '../config.php';
require_once '../controller/ProjetoController.php';

$controller = new ProjetoController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $resultado = $controller->login($email, $senha);

    if ($resultado['sucesso']) {
        $_SESSION['email'] = $resultado['usuario']['email'];
        $_SESSION['data_nascimento'] = $resultado['usuario']['data_nascimento'];
        $_SESSION['foto_perfil'] = $resultado['usuario']['foto_perfil'] ?? 'padrao.png';
        $_SESSION['sobre_mim'] = $resultado['usuario']['sobre_mim'] ?? '';
        $_SESSION['msg'] = $resultado['mensagem'];
        $_SESSION['tipo_msg'] = 'sucesso';
        header("Location: ../view/perfil.php");
    } else {
        $_SESSION['msg'] = $resultado['mensagem'];
        $_SESSION['tipo_msg'] = 'erro';
        header("Location: ../view/login.php");
    }
    exit;
}
