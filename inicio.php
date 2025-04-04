<!DOCTYPE html> 
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Início</title>
</head>
<body class="inicio">
    <header class="header">
        <nav>
            <ul>
                <li><a href="view/cadastro.php">Cadastre-se</a></li>
                <li><a href="view/login.php">Entrar</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="svg-container">
            <svg width="400" height="300" viewBox="0 0 400 200">
                <!-- Caminho para o arco superior -->
                <path id="circlePath" d="M 50,150 A 150,150 0 0,1 350,150" fill="none"/>
                
                <!-- Texto apenas na parte superior -->
                <text fill="white" font-size="60" font-family="Newsreader" font-weight="700">
                    <textPath href="#circlePath" startOffset="50%" text-anchor="middle">
                        PROJETO DE VIDA
                    </textPath>
                </text>
            </svg>
        </div>

        <!-- Logo abaixo da escrita -->
        <img src="imagens/logo.png" alt="logo" class="logo">
    </div>

    <a href="sobre_site.php" class="botao">SOBRE O SITE</a>

</body>
</html>
