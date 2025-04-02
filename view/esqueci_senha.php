<!DOCTYPE html>
<html>
<head>
    <title>Recuperar Senha</title>
</head>
<body>
    <h2>Recuperar Senha</h2>
    <form action="controller/ProjetoController.php?action=esqueciSenha" method="POST">
        <input type="email" name="email" placeholder="Digite seu e-mail" required>
        <button type="submit">Enviar</button>
    </form>
    <a href="login.php">Voltar</a>
</body>
</html>