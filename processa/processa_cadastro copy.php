<?php
session_start();

// Load required files
require_once '../config.php';
require_once '../model/ProjetoModel.php';  // Make sure this path is correct
require_once '../controller/ProjetoController.php';

// Initialize the model first, then the controller
$model = new ProjetoModel($pdo);  // Pass PDO to model
$controller = new ProjetoController($model);  // Pass model to controller

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data with default empty values
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $dataNascimento = $_POST['data_nascimento'] ?? '';

    // Call the registration method
    $resultado = $controller->cadastrar($nome, $email, $senha, $dataNascimento);

    if ($resultado['sucesso']) {
        // Registration successful
        $_SESSION['msg'] = $resultado['mensagem'];
        $_SESSION['tipo_msg'] = 'sucesso';
        $_SESSION['usuario_id'] = $resultado['id'];
        
        header("Location: ../../index.php");
        exit();
    } else {
        // Registration failed
        $_SESSION['msg'] = $resultado['mensagem'];
        $_SESSION['tipo_msg'] = 'erro';
        header("Location: ../view/cadastro.php");
        exit();
    }
}
?>