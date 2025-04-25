<?php
session_start();
//session_destroy(); // Destrói a sessão

?>

<?php

if (isset($_SESSION['usuario_id'])) {
    // Usuário logado, você pode utilizar o $_SESSION['usuario_id'] para identificar
    echo "Usuário logado: " . $_SESSION['usuario_id'];
} else {
    echo "Usuário NÃO logado.";
}
?>

<?php
if (isset($_GET['action']) && $_GET['action'] == 'salvarFeedback') {
    require_once 'config.php'; // conexão certa
    require_once 'controller/ProjetoController.php';

    $controller = new ProjetoController($pdo);
    $controller->salvarFeedback();
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

<body class="index">

    <header class="header-sobre">
        <img src="imagens/logo.png" alt="logo" class="logo">

        <nav>
            <ul class="menu-central">
                <li><a href="view/plano_acao.php">Plano de ação</a></li>
                <li><a href="view/teste_personalidade.php">Teste de personalidade</a></li>
                <li><a href="view/planejamento_futuro.php">Planeamento do futuro</a></li>
            </ul>
        </nav>

        <div class="perfil-wrapper">
            <a href="./view/perfil.php" class="icone-perfil-link">
                <img src="imagens/usuario.png" alt="Perfil" class="icone-perfil">
            </a>
            <a href="logout.php" class="sair">Sair</a>
        </div>
    </header>

    <main class="index_main">
        <section class="carrossel">
            <div class="carrossel">
                <!-- Setas de navegação -->
                <button class="seta esquerda" onclick="slideAnterior()">❮</button>
                <button class="seta direita" onclick="proximoSlide()">❯</button>

                <div class="slides">
                    <div class="slide">
                        <div class="conteudo">
                            <div class="texto">
                                <h2>CURIOSIDADES DA <br> ARQUITETURA CLÁSSICA</h2>
                                <p>✦ O Panteão de Roma tem a maior cúpula de concreto não reforçado do mundo, com mais de 1900 anos.</p>
                                <p>✦ A proporção áurea foi muito utilizada na arquitetura grega para criar edifícios harmoniosos e esteticamente sofisticados.</p>
                            </div>
                            <div class="imagem">
                                <img src="imagens/img_carrossel1.png" alt="Arquitetura Clássica">
                            </div>
                        </div>
                    </div>

                    <div class="slide">
                        <div class="conteudo">
                            <div class="texto">
                                <h2>CURIOSIDADES DA <br> ARQUITETURA GÓTICA</h2>
                                <p>✦ Caracteriza-se por arcos ogivais, vitrais coloridos e grandes catedrais.</p>
                                <p>✦ A Catedral de Notre-Dame é um dos maiores exemplos do estilo gótico.</p>
                            </div>
                            <div class="imagem">
                                <img src="imagens/img_carrossel2.jpg" alt="Arquitetura Gótica">
                            </div>
                        </div>
                    </div>

                    <div class="slide">
                        <div class="conteudo">
                            <div class="texto">
                                <h2>CURIOSIDADES DA ARQUITETURA MODERNA</h2>
                                <p>✦ Foco em funcionalidade, formas simples e uso de materiais industriais.</p>
                                <p>✦ Le Corbusier foi um dos maiores representantes desse movimento.</p>
                            </div>
                            <div class="imagem">
                                <img src="imagens/img_carrossel3.jpg" alt="Arquitetura Moderna">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botões do carrossel -->
                <div class="botoes">
                    <button onclick="mudarSlide(0)"></button>
                    <button onclick="mudarSlide(1)"></button>
                    <button onclick="mudarSlide(2)"></button>
                </div>
            </div>
        </section>
    </main>

    <section class="arquitetos">
        <h2>ARQUITETOS FAMOSOS DO BRASIL</h2>
        <div class="cards-arquitetos">

            <div class="card">
                <img src="imagens/oscar.png" alt="Oscar Niemeyer">
                <p><strong>Oscar Niemeyer</strong> <br> Principal nome da arquitetura moderna do Brasil, conhecido pelo uso de curvas e concreto armado.</p>
            </div>

            <div class="card">
                <img src="imagens/paulo.png" alt="Paulo Mendes da Rocha">
                <p><strong>Paulo Mendes da Rocha</strong> <br> Vencedor do Prêmio Pritzker, projetou o SESC 24 de Maio e a Pinacoteca de São Paulo, com forte influência brutalista.</p>
            </div>

            <div class="card">
                <img src="imagens/marcio.jpg" alt="Marcio Kogan">
                <p><strong>Marcio Kogan</strong> <br> Arquiteto contemporâneo conhecido por suas casas minimalistas e integração entre arquitetura e paisagem.</p>
            </div>

            <div class="card">
                <img src="imagens/rosa.jpg" alt="Rosa Kliass">
                <p><strong>Rosa Kliass</strong> <br> Paisagista responsável pela renovação do Vale do Anhangabaú, em São Paulo, e outros projetos urbanísticos importantes.</p>
            </div>
        </div>
    </section>

    <section class="aula-arquitetura">
        <h2>AULA SOBRE ARQUITETURA MODERNA</h2>
        <div class="video-container">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/kUiiEee2Jhk"
                title="Aula sobre arquitetura moderna" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>
    </section>

    <section class="secao-teste">
        <div class="conteudo-teste">
            <h2>TESTE DE PERSONALIDADE</h2>
            <a href="view/teste_personalidade.php" class="botao-teste">CLIQUE AQUI PARA INICIAR O TESTE</a>
        </div>
    </section>

    <footer class="rodape-index">

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
                <li><a href="sobre_site.php">✦ SOBRE O SITE</a></li>
                <li><a href="inicio.php">✦ SAIR</a></li>
            </ul>
        </div>

        <div class="coluna feedbacks-index">
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

        <div class="direitos-index">
            <p>© TODOS OS DIREITOS RESERVADOS</p>
        </div>

    </footer>

    <script>
        const slides = document.querySelector('.slides');
        const botoes = document.querySelectorAll('.botoes button');

        function mudarSlide(index) {
            const largura = document.querySelector('.carrossel').offsetWidth;
            slides.style.transform = `translateX(-${index * largura}px)`;
        }

        // Atualiza ao redimensionar a janela (responsivo)
        window.addEventListener('resize', () => mudarSlide(0));

        let slideAtual = 0;

        function mudarSlide(index) {
            const largura = document.querySelector('.carrossel').offsetWidth;
            const slides = document.querySelector('.slides');
            slides.style.transform = `translateX(-${index * largura}px)`;
            slideAtual = index;
        }

        function proximoSlide() {
            const totalSlides = document.querySelectorAll('.slide').length;
            if (slideAtual < totalSlides - 1) {
                mudarSlide(slideAtual + 1);
            }
        }

        function slideAnterior() {
            if (slideAtual > 0) {
                mudarSlide(slideAtual - 1);
            }
        }

        // Atualiza slide ao redimensionar a tela
        window.addEventListener('resize', () => mudarSlide(slideAtual));
    </script>

</body>

</html>