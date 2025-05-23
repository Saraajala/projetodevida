<?php
session_start();
require_once '../config.php';
require_once '../model/ProjetoModel.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$projetoModel = new ProjetoModel($pdo);
$usuario = $projetoModel->buscarUsuarioPorId($_SESSION['usuario_id']); // <-- busca do banco

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit;
}

// Processamento do formulário quando enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $usuarioId = $_SESSION['usuario_id'];
    $email = $_POST['email'];
    $dataNascimento = $_POST['data_nascimento'];
    $sobreMim = $_POST['sobre_mim'];
    $senha = $_POST['senha'];

    // Processa o upload da foto
    $nomeArquivoFinal = null;
    if (isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] === UPLOAD_ERR_OK) {
        $extensao = pathinfo($_FILES['fotoPerfil']['name'], PATHINFO_EXTENSION);
        $nomeArquivoFinal = uniqid('perfil_', true) . '.' . $extensao;
        $caminhoDestino = "../imagens/" . $nomeArquivoFinal;

        // Tenta mover o arquivo para o diretório
        if (!move_uploaded_file($_FILES['fotoPerfil']['tmp_name'], $caminhoDestino)) {
            die("Erro ao fazer upload da foto de perfil.");
        }
    }

    // Se a senha não foi preenchida, ela não será alterada
    if (empty($senha)) {
        $senha = null;
    }

    // Atualiza o perfil no banco
    $projetoModel->atualizarPerfil($usuarioId, $email, $senha, $dataNascimento, $sobreMim, $nomeArquivoFinal);

    // Atualiza a sessão com os novos dados
    $_SESSION['email'] = $email;
    $_SESSION['data_nascimento'] = $dataNascimento;
    $_SESSION['sobre_mim'] = $sobreMim;
    if ($nomeArquivoFinal) {
        $_SESSION['foto_perfil'] = $nomeArquivoFinal;
    }

    // Redireciona para a página de perfil atualizada
    header("Location: perfil.php");
    exit;
}

// Formatação da data para exibição
$dataFormatada = '';
if (!empty($usuario['data_nascimento'])) {
    $dataFormatada = date('Y-d-m', strtotime($usuario['data_nascimento']));
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>
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

    <main class="perfil-container">
        <h1 class="titulo-perfil">Meu Perfil</h1>

        <div class="foto-perfil-container">
            <img src="../imagens/<?= htmlspecialchars($usuario['foto_perfil'] ?? 'padrao.png') ?>"
                alt="Foto de Perfil"
                class="foto-perfil">
        </div>

        <form class="form-perfil" action="atualizar_perfil.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
            </div>

            <br><br>

            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento</label>
                <input type="date" id="data_nascimento" name="data_nascimento" value="<?= $dataFormatada ?>">
            </div>

            <br><br>

            <div class="form-group">
                <label for="senha">Nova Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Deixe em branco para manter">
                <p class="small-text">Preencha apenas se quiser alterar a senha</p>
            </div>

            <div class="form-group" style="grid-column: span 2;">
                <label for="sobre_mim">Sobre Mim</label>
                <textarea id="sobre_mim" name="sobre_mim"><?= htmlspecialchars($usuario['sobre_mim'] ?? '') ?></textarea>
            </div>

            <div class="centro-botao">
                <button type="submit" class="botao-atualizar">Atualizar Perfil</button>
            </div>
        </form>
    </main>

    <footer>© TODOS OS DIREITOS RESERVADOS</footer>
</body>

</html>