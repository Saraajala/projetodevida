<?php
session_start();
require_once '../config.php';
require_once '../model/ProjetoModel.php';

if (!isset($_SESSION['usuario_id'])) {
    echo "Você precisa estar logado para ver seus feedbacks.";
    exit;
}

$usuarioId = $_SESSION['usuario_id'];

$model = new ProjetoModel($pdo);
$feedbacks = $model->buscarFeedbacksPorUsuario($usuarioId);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meus Feedbacks</title>
</head>
<body>
    <h1>Meus Feedbacks</h1>
    <?php if ($feedbacks): ?>
        <ul>
            <?php foreach ($feedbacks as $feedback): ?>
                <li><strong><?= htmlspecialchars($feedback['email']) ?>:</strong> <?= htmlspecialchars($feedback['opiniao']) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Você ainda não enviou nenhum feedback.</p>
    <?php endif; ?>

    <a href="../index.php">Voltar à página inicial</a>
</body>
</html>
