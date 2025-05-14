<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once '../config.php';
require_once '../model/ProjetoModel.php';

$projetoModel = new ProjetoModel($pdo);
$usuario = $projetoModel->buscarUsuarioPorId($_SESSION['usuario_id']); // Busca do banco de dados com base no ID da sessão

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit;
}

// Formatação da data de nascimento
$dataFormatada = '';
if (!empty($usuario['data_nascimento'])) {
    $dataFormatada = date('Y-m-d', strtotime($usuario['data_nascimento']));
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Perfil</title>
</head>
<body>
    <h1>Atualizar Perfil</h1>

    <!-- Formulário para atualizar o perfil -->
    <form action="../processa/processa_atualizacao.php" method="post" enctype="multipart/form-data">

        
        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required><br><br>

        <label for="senha">Nova Senha:</label><br>
        <input type="password" id="senha" name="senha" placeholder="Deixe em branco para manter"><br>
        <small>Preencha esse campo apenas se quiser trocar a senha.</small><br><br>

        <label for="data_nascimento">Data de Nascimento:</label><br>
        <input type="date" id="data_nascimento" name="data_nascimento" value="<?= $dataFormatada ?>" required><br><br>

        <label for="sobre_mim">Sobre Mim:</label><br>
        <textarea id="sobre_mim" name="sobre_mim" rows="4" cols="40"><?= htmlspecialchars($usuario['sobre_mim'] ?? '') ?></textarea><br><br>

        <label for="fotoPerfil">Foto de Perfil:</label><br>
        <input type="file" id="fotoPerfil" name="fotoPerfil" accept="image/*"><br><br>

        <button type="submit">Atualizar</button>
    </form>

    <a href="perfil.php">Voltar ao Perfil</a>
</body>
</html>
