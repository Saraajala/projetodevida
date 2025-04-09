<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><title>Redefinir Senha</title></head>
<body>
    <h1>Redefinir Senha</h1>
    <?php if (isset($_SESSION["msg"])): ?>
        <p style="color: <?= $_SESSION["tipo_msg"] === "sucesso" ? 'green' : 'red' ?>;">
            <?= $_SESSION["msg"] ?>
        </p>
        <?php unset($_SESSION["msg"], $_SESSION["tipo_msg"]); ?>
    <?php endif; ?>

    <form action="../processa/processa_redefinicao.php" method="POST">
        <input type="email" name="email" required>
        <input type="password" name="nova_senha" required>
        <input type="password" name="confirmar_senha" required>
        <button type="submit">Redefinir</button>
    </form>
</body>
</html>
