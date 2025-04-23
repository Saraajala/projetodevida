<?php
session_start();
require_once '../config.php';
require_once '../controller/ProjetoController.php';

$controller = new ProjetoController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica o login
    $resultado = $controller->login($email, $senha);

    // Verificar se o login foi bem-sucedido
    if ($resultado && $_SESSION['msg'] == "sucesso") {
        // Armazenar os dados do usuário na sessão
        $_SESSION['usuario_id'] = $resultado['id']; 
        $_SESSION['email'] = $resultado['email'];
        $_SESSION['data_nascimento'] = $resultado['data_nascimento'];
        $_SESSION['foto_perfil'] = $resultado['foto_perfil'] ?? 'padrao.png';
        $_SESSION['sobre_mim'] = $resultado['sobre_mim'] ?? '';
        
        // Redireciona para o 'inicio.php' após login bem-sucedido
        header("Location: ../inicio.php");
        exit; // Interrompe a execução do script após o redirecionamento
    } else {
        // Se o login falhar
        $_SESSION['erro_login'] = "Credenciais inválidas!";
        header("Location: login.php");
        exit(); // Interrompe a execução do script e redireciona para o login
    }
}
