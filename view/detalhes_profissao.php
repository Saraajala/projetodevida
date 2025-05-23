<?php
session_start();
require_once "../config.php";
require_once "../model/ProjetoModel.php";
require_once "../controller/ProjetoController.php";

$model = new ProjetoModel($pdo);
$controller = new ProjetoController($pdo);

// Busca por ID ou por termo
if (isset($_GET['id'])) {
    $profissao = $model->buscarProfissaoPorId($_GET['id']);
} elseif (isset($_GET['busca'])) {
    $profissoes = $model->buscarProfissoes($_GET['busca']);
    $profissao = !empty($profissoes) ? $profissoes[0] : null;
} else {
    $profissao = null;
}

if (!$profissao) {
    header("Location: todas_profissoes.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($profissao['nome']) ?></title>
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
        <h1 class="titulo-profissao"><?= htmlspecialchars($profissao['nome']) ?></h1>
        
        <div class="profissao-card destaque-profissao">
            <h2 class="nome-profissao"><?= htmlspecialchars($profissao['nome']) ?></h2>
            <p class="descricao-profissao"><?= nl2br(htmlspecialchars($profissao['descricao'])) ?></p>
            
            <?php if (!empty($profissao['imagem'])): ?>
                <div class="imagem-profissao">
                    <img src="../imagens/profissoes/<?= htmlspecialchars($profissao['imagem']) ?>" alt="<?= htmlspecialchars($profissao['nome']) ?>" style="max-width:100%; border-radius:8px;">
                </div>
            <?php endif; ?>
        </div>
        
        <a href="todas_profissoes.php" class="botao-voltar">← Voltar para todas as profissões</a>
    </main>

    <footer>© TODOS OS DIREITOS RESERVADOS</footer>
</body>
</html>
