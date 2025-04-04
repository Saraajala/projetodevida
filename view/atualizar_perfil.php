<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Perfil</title>
</head>
<body>
    <h1>Atualizar Perfil</h1>
    <form action="controller/ProjetoController.php?action=atualizarPerfil" method="POST" enctype="multipart/form-data">
        <input type="email" name="email" placeholder="E-mail" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" required>
        <input type="password" name="senha" placeholder="Nova Senha">
        <input type="date" name="data_nascimento" value="<?php echo htmlspecialchars($_SESSION['data_nascimento']); ?>" required>
        <input type="file" name="foto_perfil" accept="image/*">
        <textarea name="sobre_mim" placeholder="Sobre mim"><?php echo htmlspecialchars($_SESSION['sobre_mim']); ?></textarea>
        <button type="submit">Atualizar</button>
    </form>
    <a href="perfil.php">Voltar ao Perfil</a>
</body>
</html>
