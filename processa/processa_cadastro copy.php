<?php
session_start();

// Carrega os arquivos de configuração e controlador
require_once '../config.php';
require_once '../controller/ProjetoController.php';

// Inicializa o controlador de projeto
$controller = new ProjetoController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário, com valor padrão vazio caso não existam
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $dataNascimento = $_POST['data_nascimento'] ?? '';

    // Chama o método de cadastro no controlador
    $resultado = $controller->cadastrar($nome, $email, $senha, $dataNascimento);

    if ($resultado['sucesso']) {
        // Se o cadastro foi bem-sucedido, define variáveis de sessão
        $_SESSION['msg'] = $resultado['mensagem'];
        $_SESSION['tipo_msg'] = 'sucesso';
        $_SESSION['usuario_id'] = $resultado['id']; // Define o ID do usuário

        // Redireciona para a página inicial (index.php) após o cadastro
        var_dump('estou aqui');
        die();
        header("Location: ../../index.php");
        exit();
    } else {
        // Em caso de erro no cadastro, define as mensagens de erro
        $_SESSION['msg'] = $resultado['mensagem'];
        $_SESSION['tipo_msg'] = 'erro';

        // Redireciona de volta para a página de cadastro (opcional, descomente se necessário)
        // header("Location: ../index.php");
        // exit();
    }
}
?>
