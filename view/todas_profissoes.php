<?php
session_start();
require_once "../config.php";
require_once "../model/ProjetoModel.php";
require_once "../controller/ProjetoController.php";

$model = new ProjetoModel($pdo);
$controller = new ProjetoController($pdo);

// Busca todas as profissões
$profissoes = $model->buscarTodasProfissoes();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Todas as Profissões</title>
    <link rel="stylesheet" href="../css/estilo_planejamento.css">
</head>

<body>
    <header class="header-sobre">
        <img src="../imagens/logo.png" alt="logo" class="logo">

        <nav>
            <ul class="menu-central">
                <li><a href="teste_personalidade.php">Teste de personalidade</a></li>
                <li><a href="form_planejamento.php">Planeamento do futuro</a></li>
                <li><a href="plano_acao.php">Plano de ação</a></li>
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

    <main class="container-profissoes">
        <h1 class="titulo-profissao">EXPLORE AS PROFISSÕES</h1>

        <div class="lista-profissoes">
            <?php foreach ($profissoes as $profissao): ?>
                <div class="profissao-item">
                    <h2><?= htmlspecialchars($profissao['nome']) ?></h2>
                    <p><?= htmlspecialchars(substr($profissao['descricao'], 0, 150)) ?>...</p>
                    <a href="detalhes_profissao.php?id=<?= $profissao['id'] ?>" class="botao-salvar">Ver detalhes</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer>© TODOS OS DIREITOS RESERVADOS</footer>
</body>

</html>