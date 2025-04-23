<?php
include('../config.php');

$query = "SELECT p.id AS pergunta_id, p.pergunta, r.id AS resposta_id, r.resposta, r.tipo 
          FROM perguntas p 
          JOIN respostas r ON p.id = r.pergunta_id 
          ORDER BY p.id, r.id";
$result = $pdo->query($query);
$dados = $result->fetchAll(PDO::FETCH_ASSOC);

$perguntas = [];
foreach ($dados as $linha) {
    $perguntas[$linha['pergunta_id']]['texto'] = $linha['pergunta'];
    $perguntas[$linha['pergunta_id']]['respostas'][] = [
        'id' => $linha['resposta_id'],
        'texto' => $linha['resposta'],
        'tipo' => $linha['tipo']
    ];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Teste de Personalidade</title>
</head>
<body>
    <h1>Teste de Personalidade - Arquitetura</h1>
    <form method="POST" action="../processa/processar_teste.php">
        <?php foreach ($perguntas as $idPergunta => $pergunta): ?>
            <fieldset>
                <legend><strong><?= $pergunta['texto'] ?></strong></legend>
                <?php foreach ($pergunta['respostas'] as $resposta): ?>
                    <label>
                        <input type="radio" name="respostas[<?= $idPergunta ?>]" value="<?= $resposta['id'] ?>" required>
                        <?= $resposta['texto'] ?>
                    </label><br>
                <?php endforeach; ?>
            </fieldset>
        <?php endforeach; ?>
        <input type="submit" value="Enviar Respostas">
    </form>
</body>
</html>
