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
    <link rel="stylesheet" href="../estilo_teste.css"> <!-- CSS específico -->
</head>
<body>

<div class="container">
    <form id="form-teste" method="POST" action="../processa/processar_teste.php">
        <?php $contador = 0; ?>
        <?php foreach ($perguntas as $idPergunta => $pergunta): ?>
            <fieldset class="pergunta" style="<?= $contador > 0 ? 'display:none;' : '' ?>">
                <legend><strong><?= $pergunta['texto'] ?></strong></legend>
                <?php foreach ($pergunta['respostas'] as $resposta): ?>
                    <label class="opcao">
                        <input type="radio" name="respostas[<?= $idPergunta ?>]" value="<?= $resposta['id'] ?>" required>
                        <?= $resposta['texto'] ?>
                    </label><br>
                <?php endforeach; ?>
            </fieldset>
            <?php $contador++; ?>
        <?php endforeach; ?>

        <div id="navegacao">
            <button type="button" id="btn-proximo">Próxima Pergunta</button>
            <input type="submit" id="btn-enviar" value="Enviar Respostas" style="display:none;">
        </div>
    </form>
</div>

<script>
let perguntas = document.querySelectorAll('.pergunta');
let btnProximo = document.getElementById('btn-proximo');
let btnEnviar = document.getElementById('btn-enviar');
let indice = 0;

btnProximo.addEventListener('click', function() {
    if (indice < perguntas.length - 1) {
        perguntas[indice].style.display = 'none';
        indice++;
        perguntas[indice].style.display = 'block';

        if (indice === perguntas.length - 1) {
            btnProximo.style.display = 'none';
            btnEnviar.style.display = 'inline-block';
        }
    }
});
</script>

</body>
</html>
