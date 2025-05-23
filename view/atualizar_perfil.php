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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_planejamento.css">
    <title>Atualizar Perfil</title>
</head>
<body>
    <div class="atualizar-perfil-container">
    <div class="atualizar-perfil-box">
        <div class="atualizar-perfil-header">
            <h1 class="atualizar-perfil-title">Atualizar Perfil</h1>
        </div>

        <form class="atualizar-perfil-form" action="../processa/processa_atualizacao.php" method="post" enctype="multipart/form-data">
            <div class="profile-picture-section">
                <div class="profile-picture-container">
                    <img src="../imagens/<?= htmlspecialchars($usuario['foto_perfil'] ?? 'padrao.png') ?>" 
                         alt="Foto de Perfil" 
                         class="profile-picture">
                </div>
                <label for="fotoPerfil" class="change-picture-btn">Alterar Foto</label>
                <input type="file" id="fotoPerfil" name="fotoPerfil" accept="image/*" style="display: none;">
            </div>

            <div class="form-group-full">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
            </div>

            <div class="form-group-full">
                <label for="senha">Nova Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="Deixe em branco para manter">
                <small>Preencha esse campo apenas se quiser trocar a senha.</small>
            </div>

            <div class="form-group-full">
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" id="data_nascimento" name="data_nascimento" value="<?= $dataFormatada ?>">
            </div>

            <div class="form-group-full">
                <label for="sobre_mim">Sobre Mim:</label>
                <textarea id="sobre_mim" name="sobre_mim" rows="4"><?= htmlspecialchars($usuario['sobre_mim'] ?? '') ?></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="save-btn">Salvar Alterações</button>
                <a href="perfil.php" class="cancel-btn">Cancelar</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
