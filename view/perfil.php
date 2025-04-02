<!DOCTYPE html>
<html>
<head>
    <title>Perfil</title>
</head>
<body>
    <h2>Perfil do Usuário</h2>
    <p>Nome: <?php echo $_SESSION['nome']; ?></p>
    <p>E-mail: <?php echo $_SESSION['email']; ?></p>
    <p>Data de Nascimento: <?php echo $_SESSION['data_nascimento']; ?></p>
    <p>Sobre Mim: <?php echo $_SESSION['sobre_mim']; ?></p>
    <img src="uploads/<?php echo $_SESSION['foto_perfil']; ?>" alt="Foto de Perfil" width="150">
    <a href="atualizar_perfil.php">Editar Perfil</a>
    <a href="controller/ProjetoController.php?action=logout">Sair</a>
</body>
</html>