<?php
session_start();
require_once '../config.php';
require_once '../model/ProjetoModel.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$projetoModel = new ProjetoModel($pdo);
$usuario = $projetoModel->buscarUsuarioPorId($_SESSION['usuario_id']); // <-- busca do banco

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit;
}

// Processamento do formulário quando enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $usuarioId = $_SESSION['usuario_id'];
    $email = $_POST['email'];
    $dataNascimento = $_POST['data_nascimento'];
    $sobreMim = $_POST['sobre_mim'];
    $senha = $_POST['senha'];

    // Processa o upload da foto
    $nomeArquivoFinal = null;
    if (isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] === UPLOAD_ERR_OK) {
        $extensao = pathinfo($_FILES['fotoPerfil']['name'], PATHINFO_EXTENSION);
        $nomeArquivoFinal = uniqid('perfil_', true) . '.' . $extensao;
        $caminhoDestino = "../imagens/" . $nomeArquivoFinal;
        
        // Tenta mover o arquivo para o diretório
        if (!move_uploaded_file($_FILES['fotoPerfil']['tmp_name'], $caminhoDestino)) {
            die("Erro ao fazer upload da foto de perfil.");
        }
    }

    // Se a senha não foi preenchida, ela não será alterada
    if (empty($senha)) {
        $senha = null;
    }

    // Atualiza o perfil no banco
    $projetoModel->atualizarPerfil($usuarioId, $email, $senha, $dataNascimento, $sobreMim, $nomeArquivoFinal);

    // Atualiza a sessão com os novos dados
    $_SESSION['email'] = $email;
    $_SESSION['data_nascimento'] = $dataNascimento;
    $_SESSION['sobre_mim'] = $sobreMim;
    if ($nomeArquivoFinal) {
        $_SESSION['foto_perfil'] = $nomeArquivoFinal;
    }

    // Redireciona para a página de perfil atualizada
    header("Location: perfil.php");
    exit;
}

// Formatação da data para exibição
$dataFormatada = '';
if (!empty($usuario['data_nascimento'])) {
    $dataFormatada = date('Y-m-d', strtotime($usuario['data_nascimento']));
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>
</head>
<body>
    <h2>Meu Perfil</h2>

    <!-- Formulário para atualizar o perfil -->
    <form action="atualizar_perfil.php" method="POST" enctype="multipart/form-data">
        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required><br><br>

        <label for="senha">Nova Senha:</label><br>
        <input type="password" id="senha" name="senha" placeholder="Deixe em branco para manter">
        <small>Preencha esse campo apenas se quiser trocar a senha.</small> <br>

        <label for="data_nascimento">Data de Nascimento:</label><br>
        <input type="date" id="data_nascimento" name="data_nascimento" value="<?= $dataFormatada ?>" required><br>

        <label for="sobre_mim">Sobre Mim:</label><br>
        <textarea id="sobre_mim" name="sobre_mim" rows="4" cols="40"><?= htmlspecialchars($usuario['sobre_mim'] ?? '') ?></textarea><br><br>

        <!-- Campo para upload da foto de perfil -->
        <label for="fotoPerfil">Foto de Perfil:</label><br>
        <input type="file" id="fotoPerfil" name="fotoPerfil"><br><br>

        <img src="../imagens/<?= htmlspecialchars($usuario['foto_perfil'] ?? 'padrao.png') ?>" 
             alt="Foto de Perfil" 
             width="150" style="border-radius: 50%;"><br><br>

        <div class="centro-botao">
            <button type="submit">Atualizar Perfil</button>
        </div>
    </form>
</body>
</html>
