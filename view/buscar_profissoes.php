<?php
require_once '../config.php';
require_once '../controller/ProjetoController.php';

$controller = new ProjetoController($pdo);
$profissoes = [];

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['termo'])) {
    $profissoes = $controller->buscarProfissoes("%" . $_POST['termo'] . "%");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><title>Buscar Profissões</title></head>
<body>
    <h1>Buscar Profissões</h1>
    <form method="POST">
        <input type="text" name="termo" required>
        <button type="submit">Buscar</button>
    </form>

    <?php if (!empty($profissoes)): ?>
        <?php foreach ($profissoes as $p): ?>
            <div>
                <h3><?= htmlspecialchars($p['nome']) ?></h3>
                <p><?= htmlspecialchars($p['descricao']) ?></p>
                <img src="../imagens/<?= htmlspecialchars($p['imagem']) ?>" width="200">
            </div>
        <?php endforeach; ?>
    <?php elseif ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
        <p>Nenhuma profissão encontrada.</p>
    <?php endif; ?>
</body>
</html>
