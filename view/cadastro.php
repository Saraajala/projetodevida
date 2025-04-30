<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_cadastro.css">
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
                    <input type="text" name="data_nascimento" id="data_nascimento" placeholder="DD/MM/AAAA" maxlength="10" required>
                    <input type="password" name="senha" placeholder="SENHA:" required>
                    <button type="submit">CADASTRAR</button>
                </form>
                <a href="login.php" class="cadastro-link">Já tem uma conta?</a>
            </div>
        </div>
    </div>

    <footer class="cadastro-footer">© TODOS OS DIREITOS RESERVADOS</footer>

    <script>
  const inputData = document.getElementById('data_nascimento');
  inputData.addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length > 2) value = value.slice(0, 2) + '/' + value.slice(2);
    if (value.length > 5) value = value.slice(0, 5) + '/' + value.slice(5, 9);
    e.target.value = value.slice(0, 10);
  });
</script>
    
</body>
</html>