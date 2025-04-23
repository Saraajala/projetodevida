<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>
    <h1>Bem-vindo ao seu Perfil</h1>
    <p>Seu ID de usuário: <?php echo $usuario_id; ?></p>

    <h1>Perfil</h1>
    <p>E-mail: <?= htmlspecialchars($_SESSION['email']) ?></p>
    <p>Data de Nascimento: <?= htmlspecialchars($_SESSION['data_nascimento']) ?></p>
    <p>Sobre Mim: <?= htmlspecialchars($_SESSION['sobre_mim']) ?></p>
    <img src="../uploads/<?= htmlspecialchars($_SESSION['foto_perfil']) ?>" width="150">
    <a href="atualizar_perfil.php">Editar Perfil</a>
    <a href="../controller/ProjetoController.php?action=logout">Sair</a>
    <a href="view/feedbacks.php">Ver feedbacks de outros usuários</a>

    <a href="teste.php">Fazer o Teste</a>
    <br>
    <a href="logout.php">Sair</a>
</body>
</html>
