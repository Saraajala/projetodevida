<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Perfil</title>
</head>
<body>
    <h1>Atualizar Perfil</h1>
    <form action="../controller/ProjetoController.php?action=atualizarPerfil" method="POST" enctype="multipart/form-data">
        <input type="email" name="email" value="<?= htmlspecialchars($_SESSION['email']) ?>" required>
        <input type="password" name="senha" placeholder="Nova Senha">
        <input type="date" name="data_nascimento" value="<?= htmlspecialchars($_SESSION['data_nascimento']) ?>" required>
        <input type="file" name="foto_perfil" accept="image/*">
        <textarea name="sobre_mim" placeholder="Sobre mim"><?= htmlspecialchars($_SESSION['sobre_mim']) ?></textarea>
        <button type="submit">Atualizar</button>
    </form>
    <a href="perfil.php">Voltar ao Perfil</a>
</body>
</html>
