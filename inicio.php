<?php
session_start();
// Verifica se o usuário já está logado
if (isset($_SESSION['usuario_id'])) {
    // Redireciona para a página inicial (index.php) caso esteja logado
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Início</title>
</head>
<body>
    <header class="header">
        <nav>
            <ul>
                <li><a href="view/cadastro.php">Cadastre-se</a></li>
                <li><a href="view/login.php">Entrar</a></li>
            </ul>
        </nav>
    </header>

    <main class="fundodoinicio">
        <a href="sobre_site.php" class="botao">SOBRE O SITE</a>
    </main>
</body>
</html>
