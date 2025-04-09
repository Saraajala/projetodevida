<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><title>Perfil</title></head>
<body>
    <h1>Perfil</h1>
    <p>E-mail: <?= htmlspecialchars($_SESSION['email']) ?></p>
    <p>Data de Nascimento: <?= htmlspecialchars($_SESSION['data_nascimento']) ?></p>
    <p>Sobre Mim: <?= htmlspecialchars($_SESSION['sobre_mim']) ?></p>
    <img src="../uploads/<?= htmlspecialchars($_SESSION['foto_perfil']) ?>" width="150">
    <a href="atualizar_perfil.php">Editar Perfil</a>
    <a href="../controller/ProjetoController.php?action=logout">Sair</a>
</body>
</html>
