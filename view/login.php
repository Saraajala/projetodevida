<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><title>Login</title></head>
<body>
    <h1>Login</h1>
    <form action="../processa/processa_login.php" method="POST">
        <input type="email" name="email" required>
        <input type="password" name="senha" required>
        <button type="submit">Entrar</button>
    </form>

    <?php if (isset($_SESSION["msg"])): ?>
        <p style="color: <?= $_SESSION["tipo_msg"] === "sucesso" ? 'green' : 'red' ?>;">
            <?= $_SESSION["msg"] ?>
        </p>
        <?php unset($_SESSION["msg"], $_SESSION["tipo_msg"]); ?>
    <?php endif; ?>

    <a href="redefinir_senha.php">Esqueci minha senha</a>
</body>
</html>
