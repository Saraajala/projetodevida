<?php
session_start();

// Verificar se existe um parâmetro de erro na URL
if (isset($_GET['erro']) && $_GET['erro'] == 1) {
    $_SESSION['erro_mensagem'] = "Teste não concluído, inicie novamente!";
    header('Location: /view/teste_personalidade.php'); // Redireciona de volta para a página
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_inicio_teste.css">
    <title>Teste de personalidade</title>
</head>
<body class="inicio-teste">
    <div class="left-side">
        <img src="../imagens/certo.jpg" alt="fundo teste">
    </div>

    <div class="container">
    <header class="header-inicio">
            <img src="../imagens/logo.png" alt="logo" class="logo">

            <nav>
                <ul class="menu-central">
                    <li><a href="../view/plano_acao.php">Plano de ação</a></li>
                    <li><a href="../view/form_planejamento.php">Planeamento do futuro</a></li>
                </ul>
            </nav>

            <div class="perfil-wrapper">
                <a href="../index.php" class="sair">Início</a>
                <a href="../view/perfil.php" class="icone-perfil-link">
                    <img src="../imagens/usuario.png" alt="Perfil" class="icone-perfil">
                </a>
                <a href="logout.php" class="sair">Sair</a>
            </div>
        </header>

        <section id="teste-personalidade">
            <h2>TESTE DE PERSONALIDADE</h2>
            <p>Faça o teste e veja se a arquitetura é o seu caminho!</p>
            <button id="iniciar-teste" onclick="location.href='teste.php'">INICIAR TESTE</button>
        </section>
    </div>

    <footer class="cadastro-footer2">© TODOS OS DIREITOS RESERVADOS</footer>
</body>
</html>
