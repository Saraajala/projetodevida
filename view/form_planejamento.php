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
</head>
<body>

<h1>Projeto de Vida - Planejamento</h1>

<?php if ($mensagem): ?>
    <p style="color: green; font-weight: bold;"><?php echo htmlspecialchars($mensagem); ?></p>
<?php endif; ?>

<form action="" method="post">

    <h2>Aprendendo a Fazer</h2>
    <textarea name="aprendendo" rows="4" cols="50"><?php echo htmlspecialchars($planejamento['aprendendo'] ?? '') ?></textarea>

    <h2>Planejamento</h2>

    <label>O que já estou fazendo:</label><br />
    <textarea name="fazendo" rows="4" cols="50"><?php echo htmlspecialchars($planejamento['fazendo'] ?? '') ?></textarea><br />

    <label>O que ainda preciso fazer:</label><br />
    <textarea name="preciso" rows="4" cols="50"><?php echo htmlspecialchars($planejamento['preciso'] ?? '') ?></textarea>

    <h2>Novas Metas</h2>
    <label>Curto prazo:</label><br />
    <textarea name="meta_curto" rows="2" cols="50"><?php echo htmlspecialchars($planejamento['meta_curto'] ?? '') ?></textarea><br />

    <label>Médio prazo:</label><br />
    <textarea name="meta_medio" rows="2" cols="50"><?php echo htmlspecialchars($planejamento['meta_medio'] ?? '') ?></textarea><br />

    <label>Longo prazo:</label><br />
    <textarea name="meta_longo" rows="2" cols="50"><?php echo htmlspecialchars($planejamento['meta_longo'] ?? '') ?></textarea><br />

    <button type="submit">Salvar Planejamento</button>
</form>

</body>
</html>
