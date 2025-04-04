<?php
if (isset($_GET['action']) && $_GET['action'] == 'salvarFeedback') {
    require_once 'controller/ProjetoController.php';
    $pdo = new PDO("mysql:host=localhost;dbname=seu_banco", "usuario", "senha");
    $controller = new ProjetoController($pdo);
    $controller->salvarFeedback();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Início</title>
</head>
<body>
<footer>
    <h3>Deixe seu feedback</h3>
    <form action="index.php?action=salvarFeedback" method="POST">
        <label for="email">Seu e-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="opiniao">Sua opinião:</label>
        <textarea id="opiniao" name="opiniao" required></textarea>

        <button type="submit">Enviar</button>
    </form>

    <?php
    if (isset($_GET['msg']) && $_GET['msg'] == 'feedback_enviado') {
        echo "<p>Feedback enviado com sucesso!</p>";
    }
    ?>
</footer>
</body>
</html>