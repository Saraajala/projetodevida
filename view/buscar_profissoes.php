<?php
require_once 'C:\Turma2\xampp\htdocs\projetodevida\config.php';
require_once 'C:\Turma2\xampp\htdocs\projetodevida\controller\ProjetoController.php'; 

$controller = new ProjetoController($pdo);
$profissoes = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['termo'])) {
    $termo = "%" . $_POST['termo'] . "%";
    $profissoes = $controller->buscarProfissoes($termo);

    // Redireciona para evitar reenvio do formulário ao atualizar a página
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Profissões</title>
</head>
<body>
    <h1>Buscar Profissões Relacionadas à Arquitetura</h1>
    <form method="POST">
        <input type="text" name="termo" placeholder="Digite uma profissão..." required>
        <button type="submit">Buscar</button>
    </form>

<?php if (!empty($profissoes)): ?>
    <h2>Resultados:</h2>
    <?php foreach ($profissoes as $profissao): ?>
        <div>
            <h3><?php echo htmlspecialchars($profissao['nome']); ?></h3>
            <p><?php echo htmlspecialchars($profissao['descricao']); ?></p>
            <img src="imagens/<?php echo htmlspecialchars($profissao['imagem']); ?>" alt="<?php echo htmlspecialchars($profissao['nome']); ?>" width="200">
        </div>
    <?php endforeach; ?>
<?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
    <p>Nenhuma profissão encontrada.</p>
<?php endif; ?>

</body>
</html>
