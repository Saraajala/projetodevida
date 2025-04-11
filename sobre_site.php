<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>SOBRE O SITE</title>
</head>

<body class="sobre-site">

    <header class="header-sobre">
        <img src="imagens/logo.png" alt="logo" class="logo">

        <nav>
            <ul class="menu-central">
                <li><a href="view/cadastro.php">Cadastre-se</a></li>
                <li><a href="view/login.php">Entrar</a></li>
            </ul>
        </nav>

        <a href="inicio.php" class="voltar">Voltar</a>
    </header>

    <main class="conteudo-sobre">
        <h1 class="titulo-sobre">PROJETO DE VIDA</h1>

        <br><br><br><br>

        <section class="secao-projeto">
            <div class="texto-imagem">
                <div class="texto">
                    <h3>MEU PROJETO</h3>
                    <p>Esse site tem como objetivo apresentar o projeto de vida da aluna Sara Ajala Silva e proporcionar uma experiência imersiva para os usuários, a partir de testes de personalidade e áreas para traçar planos de carreira.</p>
                </div>
                <div class="imagens_sobre">
                    <img src="imagens/img_1_sobre.png" alt="imagem 1">
                    <img src="imagens/img_2_sobre.png" alt="imagem 2">
                </div>
            </div>

            <br><br><br><br> <br><br><br><br> <br><br><br><br>

            <div class="bloco-cadastro">
                <h2 class="escrita-bloco-cadastro">JÁ SE CADASTROU?</h2> <br>
                <a href="view/cadastro.php" class="botao-cadastro">FAÇA AQUI SEU CADASTRO</a>
            </div>

            <br><br><br><br> <br><br><br><br> <br><br><br><br>

            <div class="secao-senai">
                <div class="bloco-fundo-senai"></div>

                <div class="bloco-senai-separado">
                    <!-- Imagem esquerda com bloco -->
                    <div class="imagem-senai-container">
                        <div class="imagem-senai-bloco">
                            <img src="imagens/img_3_sobre.png" alt="Imagem esquerda">
                        </div>
                    </div>

                    <!-- Texto central -->
                    <div class="texto-central">
                        <h2>SOBRE O SENAI</h2>
                        <p>
                            O curso de Desenvolvimento de Sistemas do SENAI tem sido essencial para minha jornada na programação.
                            Ele me proporcionou uma base sólida em lógica de programação, banco de dados e desenvolvimento web,
                            além de reforçar a importância das boas práticas e do trabalho em equipe.
                            Com os conhecimentos adquiridos, posso aplicar conceitos na prática, desenvolver projetos reais e
                            aprimorar minhas habilidades, o que me ajuda a ganhar confiança e preparar meu caminho para o mercado
                            de trabalho.
                        </p>
                    </div>

                    <!-- Imagem direita com bloco -->
                    <div class="imagem-senai-container">
                        <div class="imagem-senai-bloco">
                            <img src="imagens/img_3_sobre.png" alt="Imagem direita">
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </section>

        <br><br><br><br> <br><br><br><br> <br><br><br><br>

        <footer class="rodape">

            <div class="coluna logo">
                <img src="imagens/logo.png" alt="Logo Sara Ajala Arquitetura">
            </div>

            <div class="coluna mapa-site">
                <h1>MAPA DO SITE</h1>
                <ul>
                    <li><a href="sobre_profissao.php">✦ SOBRE A PROFISSÃO</a></li>
                    <li><a href="view/teste_personalidade.php">✦ TESTE DE PERSONALIDADE</a></li>
                    <li><a href="planejamento_futuro.php">✦ PLANEJAMENTO DO FUTURO</a></li>
                    <li><a href="view/perfil.php">✦ MEU PERFIL</a></li>
                    <li><a href="inicio.php">✦ SAIR</a></li>
                </ul>
            </div>

            <div class="coluna feedbacks">
                <h1>FEEDBACKS</h1>
                <form action="index.php?action=salvarFeedback" method="POST">
    <label for="email">E-MAIL:</label>
    <input type="email" id="email" name="email" required>

    <label for="opiniao">ESCREVA AQUI SUA OPINIÃO:</label>
    <textarea id="opiniao" name="opiniao" required></textarea>

    <button type="submit">ENVIAR</button>
</form>

                <?php
                if (isset($_GET['msg']) && $_GET['msg'] == 'feedback_enviado') {
                    echo "<p>Feedback enviado com sucesso!</p>";
                }
                ?>
            </div>

            <div class="direitos">
                <p>© TODOS OS DIREITOS RESERVADOS</p>
            </div>

        </footer>

    </main>

</body>

</html>