<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>
    <h1>Perfil do Usuário</h1>
    <p>E-mail: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
    <p>Data de Nascimento: <?php echo htmlspecialchars($_SESSION['data_nascimento']); ?></p>
    <p>Sobre Mim: <?php echo htmlspecialchars($_SESSION['sobre_mim']); ?></p>
    <img src="uploads/<?php echo htmlspecialchars($_SESSION['foto_perfil']); ?>" alt="Foto de Perfil" width="150">
    <a href="atualizar_perfil.php">Editar Perfil</a>
    <a href="controller/ProjetoController.php?action=logout">Sair</a>
</body>
</html>
