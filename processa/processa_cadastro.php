<?php
header("Location: ../index.php");
exit;
?>

<?php
session_start();
require_once '../config.php';
require_once '../controller/ProjetoController.php';

$controller = new ProjetoController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $dataNascimento = $_POST['data_nascimento'] ?? '';

    $resultado = $controller->cadastrar($nome, $email, $senha, $dataNascimento);

    if ($resultado['sucesso']) {
        $_SESSION['msg'] = $resultado['mensagem'];
        $_SESSION['tipo_msg'] = 'sucesso';
        $_SESSION['usuario_id'] = $resultado['id']; 
        header("Location: ../index.php");
    }
    
}
