<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    // Redirecionar para login se não estiver logado
    header("Location: login.php");
    exit;
}

require_once "../config.php"; // conexão PDO no $pdo
require_once "../model/ProjetoModel.php";
require_once "../controller/ProjetoController.php";

$model = new ProjetoModel($pdo);
$controller = new ProjetoController($pdo);

$usuario_id = $_SESSION['usuario_id'];
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Salvar planejamento
    $dadosForm = [
        'aprendendo' => $_POST['aprendendo'] ?? '',
        'fazendo' => $_POST['fazendo'] ?? '',
        'preciso' => $_POST['preciso'] ?? '',
        'meta_curto' => $_POST['meta_curto'] ?? '',
        'meta_medio' => $_POST['meta_medio'] ?? '',
        'meta_longo' => $_POST['meta_longo'] ?? '',
    ];

    $salvo = $controller->salvarPlanejamento($usuario_id, $dadosForm);

    if ($salvo) {
        $mensagem = "Planejamento salvo com sucesso!";
    } else {
        $mensagem = "Erro ao salvar planejamento.";
    }
}

// Buscar dados atuais para exibir no formulário
$planejamento = $controller->buscarPlanejamento($usuario_id);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <title>Planejamento - Projeto de Vida</title>
    <link rel="stylesheet" href="../css/estilo_planejamento.css">
</head>

<body>
    <header class="header-sobre">
        <img src="../imagens/logo.png" alt="logo" class="logo">

        <nav>
            <ul class="menu-central">
                <li><a href="teste_personalidade.php">Teste de personalidade</a></li>
                <li><a href="plano_acao.php">Plano ação</a></li>
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

    <div class="container-plano">
        <h1 class="titulo-plano">PLANEJAMENTO DO FUTURO</h1>
        <p class="descricao">Comece agora a planejar seu futuro de maneira fácil e rápida, descreva suas aspirações, <br> sonhos e escolha sua ocupação profissional!</p>
        <img class="imagem-planodeacao" src="../imagens/imagem_planejamento.png" alt="">
    </div>

    <?php if ($mensagem): ?>
        <p style="color: green; font-weight: bold;"><?php echo htmlspecialchars($mensagem); ?></p>
    <?php endif; ?>

    <br><br>

    <h2 class="titulos">"APRENDENDO A FAZER"</h2>
    <section class="fazer">
        <label class="instrucoes">Aspirações, sonhos de infância e sonhos atuais:</label><br />
            <textarea name="aprendendo" rows="4" cols="50"><?php echo htmlspecialchars($planejamento['aprendendo'] ?? '') ?></textarea>
    </section>

    <br><br>

<h2 class="titulos">"PLANEJAMENTO"</h2>
    <section class="planejamento">
        <label class="instrucoes">O que já estou fazendo:</label><br />
        <textarea name="fazendo" rows="4" cols="50"><?php echo htmlspecialchars($planejamento['fazendo'] ?? '') ?></textarea><br />

        <label class="instrucoes">O que ainda preciso fazer:</label><br />
        <textarea name="preciso" rows="4" cols="50"><?php echo htmlspecialchars($planejamento['preciso'] ?? '') ?></textarea>
    </section>

    <br><br>

 <h2 class="titulos">"NOVAS METAS"</h2>
    <section class="metas">
        <label class="instrucoes">Curto prazo:</label><br />
        <textarea name="meta_curto" rows="2" cols="50"><?php echo htmlspecialchars($planejamento['meta_curto'] ?? '') ?></textarea><br />

        <label class="instrucoes">Médio prazo:</label><br />
        <textarea name="meta_medio" rows="2" cols="50"><?php echo htmlspecialchars($planejamento['meta_medio'] ?? '') ?></textarea><br />

        <label class="instrucoes">Longo prazo:</label><br />
        <textarea name="meta_longo" rows="2" cols="50"><?php echo htmlspecialchars($planejamento['meta_longo'] ?? '') ?></textarea><br />
    </section>

   <div class="botao-container">
  <button type="submit" class="botao-salvar">Salvar Planejamento</button>
</div>
    </form>

    <br><br><br>

 <h1 class="titulo-profissoes">“PROFISSÕES”</h1>

    <div class="profissoes">
    <img src="../imagens/profissoes_img.png" alt="Profissões">
    
    <div class="search-box">
       
        
        <h2>CAMPO DE BUSCA DE PROFISSÕES</h2>
        
        <form class="search-form" action="detalhes_profissao.php" method="get">
            <input type="text" name="busca" placeholder="Pesquise aqui a profissão desejada" required>
            <button type="submit">Buscar</button>
        </form>
        
        <p class="more-info">Quer saber mais sobre a profissão escolhida? 
            <a href="todas_profissoes.php">Clique aqui!</a>
        </p>
    </div>
</div>

<br><br><br>

<footer>© TODOS OS DIREITOS RESERVADOS</footer>


</body>
</html>