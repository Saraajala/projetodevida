<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
</head>  
<body>
    <h1>Redefinir Senha</h1>

    <!-- Exibir mensagens de erro ou sucesso -->
    <?php if (isset($_SESSION["msg"])): ?>
        <p style="color: <?php echo ($_SESSION["tipo_msg"] === "sucesso") ? 'green' : 'red'; ?>;">
            <?php echo $_SESSION["msg"]; ?>
        </p>
        <?php unset($_SESSION["msg"], $_SESSION["tipo_msg"]); ?>
    <?php endif; ?>

    <form action="processa_redefinicao.php" method="POST">
        <input type="email" name="email" placeholder="Digite seu e-mail" required>
        <input type="password" name="nova_senha" placeholder="Digite a nova senha" required>
        <input type="password" name="confirmar_senha" placeholder="Confirme a nova senha" required>
        <button type="submit">Redefinir Senha</button>
    </form>

    <a href="login.php">Voltar</a>
</body>
</html>
