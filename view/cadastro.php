<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><title>Cadastro</title></head>
<body>
    <h1>Cadastro</h1>
    <form action="../processa/processa_cadastro.php" method="POST">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" required>
        <input type="date" name="data_nascimento" required>
        <input type="password" name="senha" required>
        <button type="submit">Cadastrar</button>
    </form>
    <a href="login.php">Já tem uma conta?</a>
</body>
</html>
