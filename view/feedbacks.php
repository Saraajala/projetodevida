<?php
require_once '../config.php';
require_once '../model/ProjetoModel.php';

$model = new ProjetoModel($pdo);
$feedbacks = $model->buscarTodosFeedbacks();
?>

<h2>Feedbacks de Todos os Usuários</h2>
<ul>
    <?php foreach ($feedbacks as $feedback): ?>
        <li><strong><?= htmlspecialchars($feedback['email']) ?>:</strong> <?= htmlspecialchars($feedback['opiniao']) ?></li>
    <?php endforeach; ?>
</ul>
<a href="../index.php">Voltar</a>
