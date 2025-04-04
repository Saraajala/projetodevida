<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <form action="../index.php" method="POST">
        <input type="email" name="email" placeholder="Digite seu e-mail" required>
        <input type="password" name="senha" placeholder="Digite sua senha" required>
        <button type="submit">Entrar</button>
    </form>

 <!-- Exibir mensagem de redefinição de senha -->
    <?php if (isset($_SESSION["msg"])): ?>
        <p style="color: <?php echo ($_SESSION["tipo_msg"] === "sucesso") ? 'green' : 'red'; ?>;">
            <?php echo $_SESSION["msg"]; ?>
        </p>
        <?php unset($_SESSION["msg"], $_SESSION["tipo_msg"]); ?>
    <?php endif; ?>

    <a href="esqueci_senha.php">Esqueci minha senha</a>
</body>
</html>
