<?php
require_once '../config.php';
require_once '../model/ProjetoModel.php';
require_once '../controller/ProjetoController.php';


// Verifica se a requisição foi feita por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitiza e valida os dados recebidos
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $data_nascimento = $_POST['data_nascimento'] ?? '';

    // Verifica se todos os campos obrigatórios estão preenchidos
    if (empty($nome) || empty($email) || empty($senha) || empty($data_nascimento)) {
        header("Location: cadastro.php?msg=campos_obrigatorios");
        exit;
    }

    // Valida e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: cadastro.php?msg=email_invalido");
        exit;
    }

    // Valida formato da data (opcional)
    $data_formatada = date('Y-m-d', strtotime($data_nascimento));
    
    if (!$data_formatada) {
        header("Location: cadastro.php?msg=data_invalida");
        exit;
    }

    // Criptografa a senha com password_hash
    //$senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
    // $resultado = $controller->cadastrar($nome, $email, $senha, $data_nascimento);

    // Instancia os objetos
    $model = new ProjetoModel($pdo); // Usa a conexão do config.php
    $controller = new ProjetoController($pdo);

    // Tenta cadastrar
    $resultado = $controller->cadastrar($nome, $email, $senha, $data_formatada);

    if ($resultado['sucesso']) {
        header("Location: ../index.php?msg=cadastro_sucesso");
        exit;
    } else {
        $mensagemErro = urlencode($resultado['mensagem']);
        header("Location: ../view/cadastro.php?msg=erro&erro=" . $mensagemErro);
        exit;
    }
} else {
    // Redireciona se o acesso for indevido
    header("Location: ../view/cadastro.php");
    exit;
}
