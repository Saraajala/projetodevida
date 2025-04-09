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
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="nova_senha">Nova Senha:</label>
        <input type="password" name="nova_senha" required>
        <label for="confirmar_senha">Confirmar Senha:</label>
        <input type="password" name="confirmar_senha" required>
        <button type="submit">Redefinir</button>
    </form>
</body>
</html>
