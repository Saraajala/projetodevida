<?php
// Inclua o controlador ou a conexão com o banco
include 'ProjetoController.php';

if (isset($_GET['termo'])) {
    $controller = new ProjetoController($pdo); // Lembre-se de passar o PDO
    $resultados = $controller->buscarProfissoes($_GET['termo']);
}

include 'planejamento_futuro.php'; // Exibe a página novamente com os resultados
?>
