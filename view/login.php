<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="controller/ProjetoController.php?action=login" method="POST">
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>
    <a href="cadastro.php">Cadastre-se</a>
    <a href="esqueci_senha.php">Esqueci minha senha</a>
</body>
</html>
