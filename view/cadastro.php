<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo.css">
</head>
<body class="pagina-cadastro">

    <div class="cadastro-wrapper">
        <div class="cadastro-logo">
            <img src="../imagens/logo.png" alt="Logo Sara Ajala Arquitetura">
        </div>

        <div class="cadastro-container">
            <div class="cadastro-form-box">
                <h1>CADASTRE-SE</h1>
                <form action="../processa/processa_cadastro.php" method="POST" class="cadastro-form">
                    <input type="text" name="nome" placeholder="NOME:" required>
                    <input type="email" name="email" placeholder="E-MAIL:" required>
                    <input type="date" name="data_nascimento" required>
                    <input type="password" name="senha" placeholder="SENHA:" required>
                    <button type="submit">CADASTRAR</button>
                </form>
                <a href="login.php" class="cadastro-link">Já tem uma conta?</a>
            </div>
        </div>
    </div>

    <footer class="cadastro-footer">© TODOS OS DIREITOS RESERVADOS</footer>
</body>
</html>