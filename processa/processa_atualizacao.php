<?php
session_start();
require_once '../config.php';
require_once '../model/ProjetoModel.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $usuarioId = $_SESSION['usuario_id'];
    $email = $_POST['email'];
    $dataNascimento = $_POST['data_nascimento'];
    $sobreMim = $_POST['sobre_mim'];
    $senha = $_POST['senha'];

    // Verifica se a foto de perfil foi enviada
    $nomeArquivoFinal = null;
    if (isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] === UPLOAD_ERR_OK) {
        $extensao = pathinfo($_FILES['fotoPerfil']['name'], PATHINFO_EXTENSION);
        $nomeArquivoFinal = uniqid('perfil_', true) . '.' . $extensao;
        $caminhoDestino = "../imagens/" . $nomeArquivoFinal;
        
        // Move o arquivo para o diretório correto
        if (!move_uploaded_file($_FILES['fotoPerfil']['tmp_name'], $caminhoDestino)) {
            die("Erro ao fazer upload da foto de perfil.");
        }
    }

    // Se a senha não foi preenchida, ela não será alterada
    if (empty($senha)) {
        $senha = null;
    }

    // Chama o método do Model para atualizar os dados
    $projetoModel = new ProjetoModel($pdo);
    $projetoModel->atualizarPerfil($usuarioId, $email, $senha, $dataNascimento, $sobreMim, $nomeArquivoFinal);

    // Atualiza os dados na sessão
    $_SESSION['email'] = $email;
    $_SESSION['data_nascimento'] = $dataNascimento;
    $_SESSION['sobre_mim'] = $sobreMim;
    if ($nomeArquivoFinal) {
        $_SESSION['foto_perfil'] = $nomeArquivoFinal;
    }

    // Redireciona para o perfil atualizado
    header("Location: ../view/perfil.php");
    exit;
}
