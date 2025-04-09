<?php
session_start();
require_once '../config.php';
require_once '../controller/ProjetoController.php';

$controller = new ProjetoController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $resultado = $controller->login($email, $senha);


   if ($resultado && $_SESSION['msg'] == "sucesso") {
   
    $_SESSION['email'] = $resultado['email'];
    $_SESSION['data_nascimento'] = $resultado['data_nascimento'];
    $_SESSION['foto_perfil'] = $resultado['foto_perfil'] ?? 'padrao.png';
    $_SESSION['sobre_mim'] = $resultado['sobre_mim'] ?? '';
    header("Location: ../index.php");
} else {
        
        $_SESSION['msg'] = "erro";
        header("Location: ../view/login.php");
    }
    exit;
}
