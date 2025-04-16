<?php
require_once 'C:/Turma2/xampp/htdocs/projetodevida/config.php';
require_once 'C:\Turma2\xampp\htdocs\projetodevida\controller\ProjetoController.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Certifique-se de passar a conexão $pdo para o controlador
$controller = new ProjetoController($pdo);

// Buscar perguntas e respostas
$perguntas = $controller->buscarPerguntasTeste();
$respostas = $controller->buscarRespostas(); // Aqui chama o método para buscar as respostas

// Organiza as respostas por pergunta_id
$respostasPorPergunta = [];
foreach ($respostas as $resposta) {
    $respostasPorPergunta[$resposta['pergunta_id']][] = $resposta;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Teste de Personalidade</title>
</head>
<body>
<h2>Teste de Personalidade</h2>
<form method="POST" action="../processa/processar_test.php">
    <?php foreach ($perguntas as $pergunta): ?>
        <p><strong><?php echo $pergunta['texto']; ?></strong></p>
        
        <?php
        if (isset($respostasPorPergunta[$pergunta['id']])) {
            foreach ($respostasPorPergunta[$pergunta['id']] as $resposta) {
                echo '<input type="radio" name="respostas[' . $pergunta['id'] . ']" value="' . $resposta['id'] . '"> ' . $resposta['texto'] . '<br>';
            }
        } else {
            echo '<p>Sem respostas cadastradas para esta pergunta.</p>';
        }
        ?>
    <?php endforeach; ?>

    <input type="submit" value="Enviar Respostas">
</form>
</body>
</html>
